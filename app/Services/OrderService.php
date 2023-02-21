<?php

namespace App\Services;

use App\Models\PCRMember;
use App\Models\Order;
use App\Models\Ideapay;
use App\Models\Transactions;
use App\Models\AnnualMembershipFees;

use App\Enums\OrderStatusEnum;
use App\Enums\IdeapayStatusEnum;

use App\Services\IdeapayService;

use Exception;
use DB;

class OrderService {
    private $default;
    private $collection_fee;
    private $collection_fees;
    private $pcr_member;

    public function __construct($collection_fee, $default = false)
    {
        $this->collection_fee = $collection_fee;
        if($default) {
            $this->create();
        }
    }

    public function create() {
        DB::beginTransaction();
        try {
            $pcr_members = PCRMember::where('is_approved', 1)->get();
            $collection_fee = $this->collection_fee;

            foreach($pcr_members as $pcr_member) {
                $member_collection_fee = null;
                if(!empty($pcr_member->orders)) {
                    $member_collection_fee = $pcr_member->orders->where('collection_type_id', $collection_fee->id)->first();
                }

                if(is_null($member_collection_fee)) {
                    $ideapay_fee = $collection_fee->enable_ideapay_fee ? 38 : 0;

                    $order = new Order();
                    $order->pcr_member_id = $pcr_member->id;
                    $order->amount = $collection_fee->amount + $ideapay_fee;
                    $order->year = $collection_fee->year;
                    $order->type = $collection_fee->payment_type;
                    $order->collection_type_id = $collection_fee->id;
                    $order->status = OrderStatusEnum::PENDING;
                    $order->convenience_fee = $ideapay_fee;
                    $order->save();

                    $pcr_member->balance += $order->amount;
                    $pcr_member->save();

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
                }
            }

            DB::commit();
            return array(
                'message' => 'Successfully added order',
                // 'order_id' => $order->id,
                // 'payment_url' => $payment['url'],
                'code' => 200,
            );
        } catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    public function addMultipleToMember($pcr_member, $collection_fees) {
        DB::beginTransaction();
        foreach($collection_fees as $collection_fee) {
            try {
                $member_collection_fee = null;
                if(!empty($pcr_member->orders)) {
                    $member_collection_fee = $pcr_member->orders->where('collection_type_id', $collection_fee->id)->first();
                }

                if(is_null($member_collection_fee)) {
                    $ideapay_fee = $collection_fee->enable_ideapay_fee ? 38 : 0;

                    $order = new Order();
                    $order->pcr_member_id = $pcr_member->id;
                    $order->amount = $collection_fee->amount + $ideapay_fee;
                    $order->year = $collection_fee->year;
                    $order->type = $collection_fee->payment_type;
                    $order->collection_type_id = $collection_fee->id;
                    $order->status = OrderStatusEnum::PENDING;
                    $order->convenience_fee = $ideapay_fee;
                    $order->save();

                    $pcr_member->balance += $order->amount;
                    $pcr_member->save();

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
                }

                DB::commit();
            } catch(Exception $e){
                DB::rollBack();
                throw $e;
            }
        }
    }

    public function addToMember($pcr_member, $collection_fee) {
        DB::beginTransaction();
        try {
            $member_collection_fee = null;
            if(!empty($pcr_member->orders)) {
                $member_collection_fee = $pcr_member->orders->where('collection_type_id', $collection_fee->id)->first();
            }

            if(is_null($member_collection_fee)) {
                $ideapay_fee = $collection_fee->enable_ideapay_fee ? 38 : 0;

                $order = new Order();
                $order->pcr_member_id = $pcr_member->id;
                $order->amount = $collection_fee->amount + $ideapay_fee;
                $order->year = $collection_fee->year;
                $order->type = $collection_fee->payment_type;
                $order->collection_type_id = $collection_fee->id;
                $order->status = OrderStatusEnum::PENDING;
                $order->convenience_fee = $ideapay_fee;
                $order->save();

                $pcr_member->balance += $order->amount;
                $pcr_member->save();

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
            }

            DB::commit();
        } catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}