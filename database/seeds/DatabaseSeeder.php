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
             PermissionClassifyTableSeeder::class,
             MenuTableSeeder::class,
             RoleTableSeeder::class,
             AdminTableSeeder::class,
             TableTableSeeder::class
         ]);
    }
}
