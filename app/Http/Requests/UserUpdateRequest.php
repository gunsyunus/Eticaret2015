<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Crypt;

class UserUpdateRequest extends Request
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
        $id_user = Crypt::decrypt($this->secret);
        return [
            'email'=>'required|email|unique:users_a,email,'.$id_user.',id_user',
            'name' => 'required'
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
            'email.required' => 'E-Posta alanı zorunludur.',
            'name.required' => '"Ad" alanı zorunludur.'
        ];
    }
}
