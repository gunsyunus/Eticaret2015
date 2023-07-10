<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class OrderRequest extends Request
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
     * Order customer validation
     *
     * @return array
     */
    public function rules()
    {
        if (Auth::guest() or Auth::user()->role != 2) {
            $specialRules = [
                'name'=>'required',
                'surname'=>'required',
                'email'=>'required',
                'phone'=>'required',
                'gender'=>'required',
                'address_1' => 'required',
                'city_id' => 'required',
                'county_id' => 'required'
            ];
        } else {
            $specialRules = [
                'shipping_address_id' => 'required'
            ];
        }
        return $specialRules;
    }

    /**
     * Order customer validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '"Ad" alanı zorunludur.',
            'surname.required' => '"Soyadı" alanı zorunludur.',
            'email.required' => '"E-Posta" alanı zorunludur.',
            'phone.required' => '"Telefon" alanı zorunludur.',
            'gender.required' => '"Cinsiyet" alanı zorunludur.',
            'address_1.required' => '"Adres" alanı zorunludur.',
            'city_id.required' => '"İl" alanı zorunludur.',
            'county_id.required' => '"İlçe" alanı zorunludur.',
            'shipping_address_id.required' => '"Kargo" adres alanı zorunludur.'
        ];
    }
}
