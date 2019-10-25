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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('admin.logout');
    Route::middleware('auth.admin:admin')->name('admin.')->group(function () {
        Route::get('/', 'DashboardController@index');
        Route::get('/index', 'IndexController@index');
        //管理员管理
        Route::get('/user_list', 'UserController@user_list');
        Route::match(['get', 'post'],'/user_add', 'UserController@add');
        Route::match(['get', 'post'],'/user_edit', 'UserController@edit');
        //
    });
});


