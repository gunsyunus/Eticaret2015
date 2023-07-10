<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerProfileUpdateRequest extends Request
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
     * Customer profile update validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'surname'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'city_id'=>'required'
        ];
    }

    /**
     * Customer profile update validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '"Adı" alanı zorunludur.',
            'surname.required' => '"Soyadı" alanı zorunludur.',
            'phone.required' => '"Telefon" alanı zorunludur.',
            'gender.required' => '"Cinsiyet" alanı zorunludur.',
            'city_id.required' => '"Şehir" alanı zorunludur.'
        ];
    }
}
