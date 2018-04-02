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
            'name' => 'news',
            'display_name' => '新闻',
            'is_sub_table' => 1,
            'is_classify' => 1,
            'type' => 1
        ]);
        $data = [
            [
                'name' => 'title',
                'display_name' => '标题',
                'type' => '单行文本框',
                'belong' => 1,
                'is_show' => 1,
                'is_import' => 1
            ],
            [
                'name' => 'cover_img',
                'display_name' => '详情',
                'type' => '单图上传',
                'default_value' => '',
                'belong' => 1,
                'is_show' => 1,
                'is_import' => 1
            ],
            [
                'name' => 'checkbox',
                'display_name' => '下拉框',
                'type' => '下拉框',
                'default_value' => '',
                'option' => [
                    [
                        'value' => 1,
                        'text' => '文本1',
                        'active' => 0
                    ],
                    [
                        'value' => 2,
                        'text' => '文本2',
                        'active' => 0
                    ],
                    [
                        'value' => 3,
                        'text' => '文本3',
                        'active' => 0
                    ]
                ],
                'belong' => 2,
                'is_show' => 0,
                'is_import' => 1
            ]
        ];
        foreach ($data as $item) {
            $table->field_table()->create($item);
        }
    }
}