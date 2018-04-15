<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
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
                'title' => '系统管理',
                'children' => [
                    [
                        'title' => '菜单管理',
                        'route' => 'admin/menu'
                    ],
                    [
                        'title' => '数据表管理',
                        'route' => 'admin/table'
                    ]
                ]
            ],
            [
                'title' => '用户管理',
                'children' => [
                    [
                        'title' => '管理员管理',
                        'children' => [
                            [
                                'title' => '管理员列表',
                                'route' => 'admin/admin'
                            ],
                            [
                                'title' => '管理员角色',
                                'route' => 'admin/role?guard_name=admin'
                            ],
                            [
                                'title' => '管理员权限',
                                'route' => 'admin/permission?guard_name=admin'
                            ]
                        ]
                    ],
                    [
                        'title' => '会员管理',
                        'children' => [
                            [
                                'title' => '会员列表',
                                'route' => 'admin/user'
                            ],
                            [
                                'title' => '会员角色',
                                'route' => 'admin/role?guard_name=web'
                            ],
                            [
                                'title' => '会员权限',
                                'route' => 'admin/permission?guard_name=web'
                            ]
                        ]
                    ]
                ]
            ],
            [
                'title' => '信息管理'
            ],
            [
                'title' => '商城管理',
                'children' => [
                    [
                        'title' => '产品管理',
                        'route' => 'admin/product'
                    ],
                    [
                        'title' => '规格管理',
                        'route' => 'admin/product_spec_attribute'
                    ],
                    [
                        'title' => '分类管理',
                        'route' => 'admin/product_classify'
                    ],
                    [
                        'title' => '订单管理',
                        'route' => 'admin/product_order'
                    ],
                    [
                        'title' => '退货管理',
                        'route' => 'admin/product_refund'
                    ],
                    [
                        'title' => '评论管理',
                        'route' => 'admin/product_comment'
                    ]
                ]
            ]
        ];
        foreach ($data as $item) {
            $root = \App\Models\Menu::query()->create([
                'title' => $item['title'],
                'type' => 1
            ]);
            if (isset($item['children'])) {
                foreach ($item['children'] as $item2) {
                    $root2 = \App\Models\Menu::query()->create([
                        'parent_id' => $root->id,
                        'title' => $item2['title'],
                        'route' => isset($item2['route']) ? $item2['route'] : null,
                        'type' => 1
                    ]);
                    if (isset($item2['children'])) {
                        foreach ($item2['children'] as $item3) {
                            \App\Models\Menu::query()->create([
                                'parent_id' => $root2->id,
                                'title' => $item3['title'],
                                'route' => $item3['route'],
                                'type' => 1
                            ]);
                        }
                    }
                }
            }
        }
    }
}
