<?php
/**
 * Created by PhpStorm.
 * User: 万鑫
 * Date: 2018/1/16
 * Time: 16:20
 */

namespace App\Observers\Admin;

use App\Models\Permission;
use App\Models\Role;

class PermissionObserver {

    public function created(Permission $permission)
    {
        if ($permission->guard_name === 'admin') {
            $super_admin = Role::query()->where('name', 'super_admin')->first();
            $super_admin->givePermissionTo($permission->name);
        }
    }

    public function updated(Permission $permission)
    {
        if ($permission->getOriginal('name') !== $permission->name) {
            if ($permission->guard_name === 'admin') {
                $super_admin = Role::query()->where('name', 'super_admin')->first();
                $super_admin->revokePermissionTo($permission->getOriginal('name'));
                $super_admin->givePermissionTo($permission->name);
            }
        }
    }

    public function deleted(Permission $permission)
    {
        if ($permission->guard_name === 'admin') {
            $super_admin = Role::query()->where('name', 'super_admin')->first();
            $super_admin->revokePermissionTo($permission->getOriginal('name'));
        }
    }

}