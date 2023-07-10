<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BannerRequest extends Request
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
     * Banner validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'image'=>'mimes:png,jpg,jpeg,gif|max:1024'
        ];
    }

    /**
     * Banner validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => '"Banner Adı" alanı zorunludur.',
            'image.max' => '"Resim" boyutu maksimum 1 MB olmalıdır.'
        ];
    }
}
