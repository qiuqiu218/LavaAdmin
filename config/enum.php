<?php
/**
 * Created by PhpStorm.
 * User: wanxin
 * Date: 2017/12/30
 * Time: 下午8:50
 */

return [
    'Menu' => [
        'type' => [
            'default' => '通用菜单',
            'data' => [
                0 => '通用菜单',
                1 => '系统菜单'
            ]
        ]
    ],
    'Admin' => [
        'search' => [
            'default' => '用户名',
            'data' => [
                'username' => '用户名',
                'nickname' => '昵称',
                'email' => 'Email',
                'phone' => '手机号'
            ]
        ]
    ],
    'Field' => [
        'element' => [
            'default' => '单行文本框',
            'data' => [
                'text' => '单行文本框',
                'password' => '密码框',
                'select' => '下拉框',
                'linkage_select' => '联动下拉框',
                'radio' => '单选框',
                'checkbox' => '复选框',
                'textarea' => '文本框',
                'editor' => '编辑器',
                'img' => '单图上传',
                'imgs' => '多图上传',
                'file' => '单文件上传',
                'files' => '多文件上传',
                'date' => '日期'
            ]
        ],
        'type' => [
            'default' => 'varchar',
            'data' => [
                'varchar',
                'char',
                'text',
                'mediumText',
                'longText',
                'tinyInt',
                'smallInt',
                'int',
                'bigInt',
                'json',
                'decimal',
                'double',
                'float',
                'date',
                'datetime',
                'timestamp'
            ]
        ]
    ],
    'ProductOrder' => [
        'status' => [
            1 => '待支付', // 已下单
            5 => '待发货', // 已支付
            10 => '待收货', // 已发货
            15 => '待评价', // 已收货 可申请退款
            20 => '已完成' // 已评价
        ]
    ],
    'ProductRefund' => [
        'status' => [
            1 => '申请中',
            3 => '退款成功',
            5 => '退款关闭'
        ]
    ]
];