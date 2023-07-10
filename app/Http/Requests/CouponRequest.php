<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CouponRequest extends Request
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
     * Cuopon validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required'
        ];
    }

    /**
     * Cuopon validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'code.required' => '"Kupon Kodu" alanı zorunludur.'
        ];
    }
}
