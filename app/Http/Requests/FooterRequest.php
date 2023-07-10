<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FooterRequest extends Request
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
     * Footer validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }

    /**
     * Footer validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '"Menü Adı" alanı zorunludur.'
        ];
    }
}
