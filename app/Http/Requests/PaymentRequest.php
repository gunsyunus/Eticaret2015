<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PaymentRequest extends Request
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
     * Payment validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sort' => 'required'
        ];
    }

    /**
     * Payment validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'sort.required' => '"Sıralama" alanı zorunludur.'
        ];
    }
}
