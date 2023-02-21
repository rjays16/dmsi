<?php

namespace App\Http\Requests\FiscalPeriod;

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
        if(!is_null($this->start_period && $this->end_period)){
            $startDate = Carbon::parse($this->start_period);
            $validEndDate = $startDate->addMonths(11);
        }else {
            $validEndDate = null;
        }
        
        return [
            'id' => 'integer|nullable',
            'start_period' => 'date|nullable|before:end_period',
            'end_period' => 'date|nullable|date_equals:'. $validEndDate,
            'is_active' => 'required|boolean',
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
