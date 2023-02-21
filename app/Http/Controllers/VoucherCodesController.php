<?php

namespace App\Http\Controllers;

use App\Models\VoucherCode;
use Illuminate\Http\Request;

class VoucherCodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.dashboard');
    }

    public function getAll() {
        $model = new VoucherCode();
        $data = $model->getAll();

        return response()->json($data);
    }

    public function create(Request $request) {
        $formData = $request->data;
        $data = VoucherCode::create([
            'voucher_code' => $formData['voucher_code'],
            'description' => $formData['description'],
            'discount_amt' => $formData['discount_amt'],
            'max_usage' => $formData['max_usage'],
            'note' => $formData['note']
        ]);

        return response()->json($data);
    }

    public function update(Request $request) {
        $formData = $request->data;
        
        $data = VoucherCode::where('id', $formData['id'])
        ->update([
            'voucher_code' => $formData['voucher_code'],
            'description' => $formData['description'],
            'discount_amt' => $formData['discount_amt'],
            'max_usage' => $formData['max_usage'],
            'note' => $formData['note']
        ]);

        return response()->json($data);
    }

    public function delete(Request $request) {
        $data = VoucherCode::find($request->id);
        if($data) {
            $data->delete();
        }

        return response()->json($data);
    }
}
