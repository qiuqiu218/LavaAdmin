<?php
/**
 * Created by PhpStorm.
 * User: 万鑫
 * Date: 2018/1/16
 * Time: 15:34
 */

namespace App\Observers\Admin;

use App\Models\Admin\Menu;
use App\Models\Admin\Table;
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
        $table->menu_table()->create([
            'parent_id' => $info->id,
            'title' => $table->display_name.'管理',
            'route' => $table->is_classify ? '' : 'admin/'.snake_case($table->name),
            'type' => 0
        ]);

        // 创建或删除二级栏目
        $this->createOrDeleteMenu($table);

        // 创建或删除分类字段
        $this->createOrDeleteField($table);
    }

    public function updated(Table $table)
    {
        // 创建或删除二级栏目
        $this->createOrDeleteMenu($table);

        // 创建或删除分类字段
        $this->createOrDeleteField($table);
    }

    public function deleted(Table $table)
    {
        // 删除所有与该表相关的栏目
        $table->menu_table()->delete();
        // 删除所有与该表相关的分类
        $table->classify_table()->delete();
        // 删除所有与该表关联的字段
        $table->field_table()->delete();
    }

    /**
     * @param Table $table
     */
    public function createOrDeleteMenu(Table $table)
    {
        // 找到顶级栏目
        $menu = $table->menu_table()->where('depth', 1)->first();

        // 如果开启分类则添加二级栏目,没开启则删除
        if ($table->is_classify) {
            // 如果表的分类开关是从关闭到打开，则创建二级分类，并将一级分类的路由置空
            if ($table->is_classify !== $table->getOriginal('is_classify')) {

                $table->menu_table()->create([
                    'parent_id' => $menu->id,
                    'title' => $table->display_name.'列表',
                    'route' => 'admin/'.snake_case($table->name),
                    'type' => 0
                ]);
                $table->menu_table()->create([
                    'parent_id' => $menu->id,
                    'title' => $table->display_name.'分类',
                    'route' => 'admin/classify?table_id='.$table->id,
                    'type' => 0
                ]);
                $menu->route = '';
                $menu->save();
            }
            // 如果未改变分类开关设置，只是修改了表名称则更新栏目名称
            // sql的replace方法，暂时只知道使用原生模式
            $old_display_name = $table->getOriginal('display_name');
            if ($old_display_name !== $table->display_name) {
                $sql = DB::raw("UPDATE menus SET title = REPLACE(title, '$old_display_name', '$table->display_name') WHERE table_id = $table->id");
                DB::update($sql);
            }
        } else {
            // 如果该二级分类还增加了子分类，会有冗余数据，暂时先这样，以后将信息管理栏目下的菜单都变为最多三级
            $table->menu_table()->where('depth', 2)->delete();
            $menu->route = 'admin/'.snake_case($table->name);
            $menu->save();
        }
    }

    /**
     * @param Table $table
     */
    public function createOrDeleteField(Table $table)
    {
        // 如果该表开启分类设置则在field表中新增一个分类字段，否则删除这个字段
        // 可能会有人自定义classify_id字段，以后将这个字段设置为不可自定义
        if ($table->is_classify) {
            if ($table->is_classify !== $table->getOriginal('is_classify')) {
                $table->field_table()->create([
                    'name' => 'classify_id',
                    'display_name' => '分类',
                    'element' => '联动下拉框',
                    'default_value' => '',
                    'belong' => 1,
                    'is_show' => 1,
                    'is_import' => 1,
                    'is_system' => 1
                ]);
            }
        } else {
            $table->field_table()->where('name', 'classify_id')->delete();
        }
    }
}