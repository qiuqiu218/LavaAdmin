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
                'children' => [
                    [
                        'title' => '黑色'
                    ],
                    [
                        'title' => '白色'
                    ]
                ]
            ],
            [
                'product_classify_id' => 1,
                'name' => 'size',
                'title' => '大小',
                'children' => [
                    [
                        'title' => 'S'
                    ],
                    [
                        'title' => 'M'
                    ],
                    [
                        'title' => 'L'
                    ],
                    [
                        'title' => 'XL'
                    ]
                ]
            ]
        ];

        foreach ($data as $item) {
            $attribute = \App\Models\ProductSpecAttribute::query()->create([
                'product_classify_id' => $item['product_classify_id'],
                'name' => $item['name'],
                'title' => $item['title']
            ]);
            $attribute->product_spec_attribute_value_table()->createMany($item['children']);
        }
    }
}
