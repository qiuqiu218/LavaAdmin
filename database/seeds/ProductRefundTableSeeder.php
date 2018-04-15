<?php

use Illuminate\Database\Seeder;

class ProductRefundTableSeeder extends Seeder
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
            'product_order_detail_id' => 1,
            'total_fee' => 100,
            'total_quantity' => 2,
            'status' => 1,
            'content' => '就是想退货',
            'images' => []
        ];
        for ($i = 1; $i < 4; $i++) {
            $data['status'] = ($i * 2) - 1;
            $data['product_order_detail_id'] = $i;
            \App\Models\ProductRefund::query()->create($data);
        }
    }
}
