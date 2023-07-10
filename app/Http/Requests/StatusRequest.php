<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StatusRequest extends Request
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
     * Status validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }

    /**
     * Status validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '"Sipariş Durumu" alanı zorunludur.'
        ];
    }
}
