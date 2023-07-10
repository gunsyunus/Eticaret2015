<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RateRequest extends Request
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
     * City validation
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
     * City validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '"Döviz Cinsi" alanı zorunludur.'
        ];
    }
}
