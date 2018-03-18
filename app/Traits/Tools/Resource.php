<?php
/**
 * Created by PhpStorm.
 * User: wanxin
 * Date: 2018/1/14
 * Time: 下午4:57
 */

namespace App\Traits\Tools;

use Illuminate\Support\Facades\Route;

trait Resource {

    /**
     * 获取当前控制器名称
     * @return mixed
     */
    public function getController()
    {
        $baseController = class_basename(Route::currentRouteAction());
        $controller = explode("@", $baseController)[0];
        $controller = str_before($controller, 'Controller'); // 函数返回字符串中给定值之前的所有内容 (见辅助函数)
        $controller = snake_case($controller); // 字符串转蛇形
        return $controller;
    }

    /**
     * 获取当前方法名称
     * @return mixed
     */
    public function getAction()
    {
        $baseController = class_basename(Route::currentRouteAction());
        $action = explode("@", $baseController)[1];
        $action = snake_case($action); // 字符串转蛇形
        return $action;
    }

    /**
     * 获取当前模型名称
     * @return mixed
     */
    public function getModel()
    {
        return $this->getController();
    }

    /**
     * 获取当前路由前缀名称
     * @return mixed
     */
    public function getPrefix()
    {
        return Route::current()->getAction()['prefix'];
    }

    /**
     * 返回实例化的模型对象
     * @return mixed
     */
    public function getInstantiationModel()
    {
        $path = 'App\Models\\'.ucfirst($this->getPrefix()).'\\'.ucfirst($this->getController());
        return new $path();
    }

    /**
     * 获取模板对应的js文件
     * @param string $path
     * @return string
     */
    public function getJsPath($path = '')
    {
        $path = $path ? $path : $this->getResourcePath();
        $jsPath = 'js/'.$path.'.js';
        $jsBasePath = public_path($jsPath);
        if (is_file($jsBasePath)) {
            return '<script src="'.asset($jsPath).'?'.time().'"></script>';
        } else {
            return '';
        }
    }

    /**
     * 获取模板对应的css文件
     * @param string $path
     * @return string
     */
    public function getCssPath($path = '')
    {
        $path = $path ? $path : $this->getResourcePath();
        $cssPath = 'css/'.$path.'.css';
        $cssBasePath = public_path($cssPath);
        if (is_file($cssBasePath)) {
            return '<link rel="stylesheet" href="'.asset($cssPath).'?'.time().'">';
        } else {
            return '';
        }
    }

    /**
     * 获取视图路径
     * @return string
     */
    public function getViewPath()
    {
        return $this->getPrefix().'.'.$this->getController().'.'.$this->getAction();
    }

    /**
     * 获取当前视图的资源路径
     * @return mixed
     */
    public function getResourcePath()
    {
        return str_replace(".", "/", $this->getViewPath());
    }

    /**
     * 返回视图
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(array $data = [])
    {
        return view($this->getViewPath(), $data);
    }

    /**
     * 返回基本信息视图
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function baseInfoView(array $data = [])
    {
        return view($this->getPrefix().'.base_info.'.$this->getAction(), $data);
    }
}