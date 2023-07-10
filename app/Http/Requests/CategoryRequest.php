<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoryRequest extends Request
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
     * Category validation
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
     * Category validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '"Kategori Adı" alanı zorunludur.'
        ];
    }
}
