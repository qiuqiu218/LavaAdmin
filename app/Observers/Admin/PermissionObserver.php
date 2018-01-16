<?php
/**
 * Created by PhpStorm.
 * User: 万鑫
 * Date: 2018/1/16
 * Time: 16:20
 */

namespace App\Observers\Admin;

use App\Models\Admin\Permission;
use App\Models\Admin\Role;

class PermissionObserver {

    public function created(Permission $permission)
    {
        $super_admin = Role::query()->where('name', 'super_admin')->first();
        $super_admin->givePermissionTo($permission->name);
    }

    public function updated(Permission $permission)
    {
        if ($permission->getOriginal('name') !== $permission->name) {
            $super_admin = Role::query()->where('name', 'super_admin')->first();
            $super_admin->revokePermissionTo($permission->getOriginal('name'));
            $super_admin->givePermissionTo($permission->name);
        }
    }

    public function deleted(Permission $permission)
    {
        $super_admin = Role::query()->where('name', 'super_admin')->first();
        $super_admin->revokePermissionTo($permission->getOriginal('name'));
    }

}