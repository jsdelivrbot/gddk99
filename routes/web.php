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

/*Route::get('/', function () {
    return view('welcome');
});*/

// 首页
Route::get('/','Mobile\IndexController@index');
Route::prefix('mobile')->get('/','Mobile\IndexController@index');
Route::prefix('mobile')->get('index','Mobile\IndexController@index');

// 内容页
Route::prefix('mobile')->get('full-content','Mobile\IndexController@FullContent');

// 个人列表
Route::prefix('mobile')->get('person-list','Mobile\IndexController@Person');
