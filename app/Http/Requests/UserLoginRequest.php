<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserLoginRequest extends Request
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
     * User login validation
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
     * User login validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.email' => '"Yönetici Adı" alanı zorunludur.',
            'name.password' => '"Şifre" alanı zorunludur.'
        ];
    }
}
