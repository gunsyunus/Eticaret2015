<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddressCustomerRequest extends Request
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
     * Customer address validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'address_1' => 'required',
            'phone' => 'required',
            'city_id' => 'required',
            'county_id' => 'required'
        ];
    }

    /**
     * Customer address validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => '"Adres Başlık" alanı zorunludur.',
            'address_1.required' => '"Adres" alanı zorunludur.',
            'phone.required' => '"Telefon" alanı zorunludur.',
            'city_id.required' => '"Şehir" alanı zorunludur.',
            'county_id.required' => '"İlçe" alanı zorunludur.'
        ];
    }
}
