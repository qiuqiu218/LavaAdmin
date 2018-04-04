<?php

use Illuminate\Database\Seeder;

class TableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = \App\Models\Admin\Table::query()->create([
            'name' => 'product',
            'display_name' => '产品',
            'is_sub_table' => 1,
            'is_classify' => 1,
            'type' => 1
        ]);
        $data = [
            [
                'name' => 'title',
                'display_name' => '标题',
                'element' => '单行文本框',
                'type' => 'varchar',
                'type_length' => 120,
                'is_show' => 1
            ],
            [
                'name' => 'cover_img',
                'display_name' => '封面图',
                'element' => '单图上传',
                'type' => 'varchar',
                'type_length' => 255,
                'is_show' => 1
            ],
            [
                'name' => 'images',
                'display_name' => '图集',
                'element' => '多图上传',
                'type' => 'json',
                'belong' => 2
            ],
            [
                'name' => 'original_price',
                'display_name' => '原价',
                'element' => '单行文本框',
                'type' => 'decimal',
                'type_length' => '7,2'
            ],
            [
                'name' => 'current_price',
                'display_name' => '现价',
                'element' => '单行文本框',
                'type' => 'decimal',
                'type_length' => '7,2',
                'is_show' => 1
            ],
            [
                'name' => 'color',
                'display_name' => '颜色',
                'element' => '复选框',
                'type' => 'json',
                'option' => [
                    [
                        'value' => 1,
                        'text' => '黑色',
                        'active' => 0
                    ],
                    [
                        'value' => 2,
                        'text' => '白色',
                        'active' => 0
                    ]
                ],
                'belong' => 2
            ],
            [
                'name' => 'size',
                'display_name' => '尺码',
                'element' => '复选框',
                'type' => 'json',
                'option' => [
                    [
                        'value' => 1,
                        'text' => 'S',
                        'active' => 0
                    ],
                    [
                        'value' => 2,
                        'text' => 'M',
                        'active' => 0
                    ],
                    [
                        'value' => 3,
                        'text' => 'L',
                        'active' => 0
                    ],
                    [
                        'value' => 4,
                        'text' => 'XL',
                        'active' => 0
                    ]
                ],
                'belong' => 2
            ],
            [
                'name' => 'content',
                'display_name' => '商品描述',
                'element' => '编辑器',
                'type' => 'text',
                'belong' => 2
            ]
        ];
        foreach ($data as $item) {
            $table->field_table()->create($item);
        }
    }
}
