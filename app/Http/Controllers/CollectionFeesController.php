<?php

namespace App\Http\Controllers;

use App\Models\CollectionFee;
use App\Models\PCRMember;
use App\Models\Order;
use App\Models\Ideapay;
use App\Models\Transactions;
use App\Models\FiscalPeriod;

use App\Http\Requests\CollectionFee\Create;
use App\Http\Requests\CollectionFee\Update;
use App\Http\Requests\CollectionFee\MemberFee;
use App\Http\Requests\CollectionFee\CreateForMember;
use App\Http\Requests\CollectionFee\AddToActiveMembers;

use App\Enums\IdeapayStatusEnum;
use App\Enums\OrderStatusEnum;

use App\Services\OrderService;
use App\Services\IdeapayService;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

use DB;
use Exception;

class CollectionFeesController extends Controller
{
    public function getCollectionFees() {
        $collection_fees = CollectionFee::with('fiscal_period')->orderBy('id', 'desc')->paginate(20);
        return response()->json($collection_fees);
    }    

    public function getCollectionFee($id) {
        $collection_fees = CollectionFee::where('id', $id)->first();

        if(!is_null($collection_fees)) {
            return response()->json($collection_fees);
        } else {
            return response()->json(['message' => 'Fiscal Period not found!'], 404);
        }
    }

    public function getActive() {
        $active_collection_fees = CollectionFee::with('fiscal_period')->active()->orderBy('id', 'desc')->get();
        return response()->json($active_collection_fees);
    }

