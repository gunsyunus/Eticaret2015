<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request
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
     * Product validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'image1' => 'mimes:png,jpg,jpeg,gif|max:3072',
            'image2' => 'mimes:png,jpg,jpeg,gif|max:3072'
        ];
    }

    /**
     * Product validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '"Ürün Adı" alanı zorunludur.',
            'image1.max' => '"Resim" boyutu maksimum 3 MB olmalıdır.',
            'image2.max' => '"İkinci Resim" boyutu maksimum 3 MB olmalıdır.'
        ];
    }
}
