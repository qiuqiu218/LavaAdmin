<?php
/**
 * Created by PhpStorm.
 * User: 万鑫
 * Date: 2018/1/16
 * Time: 15:34
 */

namespace App\Observers\Admin;

use App\Models\Menu;
use App\Models\Table;
use Illuminate\Support\Facades\DB;

class TableObserver {

    public function created(Table $table)
    {
        /**
         * 根据表模型创建栏目
         * XX管理
         *   XX列表
         */
        $this->createMenu($table);

        // 创建或删除分类栏目
        $this->createOrDeleteClassifyMenu($table);

        // 创建或删除评论栏目
        $this->createOrDeleteCommentMenu($table);

        // 创建或删除分类字段
        $this->createOrDeleteClassifyField($table);
    }

    public function updated(Table $table)
    {
        // 创建或删除分类栏目
        $this->createOrDeleteClassifyMenu($table);

        // 创建或删除评论栏目
        $this->createOrDeleteCommentMenu($table);

        // 创建或删除分类字段
        $this->createOrDeleteClassifyField($table);

        // 更新栏目名称
        $this->updateMenuName($table);
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
    public function createOrDeleteClassifyMenu(Table $table)
    {
        // 找到顶级栏目
        $menu = $table->menu_table()->where('depth', 1)->first();

        // 如果开启分类则添加二级栏目,没开启则删除
        if ($table->is_classify) {
            // 如果表的分类开关是从关闭到打开，则创建二级分类
            $table->menu_table()->firstOrCreate([
                'parent_id' => $menu->id,
                'title' => $table->display_name.'分类'
            ],[
                'route' => 'admin/classify?table_id='.$table->id,
                'type' => 0
            ]);
        } else {
            $table->menu_table()->where('title', $table->display_name.'分类')->delete();
        }
    }

    public function createOrDeleteCommentMenu(Table $table)
    {
        // 找到顶级栏目
        $menu = $table->menu_table()->where('depth', 1)->first();
        // 如果开启评论则添加二级栏目,没开启则删除
        if ($table->is_comment) {
            // 如果表的分类开关是从关闭到打开，则创建二级分类
            $table->menu_table()->firstOrCreate([
                'parent_id' => $menu->id,
                'title' => $table->display_name.'评论'
            ],[
                'route' => 'admin/comment?table_id='.$table->id,
                'type' => 0
            ]);
        } else {
            $table->menu_table()->where('title', $table->display_name.'评论')->delete();
        }
    }

    // 如果修改了表名称则更新栏目名称
    // sql的replace方法，暂时只知道使用原生模式
    public function updateMenuName(Table $table)
    {
        $old_display_name = $table->getOriginal('display_name');
        if ($old_display_name !== $table->display_name) {
            $sql = DB::raw("UPDATE menus SET title = REPLACE(title, '$old_display_name', '$table->display_name') WHERE table_id = $table->id");
            DB::update($sql);
        }
    }

    /**
     * @param Table $table
     */
    public function createOrDeleteClassifyField(Table $table)
    {
        // 如果该表开启分类设置则在field表中新增一个分类字段，否则删除这个字段
        // 可能会有人自定义classify_id字段，以后将这个字段设置为不可自定义
        if ($table->is_classify) {
            $table->field_table()->firstOrCreate([
                'name' => 'classify_id'
            ], [
                'display_name' => '分类',
                'element' => '联动下拉框',
                'default_value' => '',
                'belong' => 1,
                'is_show' => 1,
                'is_import' => 1,
                'is_system' => 1
            ]);
        } else {
            $table->field_table()->where('name', 'classify_id')->delete();
        }
    }

    // 根据表模型创建栏目
    public function createMenu(Table $table)
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
            'type' => 0
        ]);

        $table->menu_table()->create([
            'parent_id' => $menu->id,
            'title' => $table->display_name.'列表',
            'route' => 'admin/'.snake_case($table->name),
            'type' => 0
        ]);
    }
}