<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OrderInquiryRequest extends Request
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
     * Order inquiry validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'n' => 'required'
        ];
    }

    /**
     * Order inquiry validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'n.required' => '"Kargo Takip" numarasını yazmanız zorunludur.'
        ];
    }
}
