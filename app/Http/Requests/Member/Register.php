<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
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
            'email' => 'required|string|max:191',
            'password' => 'required|string|max:191',
            'first_name' => 'required|string|max:191',
            'middle_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'prc_number' => 'required|string|max:191',
            'contact_number' => 'required|string|max:191',
            'address' => 'required|string|max:900',
            'is_trainee' => 'integer'
        ];
    }
}