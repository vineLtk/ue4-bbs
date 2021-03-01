<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE UPDATE
            case 'POST':
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title'=>'required|min:5|max:100',
                    'category_id'=>'required|numeric',
                    'body'=>'required|min:20'
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            }
        }
    }

    public function messages()
    {
        return [
            
            'title.required'=>'标题必填',
            'title.min'=> '标题至少5个字',
            'title.max'=> '标题至多100个字',

            'category_id.required'=>'分类必选',
            'category_id.numeric'=>'未知分类参数',

            'body.required'=>'内容必填',
            'body.min'=>'帖子内容至少20个字符',
            
            // Validation messages
        ];
    }
}
