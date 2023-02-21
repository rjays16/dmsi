<?php

namespace App\Http\Requests\CollectionFee;

use Illuminate\Foundation\Http\FormRequest;

class AddToActiveMembers extends FormRequest
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
            'collection_fee_id' => 'required|integer',
        ];
    }
}
