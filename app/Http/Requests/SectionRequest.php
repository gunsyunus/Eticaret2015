<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SectionRequest extends Request
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
     * Page section validation
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
     * Page section validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '"Bölüm Adı" alanı zorunludur.'
        ];
    }
}
