<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CartRequest extends Request
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
     * Customer login validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
