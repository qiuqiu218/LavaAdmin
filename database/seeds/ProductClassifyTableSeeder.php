<?php

use Illuminate\Database\Seeder;

class ProductClassifyTableSeeder extends Seeder
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
                'title' => '上衣',
                'children' => [
                    [
                        'title' => 'T恤'
                    ]
                ]
            ]
        ];
        foreach ($data as $item) {
            $root = \App\Models\ProductClassify::query()->create([
                'title' => $item['title']
            ]);
            if (isset($item['children'])) {
                foreach ($item['children'] as $item2) {
                    $root2 = \App\Models\ProductClassify::query()->create([
                        'parent_id' => $root->id,
                        'title' => $item2['title']
                    ]);
                }
            }
        }
    }
}
