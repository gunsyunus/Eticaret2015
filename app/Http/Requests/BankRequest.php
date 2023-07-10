<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BankRequest extends Request
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
     * Bank validation.
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
