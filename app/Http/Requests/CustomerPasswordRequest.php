<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerPasswordRequest extends Request
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
     * Customer password update validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password'=>'required|min:6'
        ];
    }

    /**
     * Customer password update validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'password.required' => '"Şifre" alanı zorunludur ve en az "6" karakter olmalıdır.',
            'password.min' => '"Şifre" alanı zorunludur ve en az "6" karakter olmalıdır.',
        ];
    }
}
