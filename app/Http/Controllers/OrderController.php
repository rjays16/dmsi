<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Order;
use App\Models\PCRMember;
use App\Models\OrderType;
use App\Models\Ideapay;
use App\Models\CollectionFee;
use App\Models\Transactions;
use App\Models\FiscalPeriod;

use App\Enums\OrderStatusEnum;
use App\Enums\IdeapayStatusEnum;
use App\Enums\PaymentMethodEnum;
use App\Enums\OrderTypeEnum;

use App\Services\IdeapayService;

use App\Http\Requests\Order\Create;
use App\Http\Requests\Order\NewCreate;

use App\Events\OrderFee;

use Exception;
use DB;

class OrderController extends Controller
{
    public function getOrder($id) {
        $order = Order::where('id', $id)->first();

        if(!is_null($order)) {
            return response()->json($order);
        } else {
            return response()->json(['message' => 'Order not found'], 404);
        }
    }

    public function getUserAnnualOrders(Request $request) {
        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();

        $pending_orders = Order::where('pcr_member_id', $user->userable_id)
            // ->where('status', OrderStatusEnum::PENDING)
            ->with('transaction', 'transaction.ideapay', 'collection_fee', 'payments')
            ->get();

        return response()->json($pending_orders, 200);
    }

    public function getDashboardOrders(Request $request) {
        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();

        $active_fiscal_period = FiscalPeriod::active()->first();

        $top_annual_orders = Order::whereHas('collection_fee', function ($query) { 
            $query->whereIn('payment_type', [OrderTypeEnum::MEMBERSHIP, OrderTypeEnum::PMA, OrderTypeEnum::COMPUTERIZATION, OrderTypeEnum::GOOD_STANDING])
                ->active()
                ->forCurrentFiscalYear();
        })
        ->with('collection_fee.fiscal_period')
        ->where('pcr_member_id', $user->userable_id)
        ->get();

        $previous_years = [2021, 2022];
        $previous_orders = Order::where('pcr_member_id', $user->userable_id)
            ->whereIn('year', $previous_years)
            ->get();

        return response()->json([
            'top_annual_orders' => $top_annual_orders,
            'previous_orders' => $previous_orders,
            'active_fiscal_period' => $active_fiscal_period
        ]);
    }

    public function getOrderTypes() {
        $order_types = OrderType::orderBy('order_number', 'asc')->get();
        return response()->json($order_types);
    }

    public function create(Create $request) {
        $validated = $request->validated();
        $ideapay_fee = number_format(38, 2);
        $collection = CollectionFee::where('id', $validated['collection_fee_id'])->first();

        DB::beginTransaction();
        try {
            if(!is_null($collection)) {
                if($collection->description === 'Platform Computerization Fee'){
                    $ideapay_fee = 0;
                }
                $order = new Order();
                $order->pcr_member_id = $validated['pcr_member_id'];
                $order->amount = $collection->amount + $ideapay_fee;
                $order->collection_type_id = $validated['collection_fee_id'];
                $order->type = $collection->payment_type;
                $order->status = OrderStatusEnum::PENDING;
                $order->save();

                DB::commit();
                return response()->json([
                    'message' => 'Order created',
                    'order_status' => $order
                ]);
            } else {
                return response()->json([
                    'message' => 'Collection fee is not yet set.'
                ], 404);
            }
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function newOrderCreate(NewCreate $request) {
        $validated = $request->validated();
        $ideapay_fee = number_format(38, 2);
        $user = User::where('id', $validated['user_id'])->with('member')->first();
        $collection = CollectionFee::where('id', $validated['collection_fee_id'])->first();

        DB::beginTransaction();
        try {
            if(!is_null($collection)) {
                if($collection->description === 'Platform Computerization Fee'){
                    $ideapay_fee = 0;
                }
                $order = new Order();
                $order->pcr_member_id = $user->member->id;
                $order->amount = $collection->amount + $ideapay_fee;
                $order->year = $collection->year;
                $order->collection_type_id = $validated['collection_fee_id'];
                $order->type = $collection->payment_type;
                $order->status = OrderStatusEnum::PENDING;
                $order->save();

                $payment = IdeapayService::create($order);

                $ideapay = new Ideapay();
                $ideapay->status = IdeapayStatusEnum::PENDING;
                $ideapay->payment_ref = $payment['payment_ref'];
                $ideapay->payment_url = $payment['url'];
                $ideapay->save();

                $transaction = new Transactions();
                $transaction->amount = $order->amount;
                $transaction->order_id = $order->id;
                $transaction->ideapay_id = $ideapay->id;
                $transaction->save();

                DB::commit();
                event(new OrderFee($order));
                return response()->json([
                    'message' => 'Successfully created order.',
                    'order_id' => $order->id,
                    'payment_url' => $payment['url'],
                ]);
            } else {
                return response()->json([
                    'message' => 'Collection fee is not yet set.'
                ], 404);
            }
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateMemberOrder(Request $request) {
        $order = Order::where('id', $request->order_id)->first();
        $pcr_member = PCRMember::where('id', $request->pcr_member_id)->first();

        DB::beginTransaction();
        try {
            if(!is_null($pcr_member)) {
                if($request->exists('amount')) {
                    $pcr_member->balance = $pcr_member->balance - $request->amount;
                    $pcr_member->save();
                }

                $payment_total = $order->order_payments;

                if($payment_total >= $order->collection_fee->amount) {
                    $order->status = OrderStatusEnum::COMPLETED;
                } else {
                    $order->status = OrderStatusEnum::PARTIAL;
                }
                
                $order->save();

                DB::commit();
                event(new OrderFee($order));
                return response()->json([
                    'message' => 'Order updated',
                    'order_status' => $order->status
                ]);
            } else {
                return response()->json([
                    'message' => 'PCR Member not found'
                ], 404);
            }
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateCOGSOrderToClaimed(NewCreate $request) {
        $user = User::where('id',$request->user_id)->with(['member'])->first();
        $order = Order::where([['pcr_member_id',  $user->member->id],['collection_type_id', $request->collection_fee_id],['status', OrderStatusEnum::COMPLETED]])->first();
        DB::beginTransaction();
        try {
            if(!is_null($order) && $order->collection_fee->description === 'Good Standing Certificate Fee'){
                $order->is_claimed = true;
                $order->save();

                DB::commit();
                event(new OrderFee($order));
                return response()->json([
                    'message' => 'Order updated',
                ]);
            } else {
                return response()->json([
                    'message' => 'Order not found.'
                ], 404);
            }
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
