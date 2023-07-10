<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BannerElementRequest extends Request
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
     * Banner element validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'image' => 'mimes:png,jpg,jpeg,gif|max:3072'
        ];
    }

    /**
     * Banner element validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '"Açıklama" alanı zorunludur.',
            'image.max' => '"Resim" boyutu maksimum 3 MB olmalıdır.'
        ];
    }
}
