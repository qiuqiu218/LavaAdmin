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
        $table = \App\Models\Table::query()->create([
            'name' => 'News',
            'display_name' => '新闻',
            'is_sub_table' => 0,
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
            ]
        ];
        if ($table->is_classify) {
            $data[] = [
                'name' => 'classify_id',
                'display_name' => '分类',
                'type' => '联动下拉框',
                'default_value' => '',
                'belong' => 1,
                'is_show' => 1,
                'is_import' => 1,
                'is_system' => 1
            ];
        }
        foreach ($data as $item) {
            $table->field()->create($item);
        }
    }
}