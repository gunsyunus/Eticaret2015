<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerLoginRequest extends Request
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
     * Customer login validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }

    /**
     * Customer login validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => '"E-Posta" alanı zorunludur.',
            'password.required' => '"Şifre" alanı zorunludur.'
        ];
    }
}
