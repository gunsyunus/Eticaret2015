<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OrderPanelRequest extends Request
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
     * Order panel validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'surname'=>'required'
        ];
    }

    /**
     * Order panel validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '"Ad" alanı zorunludur.',
            'surname.required' => '"Soyadı" alanı zorunludur.'
        ];
    }
}