    public function create(Create $request) {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $collection_fee = CollectionFee::create($validated);

            // new OrderService($collection_fee, true);

            DB::commit();
            return response()->json([
                'message' => 'Successfully created collection fee.'
            ]);
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(Update $request, $id) {
        $validated = $request->validated();
        $collection_fee = CollectionFee::where('id', $id)->first();

        if(is_null($collection_fee)) {
            return response()->json([
                'message' => 'Collection fee was not found.'
            ], 404);
        }

        DB::beginTransaction();
        try {
            $collection_fee->update($validated);
            DB::commit();
            return response()->json([
                'message' => 'Successfully updated collection fee.'
            ]);
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function addToMember(MemberFee $request) {
        $validated = $request->validated();
        $pcr_member = PCRMember::where('id', $validated["member_id"])->first();
        $member_collection_fee = null;
        if(!empty($pcr_member->orders)) {
            $member_collection_fee = $pcr_member->orders->where('collection_type_id', $validated["collection_fee_id"])->first();
        }

        if(is_null($member_collection_fee)) {
            DB::beginTransaction();
            try {
                $collection_fee = CollectionFee::where('id', $validated["collection_fee_id"])->first();

                $order_service = new OrderService(null);
                $order_service->addToMember($pcr_member, $collection_fee);

                DB::commit();
                return response()->json([
                    'message' => 'Successfully added Collection fee to Member'
                ]);
            } catch(Exception $e){
                DB::rollBack();
                throw $e;
            }
        } else {
            return response()->json([
                'message' => 'Member already has this Collection fee.'
            ], 400);
        }
    }

    public function createForMember(CreateForMember $request) {
        $validated = $request->validated();
        $pcr_member = PCRMember::where('id', $validated["member_id"])->first();

        if(!is_null($pcr_member)) {
            try {
                $collection_fee = CollectionFee::create($validated);
                DB::commit();
    
                $order_service = new OrderService(null);
                $order_service->addToMember($pcr_member, $collection_fee);
    
                return response()->json([
                    'message' => 'Successfully created Collection Fee for member'
                ]);
            } catch(Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } else {
            return response()->json([
                'message' => 'Member not found'
            ], 400);
        }
    }

    public function addToAllActive(AddToActiveMembers $request) {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $collection_fee = CollectionFee::where('id', $validated["collection_fee_id"])->first();

            if(!is_null($collection_fee)) {
                new OrderService($collection_fee, true);

                DB::commit();
                return response()->json([
                    'message' => 'Successfully added Collection fee to all Active members'
                ]);
            } else {
                return response()->json([
                    'message' => 'Collection fee not found'
                ], 404);
            }
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($id) {
        $collection_fee = CollectionFee::where('id', $id)->first();
        
        if(!is_null($collection_fee)) {
            DB::beginTransaction();
            try {
                if(!empty($collection_fee->orders)) {
                    $orders = $collection_fee->orders;
                    foreach($orders as $order) {
                        if(!empty($order->transaction->deposit_slip)) {
                            $order->transaction->deposit_slip->delete();
                        }

                        $order->transaction->delete();
                        if(!is_null($order->transaction->ideapay)) {
                            $order->transaction->ideapay->delete();
                        }
                        
                        if(!empty($order->payments)) {
                            $payments = $order->payments;
                            foreach($payments as $payment) {
                                if(!empty($payment->deposit_slip_class)) {
                                    $payment->deposit_slip_class->delete();
                                }
                                $payment->delete();
                            }
                        }
                        $order->delete();
                    }
                }
                $collection_fee->delete();

                DB::commit();
                return response()->json([
                    'message' => 'Successfully deleted Collection fee'
                ]);
            } catch(Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } else {
            return response()->json([
                'message' => 'Collection fee not found'
            ], 404);
        }
    }

    public function getCollectionFees2022EnabledUploadDeposit() {
        $collection_fees_year_2022 = CollectionFee::where([['year', '2022'],['enable_deposit_slip', true]])->get();
        foreach ($collection_fees_year_2022 as $key => $collection_fee) {
            if($collection_fee->description == "PMA Membership Fee (New Members)"){
                $collection_fee->description = "PMA Membership Fee";
            }else if($collection_fee->description =="PMA Membership Fee"){
                unset($collection_fees_year_2022[$key]);
            }
        }
        return response()->json(array_values(json_decode($collection_fees_year_2022, true)));
    }

    public function getCollectionFeesByMember($id) {
        $id = (int)$id;
        $collection_fees = collect(DB::select("CALL DMSsp_LedgerCollectionFees('$id')"));
        $others = [];
        $annual = [];
        $member = PCRMember::where('id',$id)->first();
        $membership_2021 = 'Unpaid';
        $pma_2021 = 'Unpaid';
        $membership_2022 = 'Unpaid';
        $pma_2022 = 'Unpaid';

        if(count($collection_fees) != 0){
            foreach($collection_fees as $key => $fee){

                if($member->member_since == 2022){
                    if($fee->Year == 2021 || $fee->Description == 'PMA Membership Fee'){
                        unset($collection_fees[$key]);
                    }
                }else if($member->member_since === 2021){
                    if($fee->Description == 'MDMSI Election Eligibility' || $fee->Description == 'MDMSI Life Member Fee' 
                    || $fee->Description == 'Platform Computerisation Fee' || $fee->Description == 'PMA Membership Fee (For New Members)'){
                        unset($collection_fees[$key]);
                    }
                }
            }
            //group the fees
            foreach ($collection_fees as $collection_fee) {
                if($collection_fee->Description == 'MDMSI Membership Fee' && $collection_fee->Year == 2021){
                    $membership_2021 = $collection_fee->Order_Status;
                    array_push($annual,$collection_fee);
                }else if($collection_fee->Description == 'MDMSI Membership Fee' && $collection_fee->Year == 2022){
                    $membership_2022 = $collection_fee->Order_Status;
                    array_push($annual,$collection_fee);
                }else if($collection_fee->Description == 'PMA Membership Fee' && $collection_fee->Year == 2021){
                    $pma_2021 = $collection_fee->Order_Status;
                    array_push($annual,$collection_fee);
                }else if($collection_fee->Description == 'PMA Membership Fee' && $collection_fee->Year == 2022){
                    $pma_2022 = $collection_fee->Order_Status;
                    array_push($annual,$collection_fee);
                }else if($collection_fee->Description == 'Good Standing Certificate Fee' || $collection_fee->Description == 'Platform Computerization Fee'){
                    array_push($others,$collection_fee);
                }else{
                    if($collection_fee->Description == 'PMA Membership Fee (New Members)'){
                        if($member->member_since == 2022){
                            $collection_fee->Description = 'PMA Membership Fee';
                            $pma_2022 = $collection_fee->Order_Status;
                            array_push($annual,$collection_fee);
                        }
                    }
                }
            }

            foreach($others as $other_fee){
                if($other_fee->Description == 'Platform Computerization Fee' && $membership_2021 == 'Completed' && $pma_2021 == 'Completed'){
                    $other_fee->Order_Status = 'Completed';
                }
                // else if($other_fee->Description == 'Good Standing Certificate Fee' && $other_fee->Year == 2022 && $member->since=2021 && 
                // ($membership_2022 == 'Unpaid' && $pma_2022 == 'Unpaid') && ($membership_2021 == 'Completed' && $pma_2021 == 'Completed')){
                //     $other_fee->Order_Status = 'Disabled';
                // }else if($other_fee->Description == 'Good Standing Certificate Fee' && $other_fee->Year == 2022 && $member->since=2021 && 
                // ($membership_2022 == 'Completed' && $pma_2022 == 'Completed' || $membership_2022 == 'For Approval' || $pma_2022 == 'For Approval' ) 
                // && ($membership_2021 == 'Unpaid' || $pma_2021 == 'Unpaid' || $membership_2021 == 'For Approval' || $pma_2021 == 'For Approval')){
                //     $other_fee->Order_Status = 'Disabled';
                // }
            }
        }

        if(count($collection_fees) != 0){
            return response()->json(['annual_dues' => $annual, 'others' => $others]);
        }else{
            return response()->json(['message' => 'This member has no collection fees set.'], 404); 
        }
    }
}