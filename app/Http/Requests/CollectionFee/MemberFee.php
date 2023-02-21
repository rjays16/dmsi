<?php

namespace App\Http\Requests\CollectionFee;

use Illuminate\Foundation\Http\FormRequest;

class MemberFee extends FormRequest
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
            'collection_fee_id' => 'required|integer',
        ];
    }
}
