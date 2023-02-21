<?php

namespace App\Http\Requests\CollectionFee;

use Illuminate\Foundation\Http\FormRequest;

class CreateForMember extends FormRequest
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
            'member_id' => 'required|integer',
            'payment_type' => 'required|integer',
            'year' => 'required|string',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'status' => 'required|boolean',
        ];
    }
}
