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

// 顾客列表详情
Route::prefix('mobile')->get('consultant-details','Mobile\ConsultantController@Index');

// 门店列表详情
Route::prefix('mobile')->get('shop-details','Mobile\ConsultantController@ShopDetails');

// 内容页
Route::prefix('mobile')->get('full-content','Mobile\IndexController@FullContent');

// 个人列表
Route::prefix('mobile')->get('person-list','Mobile\IndexController@Person');

// 推荐贷款，客户列表
Route::prefix('mobile')->get('client-list','Mobile\ClientController@ClientList');

// 网站建设服务页面
Route::prefix('mobile')->get('serve','Mobile\OtherController@Index');


// **************************** 后台端 *********************

// 首页
Route::prefix('admin')->get('/','Admin\IndexController@Index');
Route::prefix('admin')->get('index','Admin\IndexController@Index');

// 用户列表
Route::prefix('admin')->get('user-list','Admin\UserController@UserList');

// 合伙关系列表
Route::prefix('admin')->get('union-list','Admin\UserController@UnionList');

// 顾问列表
Route::prefix('admin')->get('consultant-list','Admin\ConsultantController@ConsultantList');
// 顾问存储
Route::prefix('admin')->get('consultant-store','Admin\ConsultantController@ConsultantStore');
// 顾问存储成功
Route::prefix('admin')->post('consultant-store','Admin\ConsultantController@ConsultantStoreOk');
// 顾问编辑
Route::prefix('admin')->get('consultant-edit/{id}','Admin\ConsultantController@ConsultantEdit');
// 顾问编辑成功
Route::prefix('admin')->post('consultant-edit','Admin\ConsultantController@ConsultantEditOk');
// 顾问删除
Route::prefix('admin')->get('consultant-del/{id}','Admin\ConsultantController@ConsultantDel');


// 店铺列表
Route::prefix('admin')->get('shop-list','Admin\ConsultantController@ShopList');