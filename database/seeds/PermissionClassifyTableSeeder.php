<?php

use Illuminate\Database\Seeder;

class PermissionClassifyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => '系统权限',
                'children' => [
                    [
                        'name' => 'menu_create',
                        'display_name' => '添加菜单'
                    ],
                    [
                        'name' => 'menu_edit',
                        'display_name' => '编辑菜单'
                    ],
                    [
                        'name' => 'menu_delete',
                        'display_name' => '删除菜单'
                    ],
                    [
                        'name' => 'table_create',
                        'display_name' => '添加数据表'
                    ],
                    [
                        'name' => 'table_edit',
                        'display_name' => '编辑数据表'
                    ],
                    [
                        'name' => 'table_delete',
                        'display_name' => '删除数据表'
                    ]
                ]
            ],
            [
                'name' => '用户权限',
                'children' => [
                    [
                        'name' => 'admin_create',
                        'display_name' => '添加管理员'
                    ],
                    [
                        'name' => 'admin_edit',
                        'display_name' => '编辑管理员'
                    ],
                    [
                        'name' => 'admin_delete',
                        'display_name' => '删除管理员'
                    ],
                    [
                        'name' => 'user_create',
                        'display_name' => '添加会员'
                    ],
                    [
                        'name' => 'user_edit',
                        'display_name' => '编辑会员'
                    ],
                    [
                        'name' => 'user_delete',
                        'display_name' => '删除会员'
                    ],
                    [
                        'name' => 'role_create',
                        'display_name' => '添加角色'
                    ],
                    [
                        'name' => 'role_edit',
                        'display_name' => '编辑角色'
                    ],
                    [
                        'name' => 'role_delete',
                        'display_name' => '删除角色'
                    ],
                    [
                        'name' => 'permission_create',
                        'display_name' => '添加权限'
                    ],
                    [
                        'name' => 'permission_edit',
                        'display_name' => '编辑权限'
                    ],
                    [
                        'name' => 'permission_delete',
                        'display_name' => '删除权限'
                    ]
                ]
            ],
            [
                'name' => '菜单管理'
            ]
        ];
        foreach ($data as $item) {
            $classify = \App\Models\Admin\PermissionClassify::query()->create([
                'name' => $item['name']
            ]);
            if (isset($item['children'])) {
                foreach ($item['children'] as $item2) {
                    $classify->permission()->create([
                        'name' => $item2['name'],
                        'display_name' => $item2['display_name'],
                        'guard_name' => 'admin'
                    ]);
                }
            }
        }

    }
}
