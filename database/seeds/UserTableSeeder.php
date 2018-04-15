<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::query()->create([
            'username' => 'username',
            'nickname' => '杨霸吊',
            'password' => '111111'
        ]);
        $user->syncRoles('general_admin');
    }
}
