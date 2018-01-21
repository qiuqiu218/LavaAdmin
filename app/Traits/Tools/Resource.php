<?php
/**
 * Created by PhpStorm.
 * User: wanxin
 * Date: 2018/1/14
 * Time: 下午4:57
 */

namespace App\Traits\Tools;

trait Resource {

    protected $resource = [
        'route' => '',
        'action' => '',
        'controller' => '',
        'prefix' => ''
    ];

    public function getController()
    {
        if ($this->resource['controller']) {
            return $this->resource['controller'];
        }
        $baseController = class_basename($this->getRoute()['controller']);
        list($controller, $action) = explode('@', $baseController);
        $this->resource['controller'] = str_before($controller, 'Controller'); // 函数返回字符串中给定值之前的所有内容 (见辅助函数)
        return $this->resource['controller'];
    }

    public function getAction()
    {
        if ($this->resource['action']) {
            return $this->resource['action'];
        }
        $baseController = class_basename($this->getRoute()['controller']);
        list($controller, $action) = explode('@', $baseController);
        $this->resource['action'] = $action;
        return $this->resource['action'];
    }

    public function getPrefix()
    {
        if ($this->resource['prefix']) {
            return $this->resource['prefix'];
        }
        $route = $this->getRoute();
        return ucfirst($route['prefix'] ? $route['prefix'] : 'home');
    }

    public function getModel()
    {
        return $this->getController();
    }

    public function getInstantiationModel()
    {
        $path = 'App\Models\\'.$this->getPrefix().'\\'.$this->getController();
        return new $path();
    }

    public function getRoute()
    {
        return $this->resource['route'] ? $this->resource['route'] : request()->route()->getAction();
    }

    public function getJsPath()
    {
        $controller = snake_case($this->getController());
        $action = snake_case($this->getAction());
        $prefix = snake_case($this->getPrefix());
        $jsPath = 'js/'.$prefix.'/'.$controller.'/'.$action.'.js';
        $jsBasePath = public_path($jsPath);
        if (is_file($jsBasePath)) {
            return '<script src="'.asset($jsPath).'?'.time().'"></script>';
        } else {
            return '';
        }
    }

    public function getCssPath()
    {
        $controller = snake_case($this->getController());
        $action = snake_case($this->getAction());
        $prefix = snake_case($this->getPrefix());
        $cssPath = 'css/'.$prefix.'/'.$controller.'/'.$action.'.css';
        $cssBasePath = public_path($cssPath);
        if (is_file($cssBasePath)) {
            return '<link rel="stylesheet" href="'.asset($cssPath).'?'.time().'">';
        } else {
            return '';
        }
    }
}