<?php

use Illuminate\Database\Seeder;

class ProductOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'user_id' => 1,
            'out_trade_no' => time(),
            'total_fee' => 100,
            'total_quantity' => 2,
            'status' => 1
        ];

        $product = [
            'product_id' => 1,
            'title' => '产品名称',
            'cover_img' => '',
            'original_price' => '10.00',
            'current_price' => '10.00',
            'quantity' => 2,
            'spec' => [
                [
                    'text' => '颜色',
                    'name' => 'color',
                    'value' => '黑色'
                ],
                [
                    'text' => '大小',
                    'name' => 'size',
                    'value' => 'XL'
                ]
            ]
        ];
        for ($i = 0; $i < 4; $i++) {
            $res = ($i * 5);
            $data['status'] = $res > 0 ? $res : 1;
            $root = \App\Models\ProductOrder::query()->create($data);
            $root->product_order_detail_table()->create($product);
        }
    }
}
