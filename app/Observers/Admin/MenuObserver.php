<?php
/**
 * Created by PhpStorm.
 * User: 万鑫
 * Date: 2018/1/5
 * Time: 14:43
 */

namespace App\Observers\Admin;

use App\Models\Admin\Menu;
use App\Models\Admin\Permission;
use App\Models\Admin\PermissionClassify;

class MenuObserver {

    /**
     * @param Menu $menu
     */
    public function saved(Menu $menu)
    {
        $permission_classify = PermissionClassify::query()->where('name', '菜单管理')->first();
        Permission::query()->updateOrCreate([
            'name' => 'menu_'.$menu->id
        ], [
            'name' => 'menu_'.$menu->id,
            'display_name' => $menu->title,
            'sort' => $menu->sort,
            'guard_name' => 'admin',
            'permission_classify_id' => $permission_classify->id
        ]);
    }

    /**
     * @param Menu $menu
     */
    public function deleted(Menu $menu)
    {
        Permission::query()->where('name', 'menu_'.$menu->id)->delete();
    }
}