<?php

return [
    'custom' => [
        'name'=>[
            'unique'=>'用户名已被占用，请重新填写',
            'regex'=>'用户名只支持英文、数字、横杠和下划线。',
            'between'=>'用户名必须介于 3 - 25 个字符之间。',
            'required'=>'用户名不能为空。'
        ],
        'captcha'=>[
            'require'=>'请填写验证码',
            'captcha'=>'请输入正确的验证码'
        ]
    ]
];