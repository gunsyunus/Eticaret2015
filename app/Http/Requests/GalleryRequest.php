<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GalleryRequest extends Request
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
     * Product gallery validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'images.*' => 'required|mimes:png,jpg,jpeg,gif|max:3072',
        ];
    }

    /**
     * Product gallery validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'images.*.required' => 'Lütfen "Gözat" butonuna tıklayıp resim seçiniz.',
            'images.*.max' => '"Resim" boyutu maksimum 3 MB olmalıdır.'
        ];
    }
}
