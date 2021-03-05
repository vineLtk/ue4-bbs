<?php

use App\Models\Category;

return [
    'title'   => '话题分类',
    'single'  => '分类',
    'model'   => Category::class,

    // 对 CRUD 动作的单独权限控制，通过返回布尔值来控制权限。
    'action_permissions' => [
        // 控制『新建按钮』的显示
        'create' => function ($model) {
            return true;
        },
        // 允许更新
        'update' => function ($model) {
            return true;
        },
        // 不允许删除
        'delete' => function ($model) {
            return Auth::user()->hasRole('Founder');
        },
        // 允许查看
        'view' => function ($model) {
            return true;
        },
    ],

    'columns' => [
        'id' => [
            'title'    => 'ID',
        ],
        'name' => [
            'title'    => '分类名称',
        ],
        'description' => [
            'title'    => '分类描述',
        ],
        'des_key' => [
            'title'    => '别名key',
        ],
        'is_nav' => [
            'title'    => '是否导航栏分类',
        ],
        'operation' => [
            'title'    => '管理',
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'name' => [
            'title' => '名称',
        ],
        'description' => [
            'title' => '描述',
            'type'  => 'textarea',
        ],
        'des_key' => [
            'title'    => '别名key',
        ],
        'is_nav' => [
            'title'    => '是否导航栏分类',
            'type'     => 'bool'
        ],
    ],

    'filters' => [
        'id' => [
            'title' => '分类 ID',
        ],
        'name' => [
            'title' => '名称',
        ],
        'description' => [
            'title' => '描述',
        ],
        'des_key' => [
            'title'    => '别名key',
        ],
        'is_nav' => [
            'title'    => '是否导航栏分类',
            'type'     => 'bool'
        ],
    ],

    'rules'   => [
        'name' => 'required|min:1|unique:categories',
        'description' => 'max:50'
    ],
    'messages' => [
        'name.unique'   => '分类名在数据库里有重复，请选用其他名称。',
        'name.required' => '请确保名字至少一个字符以上',
        'description:max'=>'描述最长为50个字符'
    ],
];