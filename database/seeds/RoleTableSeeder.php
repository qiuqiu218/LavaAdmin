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
        $role = \App\Models\Admin\Role::query()->create([
            'name' => 'super_admin',
            'display_name' => '超级管理员',
            'guard_name' => 'admin'
        ]);
//        $role->syncPermissions(\App\Models\Admin\Permission::query()->select(['name'])->get()->toArray());
    }
}
