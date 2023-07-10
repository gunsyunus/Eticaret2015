<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OptionRequest extends Request
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
     * Product option validation
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
     * Product option validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '"Seçenek" alanı zorunludur.'
        ];
    }
}
