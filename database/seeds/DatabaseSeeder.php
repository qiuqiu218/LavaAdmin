<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             RoleTableSeeder::class,
             PermissionClassifyTableSeeder::class,
             MenuTableSeeder::class,
             AdminTableSeeder::class,
             UserTableSeeder::class,
             ProductClassifyTableSeeder::class,
             ProductSpecAttributeTableSeeder::class,
             ProductOrderTableSeeder::class,
             ProductRefundTableSeeder::class
//             ProductCommentTableSeeder::class
         ]);
    }
}
