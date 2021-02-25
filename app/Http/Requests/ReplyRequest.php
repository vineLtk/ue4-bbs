<?php

namespace App\Http\Requests;

class ReplyRequest extends Request
{
    public function rules()
    {

        return [
            'content'=>"required|min:2|max:100"
        ];
            
    }

    public function messages()
    {
        return [
            // Validation messages
            'content'=>[
                'required'=>'请填写内容',
                'min'=>'内容最少2个字符',
                'max'=>'内容最多100个字符'
            ]
        ];
    }
}
