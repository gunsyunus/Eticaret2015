<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerCreateRequest extends Request
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
     * Customer create validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required|email|unique:users_a',
            'password'=>'required|min:6',
            'name'=>'required',
            'surname'=>'required'
        ];
    }

    /**
     * Customer create validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'E-Posta alanı zorunludur.',
            'password.required' => '"Şifre" alanı zorunludur ve en az "6" karakter olmalıdır.',
            'password.min' => '"Şifre" alanı zorunludur ve en az "6" karakter olmalıdır.',
            'name.required' => '"Adı" alanı zorunludur.',
            'surname.required' => '"Soyadı" alanı zorunludur.'
        ];
    }
}
