<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\PCRMember;
use App\Models\User;

use App\Enums\OrderStatusEnum;

use App\Exports\PaymentExport;
use Maatwebsite\Excel\Facades\Excel;

use Exception;
use DB;

class PaymentController extends Controller
{
    public function getPaymentLedger(Request $request) {   
        $payments = Payment::with('order', 'order.collection_fee', 'pcr_member')
            ->orderBy('date_paid', 'desc')
            ->paginate(20);
        return response()->json($payments);
    }

    public function getPaymentHistory($user_id) {
        $payments = Payment::where('pcr_member_id', $user_id)
            ->with('order', 'order.collection_fee', 'pcr_member', 'method')
            ->get();
        return response()->json($payments);
    }

    public function search(Request $request) {
        try {
            $keyword = $request->keyword;
            $members = PCRMember::where('first_name', 'like', "%$keyword%")
                ->orWhere('last_name', 'like', "%$keyword%")
                ->orWhere('email', 'like', "%$keyword%")
                ->get();

            if($members->isNotEmpty()) {
                $member_ids = $members->pluck('id')->toArray();
                $payments = Payment::whereIn('pcr_member_id', $member_ids)
                    ->with('order', 'pcr_member')
                    ->get();
                return response()->json($payments);
            } else {
                return response()->json(['message' => 'No results.'], 404);
            }
        }
        catch (Exception $e) {
            throw $e;
        }
    }

    public function getDepositSlip($id) {
        $payment = Payment::where('id', $id)
            ->with('order', 'depost_slip_class')
            ->first();
        if(!is_null($payment)) {
            $deposit_slip = $payment->depost_slip_class
                ? $payment->depost_slip_class->path
                : $payment->order->transaction->deposit_slip->path;
            return response()->json($deposit_slip);
        } else {
            return response()->json([
                'message' => 'Payment not found'
            ], 404);
        }
    }

    public function delete($id) {
        $payment = Payment::where('id', $id)
            ->with('depost_slip_class', 'order')
            ->first();
        if(!is_null($payment)) {
            DB::beginTransaction();
            try {
                if(!empty($payment->deposit_slip_class)) {
                    $payment->deposit_slip_class->delete();
                }
                
                $payment->delete();
                $order = $payment->order;
                $payment_total = $order->order_payments;
                if($payment_total >= $order->collection_fee->amount) {
                    $order->status = OrderStatusEnum::COMPLETED;
                } else {
                    $order->status = OrderStatusEnum::PARTIAL;
                }
                $order->save();
                
                DB::commit();
                return response()->json([
                    'message' => 'Successfully deleted payment'
                ]);
            } catch(Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } else {
            return response()->json([
                'message' => 'Payment not found'
            ], 404);
        }
    }

    public function export() {
        return Excel::download(new PaymentExport(), 'payments.csv');
    }
}