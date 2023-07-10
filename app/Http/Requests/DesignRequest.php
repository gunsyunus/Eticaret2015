<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DesignRequest extends Request
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
     * Design validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'logo' => 'mimes:png,jpg,jpeg,gif|max:3072',
            'footer_logo' => 'mimes:png,jpg,jpeg,gif|max:3072',
            'favicon_logo' => 'mimes:png,jpg,jpeg,gif|max:1024',
            'advert_image' => 'mimes:png,jpg,jpeg,gif|max:3072'
        ];
    }

    /**
     * Design validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'logo.max' => '"Resim - Logo" boyutu maksimum 3 MB olmalıdır.',
            'footer_logo.max' => '"Resim - Logo" boyutu maksimum 3 MB olmalıdır.',
            'favicon_logo.max' => '"Favicon" boyutu maksimum 1 MB olmalıdır.',
            'advert_image.max' => '"Resim" boyutu maksimum 3 MB olmalıdır.'
        ];
    }
}
