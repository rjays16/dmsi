<?php

namespace App\Http\Requests\CollectionFee;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class Create extends FormRequest
{
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    
    public function rules()
    {
        return [
            'payment_type' => 'required|integer',
            'year' => 'nullable|string',
            'start_period' => 'date|nullable',
            'end_period' => 'date|nullable',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'status' => 'required|boolean',
            'enable_deposit_slip' => 'required|boolean',
            'enable_ideapay_fee' => 'required|boolean',
            'valid_until' => 'date|nullable',
            'fiscal_period_id' => 'required|integer'
        ];
    }
    public function messages()
    {
        $startDate = Carbon::parse($this->start_period);
        $validEndDate = Carbon::parse($this->start_period)->addMonths(11);

        return [
            'end_period.date_equals' => 'Fiscal year end period of'. ' ' .$startDate->format('F Y'). ' ' .'is on'. ' '.$validEndDate->format('F Y')
        ];
    }
}