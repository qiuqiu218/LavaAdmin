<?php
/**
 * Created by PhpStorm.
 * User: 万鑫
 * Date: 2018/1/11
 * Time: 17:53
 */

namespace App\Http\Controllers\Traits;

trait Tools {

    protected $action = '';

    protected $controller = '';

    protected $prefix = '';

    public function __construct()
    {
        $action = request()->route()->getAction();
        $this->prefix = $action['prefix'] ? $action['prefix'] : 'home'; // 获取前缀
        $controller = class_basename($action['controller']); //返回给定类删除命名空间的类名 (见辅助函数)
        list($controller, $action) = explode('@', $controller);
        $this->controller = str_before($controller, 'Controller'); // 函数返回字符串中给定值之前的所有内容 (见辅助函数)
        $this->action = $action;
    }

    public function getModel()
    {
        $root = 'App\Models';
        return $root.'\\'.$this->prefix.'\\'.$this->controller;
    }
}