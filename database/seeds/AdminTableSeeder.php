<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Models\Admin\Admin::query()->create([
            'username' => 'admin',
            'password' => '111111'
        ]);
        $admin->syncRoles('super_admin');
    }
}
