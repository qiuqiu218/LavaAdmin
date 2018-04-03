<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 20; $i++) {
            $news = \App\Models\Admin\News::query()->create([
                'title' => $i
            ]);
            $news->subTable()->create([
                'checkbox' => 1
            ]);
        }
    }
}
