<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SettingFileRequest extends Request
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
     * Setting file upload validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image'=>'mimes:png,jpg,jpeg,gif,pdf,rar|max:10240'
        ];
    }

    /**
     * Setting file upload messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'image.max' => '"Dosya" boyutu maksimum 10 MB olmalıdır.'
        ];
    }
}
