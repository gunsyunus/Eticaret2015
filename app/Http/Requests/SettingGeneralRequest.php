<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SettingGeneralRequest extends Request
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
     * Setting validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'email_admin' => 'email',
            'email_info' => 'email',
            'product_small_width' => 'numeric|max:400',
            'product_small_height' => 'numeric|max:400',
            'product_big_width' => 'numeric|max:1250',
            'product_big_height' => 'numeric|max:1250',
        ];
    }

    /**
     * Setting validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => '"Site Başlık" alanı zorunludur.',
            'product_small_width.max' => '"Ürün Resim (Küçük-Genişlik)" alanı :max değerinden büyük olmamalıdır.',
            'product_small_height.max' => '"Ürün Resim (Küçük-Yükseklik)" alanı :max değerinden büyük olmamalıdır.',
            'product_big_width.max' => '"Ürün Resim (Büyük-Genişlik)" alanı :max değerinden büyük olmamalıdır.',
            'product_big_height.max' => '"Ürün Resim (Büyük-Yükseklik)" alanı :max değerinden büyük olmamalıdır.',
        ];
    }
}
