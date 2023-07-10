<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TaxRequest extends Request
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
            'name' => 'required|numeric'
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
            'name.required' => '"KDV Yüzdesi" alanı zorunludur.',
            'name.numeric' => '"KDV Yüzdesi" alanı rakam (0-9) olmalıdır.'
        ];
    }
}
