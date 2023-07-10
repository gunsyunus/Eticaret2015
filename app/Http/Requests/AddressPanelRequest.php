<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddressPanelRequest extends Request
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
     * Panel adress crud validation
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
     * Panel adress crud validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => '"Adres Adı" alanı zorunludur.'
        ];
    }
}
