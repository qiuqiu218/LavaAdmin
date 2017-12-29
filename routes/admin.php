<?php
/**
 * Created by PhpStorm.
 * User: 万鑫
 * Date: 2017/12/26
 * Time: 11:39
 */

$this->namespace('Admin\Auth')->group(function () {
    // Authentication Routes...
    $this->get('login', 'LoginController@showLoginForm')->name('login');
    $this->post('login', 'LoginController@login');
    $this->post('logout', 'LoginController@logout')->name('logout');

// Registration Routes...
    $this->get('register', 'RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'RegisterController@register');

// Password Reset Routes...
    $this->get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'ResetPasswordController@reset');
});


$this->namespace('Admin')->group(function () {
    Route::get('/', 'IndexController@index');
    Route::get('index/menu', 'IndexController@Menu');
    Route::resource('menu', 'MenuController');
    Route::get('getTree', 'MenuController@getTree');
});