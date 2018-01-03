<?php
/**
 * Created by PhpStorm.
 * User: 万鑫
 * Date: 2017/12/26
 * Time: 11:39
 */

$this->namespace('Admin\Auth')->group(function () {
    Route::get('login', 'LoginController@loginView')->name('login');
    Route::post('login', 'LoginController@login');
    // Authentication Routes...
    $this->get('logout', 'LoginController@logout')->name('logout');

// Registration Routes...
    $this->get('register', 'RegisterController@registerView')->name('register');
    $this->post('register', 'RegisterController@register');

// Password Reset Routes...
    $this->get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'ResetPasswordController@reset');
});


$this->namespace('Admin')->middleware('auth:admin')->group(function () {
    Route::get('/', 'IndexController@index');
    Route::get('main', 'IndexController@main');
    Route::get('sidebar', 'IndexController@sidebar');
    Route::get('success', 'IndexController@successView')->name('success');
    Route::get('error', 'IndexController@errorView')->name('error');

    // 系统菜单
    Route::resource('menu', 'MenuController');
    Route::get('getTree', 'MenuController@getTree');
    // 管理员
    Route::resource('admin', 'AdminController');
    //角色管理
    Route::resource('role', 'RoleController');
    //权限管理
    Route::resource('permission', 'PermissionController');
});