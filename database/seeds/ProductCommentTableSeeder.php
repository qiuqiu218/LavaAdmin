<?php

use Illuminate\Database\Seeder;

class ProductCommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'product_order_detail_id' => 1,
            'product_order_id' => 1,
            'product_id' => 1,
            'user_id' => 1,
            'content' => '随便评论了下',
            'grade' => 5,
        ];

        for ($i = 0; $i < 3; $i++) {
            $data['grade'] -= $i;
            \App\Models\ProductComment::query()->create($data);
        }
    }
}
