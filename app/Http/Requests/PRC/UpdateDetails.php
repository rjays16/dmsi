<?php

namespace App\Http\Requests\PRC;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetails extends FormRequest
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
            'prc_number' => 'required|string',
            'prc_expiration' => 'required|string',
        ];
    }
}