<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = \App\Models\Role::query()->create([
            'name' => 'super_admin',
            'display_name' => '超级管理员',
            'guard_name' => 'admin'
        ]);
        \App\Models\Role::query()->create([
            'name' => 'general_admin',
            'display_name' => '普通会员',
            'guard_name' => 'web'
        ]);
//        $role->syncPermissions(\App\Models\Permission::query()->select(['name'])->get()->toArray());
    }
}
