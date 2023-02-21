<?php

namespace App\Http\Controllers;

use App\Models\CollectionFee;
use App\Models\PCRMember;
use App\Models\Ideapay;
use App\Models\FiscalPeriod;

use App\Http\Requests\FiscalPeriod\Create;


use App\Enums\IdeapayStatusEnum;
use App\Enums\OrderStatusEnum;

use App\Services\OrderService;
use App\Services\IdeapayService;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

use DB;
use Exception;

class FiscalPeriodController extends Controller
{
    public function getFiscalPeriods() {
        $fiscal_period = FiscalPeriod::paginate(20);
        return response()->json($fiscal_period);
    }

    public function getFiscalPeriodsNoPagination() {
        $fiscal_period = FiscalPeriod::get();
        return response()->json($fiscal_period);
    }

    public function showFiscalDetails($id) {
        $fiscal_period = FiscalPeriod::where('id', $id)->first();

        if(!is_null($fiscal_period)) {
            return response()->json($fiscal_period);
        } else {
            return response()->json(['message' => 'Fiscal period was not found.'], 404);
        }
    }

    public function getActive() {
        $active_fiscal_period = FiscalPeriod::active()->first();

        if(!is_null($active_fiscal_period)) {
            return response()->json($active_fiscal_period);
        } else {
            return response()->json(['message' => 'There is no active fiscal period yet.'], 404);
        }
    }

    public function create(Create $request) {
        $validated = $request->validated();
        $fiscal_period = FiscalPeriod::where('id', $validated["id"])->first();

        DB::beginTransaction();
        try {
            $fiscal_period = FiscalPeriod::create($validated);

            // Set the other active fiscal periods to inactive
            // Only one period should be active
            if($fiscal_period->is_active) {
                FiscalPeriod::query()
                    ->where('id', '<>', $fiscal_period->id)
                    ->active()
                    ->update(['is_active' => false]);
            }

            DB::commit();
            return response()->json([
                'message' => 'Successfully created fiscal period.'
            ]);
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(Request $request, $id) {
        $fiscal_period = FiscalPeriod::where('id', $id)->first();

        if(is_null($fiscal_period)) {
            return response()->json([
                'message' => 'Fiscal period was not found.'
            ], 404);
        }

        DB::beginTransaction();
        try {
            $fiscal_period->update($request->all());

            if($fiscal_period->is_active) {
                FiscalPeriod::query()
                    ->where('id', '<>', $fiscal_period->id)
                    ->active()
                    ->update(['is_active' => false]);
            }

            DB::commit();
            return response()->json([
                'message' => 'Successfully updated fiscal period.'
            ], 202);
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($id) {
        $fiscal_period = FiscalPeriod::where('id', $id)->first();

        if(!is_null($fiscal_period)) {
            DB::beginTransaction();
            try {
                $fiscal_period->delete();
                DB::commit();
                return response()->json(['status' => 'success', 'message' => 'Successfully deleted fiscal period.']);
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } else {
            return response()->json(['message' => 'Fiscal Period not found.'], 404);
        }
    }
}