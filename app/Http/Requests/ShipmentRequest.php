<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ShipmentRequest extends Request
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
     * Shipment validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'image'=>'mimes:png,jpg,jpeg,gif|max:1024'
        ];
    }

    /**
     * Shipment validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '"Kargo Adı" alanı zorunludur.',
            'image.max' => '"Resim" boyutu maksimum 1 MB olmalıdır.'
        ];
    }
}
