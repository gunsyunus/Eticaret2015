<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BankRateGroupRequest extends Request
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
     * Bank rate group validation
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
     * Bank rate group validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '"Banka Adı" alanı zorunludur.',
            'image.max' => '"Resim" boyutu maksimum 1 MB olmalıdır.'
        ];
    }
}
