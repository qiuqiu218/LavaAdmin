<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$this->namespace('Home\Auth')->group(function () {
    Route::get('login', 'LoginController@loginView')->name('home.login');
    Route::post('login', 'LoginController@login');
    // Authentication Routes...
    $this->get('logout', 'LoginController@logout')->name('home.logout');

// Registration Routes...
    $this->get('register', 'RegisterController@registerView')->name('home.register');
    $this->post('register', 'RegisterController@register');

// Password Reset Routes...
    $this->get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('home.password.request');
    $this->post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('home.password.email');
    $this->get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('home.password.reset');
    $this->post('password/reset', 'ResetPasswordController@reset');
});

$this->namespace('Home')->group(function () {
    Route::get('/', 'IndexController@index');
});