<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PageRequest extends Request
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
     * Page validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required'
        ];
    }

    /**
     * Page validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => '"Sayfa Başlık" alanı zorunludur.'
        ];
    }
}
