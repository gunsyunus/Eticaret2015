<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Session;

class OrderCompleteRequest extends Request
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
     * Order complete validation
     *
     * @return array
     */
    public function rules()
    {
        if (Session::get('SECURE_CONTROL') == 3) {
            $specialRules = [
            ];
        } else {
            $specialRules = [
                'payment'=>'required',
                'agreement'=>'required'
            ];
        }
        return $specialRules;
    }

    /**
     * Order complete validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'payment.required' => '"Ödeme Tipi" alanı zorunludur.',
            'agreement.required' => '"Satış Sözleşmesini" kabul etmeniz zorunludur.'
        ];
    }
}
