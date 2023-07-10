<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewsletterCreateRequest extends Request
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
     * Newsletter create subscriber validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required|email|unique:newsletters'
        ];
    }

    /**
     * Newsletter create subscriber validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'E-Posta alanı zorunludur.',
        ];
    }
}
