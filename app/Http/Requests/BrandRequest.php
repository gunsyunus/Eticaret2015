<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BrandRequest extends Request
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
     * Brand validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bname' => 'required'
        ];
    }

    /**
     * Brand validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'bname.required' => '"Marka Adı" alanı zorunludur.'
        ];
    }
}
