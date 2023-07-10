<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Crypt;

class NewsletterUpdateRequest extends Request
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
     * Newsletter create subscriber validation
     *
     * @return array
     */
    public function rules()
    {
        $id_subscriber = Crypt::decrypt($this->secret);        
        return [
            'email'=>'required|email|unique:newsletters,email,'.$id_subscriber.',id_subscriber',
        ];
    }

    /**
     * Newsletter create subscriber validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'E-Posta alanı zorunludur.',
        ];
    }
}
