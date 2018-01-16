<?php
/**
 * Created by PhpStorm.
 * User: 万鑫
 * Date: 2018/1/16
 * Time: 15:34
 */

namespace App\Observers;

use App\Models\Admin\Menu;
use App\Models\Table;

class TableObserver {

    public function created(Table $table)
    {
        $info = Menu::query()
            ->whereNull('parent_id')
            ->where('title', '信息管理')
            ->first();
        Menu::query()->create([
            'parent_id' => $info->id,
            'title' => $table->display_name.'管理',
            'route' => 'admin/'.snake_case($table->name),
            'type' => 0
        ]);
    }

    public function updated(Table $table)
    {
        $menu = Menu::query()->where('title', $table->getOriginal('display_name').'管理')->first();
        $menu->title = $table->display_name.'管理';
        $menu->route = 'admin/'.snake_case($table->name);
        $menu->save();
    }

    public function deleted(Table $table)
    {
        $menu = Menu::query()->where('title', $table->display_name.'管理')->first();
        $menu->delete();
    }

}