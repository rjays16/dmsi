<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transactions;
use App\Models\Ideapay;
use App\Enums\OrderStatusEnum;
use App\Enums\IdeapayStatusEnum;
use App\Services\IdeapayService;
use App\Services\PaymentService;

use Illuminate\Http\Request;

use Exception;
use DB;

class IdeapayController extends Controller
{
    public function success() {
        return response('successful payment');
    }

    public function verifyOrderStatus(Request $request){
        $data = [
            'response_code' => $request->response_code,
            'response_message' => $request->response_message,
            'payment_id' => $request->payment_id,
    		'signature' => hash('sha512', config('ideapay.client_secret'))
        ];

        $payment = Ideapay::where('payment_ref', $data['payment_id'])
            ->first();

        if(is_null($payment)) {
            return response('Payment not found.');
        }

        if($payment->status == IdeapayStatusEnum::PENDING) {
            try {
                $status = (new IdeapayService())->getStatus($data);
                $payment->status = $status;
                $payment->save();

                if($payment->transaction) {
                    $order = $payment->transaction->order;
                    $order->status = $payment->status;
                    $order->save();
                }

                // Record payment on success
                if($payment->status == IdeapayStatusEnum::SUCCESS) {
                    new PaymentService($payment);
                    return response('Payment verified.');
                } else {
                    return response('Payment was unsuccessful.');
                }
            } catch(Exception $e) {
                throw $e;
            }
        } elseif($payment->status == IdeapayStatusEnum::SUCCESS) {
            return response('Payment was successful.');
        } elseif($payment->status == IdeapayStatusEnum::FAILED) {
            return response('Payment was unsuccessful.');
        } else {
            return response('Payment record could not be processed.');
        }
    }

    public function create(Request $request) {
        $order_id = $request->order_id;
        $order = Order::where('id', $order_id)->first();

        if(!is_null($order)) {
            if(number_format($order->OrderPayments, 2) < number_format($order->collection_fee->amount, 2)) {
                $payment = IdeapayService::create($order);

                $ideapay = new Ideapay();
                $ideapay->status = IdeapayStatusEnum::PENDING;
                $ideapay->payment_ref = $payment['payment_ref'];
                $ideapay->payment_url = $payment['url'];
                $ideapay->save();

                $transaction = Transactions::where('order_id', $order_id)->first();
                $transaction->ideapay_id = $ideapay->id;
                $transaction->save();

                return response()->json([
                    'payment_url' => $ideapay->payment_url
                ]);
            } else {
                return response()->json([
                    'message' => 'This order has already been fully paid.'
                ], 400);
            } 
        } else {
            return response()->json([
                'message' => 'Order not found'
            ], 404);
        }
    }
}