<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CountyRequest extends Request
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
     * County validation
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
     * County validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '"İlçe Adı" alanı zorunludur.'
        ];
    }
}
