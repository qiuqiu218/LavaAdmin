<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class StaticResource
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $action = app('request')->route()->getAction();
        $prefix = $action['prefix'] ? $action['prefix'] : 'home'; // 获取前缀
        $controller = class_basename($action['controller']); //返回给定类删除命名空间的类名 (见辅助函数)
        list($controller, $action) = explode('@', $controller);
        $controller = str_before($controller, 'Controller'); // 函数返回字符串中给定值之前的所有内容 (见辅助函数)
        $controller = snake_case($controller); // 函数将给定的字符串转换为「蛇形命名」
        $action = snake_case($action);

        // 判断当前页面的js文件是否存在
        $jsPath = 'js/'.$prefix.'/'.$controller.'/'.$action.'.js';
//        dd($jsPath);
        $jsBasePath = public_path($jsPath);
        if (is_file($jsBasePath)) {
            $jsPath = '<script src="'.asset($jsPath).'?'.time().'"></script>';
        } else {
            $jsPath = '';
        }

        // 判断当前页面的css文件是否存在
        $cssPath = 'css/'.$prefix.'/'.$controller.'/'.$action.'.css';
        $cssBasePath = public_path($cssPath);
        if (is_file($cssBasePath)) {
            $cssPath = '<link rel="stylesheet" href="'.asset($cssPath).'?'.time().'">';
        } else {
            $cssPath = '';
        }

        View::share([
            'jsPath' => $jsPath,
            'cssPath' => $cssPath
        ]);

        return $next($request);
    }
}
