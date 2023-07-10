<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Crypt;

class CustomerUpdateRequest extends Request
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
     * Customer panel update validation
     *
     * @return array
     */
    public function rules()
    {
        $id_user = Crypt::decrypt($this->secret);
        return [
            'email'=>'required|email|unique:users_a,email,'.$id_user.',id_user',
            'name'=>'required',
            'surname'=>'required'
        ];
    }

    /**
     * Customer panel update validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'E-Posta alanı zorunludur.',
            'name.required' => '"Adı" alanı zorunludur.',
            'surname.required' => '"Soyadı" alanı zorunludur.'
        ];
    }
}
