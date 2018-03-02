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
use Illuminate\Support\Facades\DB;

class TableObserver {

    public function created(Table $table)
    {
        // 获取信息管理菜单
        $info = Menu::query()
            ->whereNull('parent_id')
            ->where('title', '信息管理')
            ->first();

        // 根据新建的表创建一个菜单到信息管理菜单下
        $menu = $table->menu_table()->create([
            'parent_id' => $info->id,
            'title' => $table->display_name.'管理',
            'route' => $table->is_classify ? '' : 'admin/'.snake_case($table->name),
            'type' => 0
        ]);

        // 创建或删除二级分类菜单
        $this->createOrDeleteClassification($table, $menu);
    }

    public function updated(Table $table)
    {
        // 如果修改了table的display_name,则更新menu表中的title
        $old_display_name = $table->getOriginal('display_name');
        if ($old_display_name !== $table->display_name) {
            $sql = DB::raw("UPDATE menus SET title = REPLACE(title, '$old_display_name', '$table->display_name') WHERE table_id = $table->id");
            DB::update($sql);
        }

        // 获取当前table的第一级栏目
        $menu = $table->menu_table()->where('depth', 1)->first();

        // 创建或删除二级分类菜单
        $this->createOrDeleteClassification($table, $menu);
    }

    public function deleted(Table $table)
    {
        $table->menu_table()->delete();
    }

    public function createOrDeleteClassification($table, $prentMenu)
    {
        if ($table->is_classify) {
            if ($table->is_classify !== $table->getOriginal('display_name')) {
                $table->menu_table()->create([
                    'parent_id' => $prentMenu->id,
                    'title' => $table->display_name.'列表',
                    'route' => 'admin/'.snake_case($table->name),
                    'type' => 0
                ]);
                $table->menu_table()->create([
                    'parent_id' => $prentMenu->id,
                    'title' => $table->display_name.'分类',
                    'route' => 'admin/'.snake_case($table->name),
                    'type' => 0
                ]);
                $prentMenu->route = '';
                $prentMenu->save();
            }
        } else {
            $table->menu_table()->where('depth', 2)->delete();
            $prentMenu->route = 'admin/'.snake_case($table->name);
            $prentMenu->save();
        }
    }

}