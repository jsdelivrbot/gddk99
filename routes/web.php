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

// **************************** 微信端 *********************

// 首页
Route::get('/','Mobile\IndexController@index');
Route::prefix('mobile')->get('/','Mobile\IndexController@index');
Route::prefix('mobile')->get('index','Mobile\IndexController@index');

// 内容页
Route::prefix('mobile')->get('full-content','Mobile\IndexController@FullContent');

// 个人列表
Route::prefix('mobile')->get('person-list','Mobile\IndexController@Person');


// **************************** 后台端 *********************

// 首页
Route::prefix('admin')->get('/','Admin\IndexController@Index');
Route::prefix('admin')->get('index','Admin\IndexController@Index');

// 用户列表
Route::prefix('admin')->get('user-list','Admin\UserController@UserList');

// 合伙关系列表
Route::prefix('admin')->get('union-list','Admin\UserController@UnionList');