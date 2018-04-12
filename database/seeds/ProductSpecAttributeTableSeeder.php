<?php

use Illuminate\Database\Seeder;

class ProductSpecAttributeTableSeeder extends Seeder
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
                'product_classify_id' => 1,
                'name' => 'color',
                'title' => '颜色',
                'values' => [
                    '黑色',
                    '白色'
                ]
            ],
            [
                'product_classify_id' => 1,
                'name' => 'size',
                'title' => '大小',
                'values' => [
                    'S',
                    'M',
                    'L',
                    'XL'
                ]
            ]
        ];

        foreach ($data as $item) {
            \App\Models\ProductSpecAttribute::query()->create($item);
        }
    }
}
