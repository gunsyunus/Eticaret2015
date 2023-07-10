<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BankRateRequest extends Request
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
     * Bank rate validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'installment' => 'required',
            'rate' => 'required'
        ];
    }

    /**
     * Bank rate validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'installment.required' => '"Taksit Sayısı" alanı zorunludur.',
            'rate.required' => '"Komisyon Oranı" alanı zorunludur.'
        ];
    }
}
