<?php

namespace App\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $action = app('request')->route()->getAction();
//        $controller = class_basename($action['controller']);
//        list($controller, $action) = explode('@', $controller);
//        $controller = str_before($controller, 'Controller');
//        $controller = snake_case($controller);
//
//        View::share([
//            'path' => public_path('admin/sidebar/create.js'),
//            'url' => Request::path(),
//            'controller' => $controller,
//            'action' => $action
//        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
