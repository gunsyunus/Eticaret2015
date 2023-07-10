<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserCreateRequest extends Request
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
     * User create validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required|email|unique:users_a',
            'password'=>'required|min:8',
            'name' => 'required'
        ];
    }

    /**
     * User create validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'E-Posta alanı zorunludur.',
            'password.required' => '"Şifre" alanı zorunludur ve en az "8" karakter olmalıdır.',
            'password.min' => '"Şifre" alanı zorunludur ve en az "8" karakter olmalıdır.',
            'name.required' => '"Ad" alanı zorunludur.'
        ];
    }
}
