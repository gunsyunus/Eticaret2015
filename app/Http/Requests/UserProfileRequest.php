<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserProfileRequest extends Request
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
     * User profile update validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|min:8'
        ];
    }

    /**
     * User profile update validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password.required' => '"Şifre" alanı zorunludur ve en az "8" karakter olmalıdır.',
            'password.min' => '"Şifre" alanı zorunludur ve en az "8" karakter olmalıdır.'
        ];
    }
}
