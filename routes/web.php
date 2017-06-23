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

// **************************** PC端 *********************

Route::get('/','Home\IndexController@index');


// **************************** 微信端 *********************

//微信提交Token验证
Route::any('weixin', 'WechatController@serve');
//微信登陆
Route::any('login', 'WechatController@login');
//微信获取授权
Route::any('oauth_callback', 'WechatController@oauth_callback');

//微信菜单导航
Route::any('menu', 'WechatController@Menu');

// 微信开放平台
Route::prefix('mobile')->get('wx-login','Mobile\LoginController@WxLogin');
Route::prefix('mobile')->get('wx-callback','Mobile\LoginController@WxCallback');

// 首页
//Route::get('/','Mobile\IndexController@index');
Route::prefix('mobile')->get('/','Mobile\IndexController@index');
Route::prefix('mobile')->get('index','Mobile\IndexController@index');

// 顾客列表详情
Route::prefix('mobile')->middleware('active.nav')->get('consultant-details/{id}','Mobile\ConsultantController@Index');

// 门店列表详情
Route::prefix('mobile')->middleware('active.nav')->get('shop-details/{id}','Mobile\ConsultantController@ShopDetails');

// 内容页
Route::prefix('mobile')->middleware('active.nav')->get('full-content','Mobile\IndexController@FullContent');

// 会员个人列表
Route::prefix('mobile')->middleware('active.nav')->get('/person-list','Mobile\MemberController@Person');

// 会员个人编辑
Route::prefix('mobile')->middleware('active.nav')->get('/person-edit/{member_id}','Mobile\MemberController@PersonEdit');
// 会员个人编辑存储
Route::prefix('mobile')->middleware('active.nav')->post('/person-edit','Mobile\MemberController@PersonEditStore');

//会员用户扫码跳转页面
Route::prefix('mobile')->middleware('active.nav')->get('/member-user-invite','Mobile\MemberController@MemberUserInvite');
Route::prefix('mobile')->middleware('active.nav')->post('/member-user-invite','Mobile\MemberController@MemberUserInviteStore');

// 发送验证码
Route::prefix('mobile')->middleware('active.nav')->post('/send','Mobile\MemberController@Send');

// 推荐贷款，客户列表
Route::prefix('mobile')->middleware('active.nav')->get('client-list','Mobile\ClientController@ClientList');
Route::prefix('mobile')->middleware('active.nav')->post('client-list','Mobile\ClientController@ClientListStore');

// 客户列表，生成海报页面
Route::prefix('mobile')->middleware('active.nav')->get('client-poster-list','Mobile\ClientController@ClientPoster');

// 客户列表，生成海报列表-邀请
Route::prefix('mobile')->middleware('active.nav')->get('client-poster-invite','Mobile\ClientController@ClientPosterInvite');
Route::prefix('mobile')->middleware('active.nav')->post('client-poster-invite','Mobile\ClientController@ClientPosterInviteStore');

// 我的经纪人列表
Route::prefix('mobile')->middleware('active.nav')->get('/union-list/{member_id}','Mobile\MemberController@UnionList');

// 方案详情
Route::prefix('mobile')->middleware('active.nav')->get('plan-details/{id}','Mobile\PlanController@Detail');

// 生成海报页面
Route::prefix('mobile')->middleware('active.nav')->get('poster-list','Mobile\MemberController@Poster');

// 网站建设服务页面
Route::prefix('mobile')->middleware('active.nav')->get('serve','Mobile\OtherController@Index');


// **************************** 后台端 *********************

//登录页
Route::prefix('admin')->get('/','Admin\IndexController@Login');
Route::prefix('admin')->get('login','Admin\IndexController@Login');
Route::prefix('admin')->post('login','Admin\IndexController@LoginSignin');

Route::prefix('admin')->get('/logout', 'Admin\IndexController@logout');

// 首页
Route::prefix('admin')->middleware('admin.login')->get('/','Admin\IndexController@Index');
Route::prefix('admin')->middleware('admin.login')->get('index','Admin\IndexController@Index');

// 用户列表
Route::prefix('admin')->middleware('admin.login')->get('user-list','Admin\UserController@UserList');

// 会员列表
Route::prefix('admin')->middleware('admin.login')->get('member-list','Admin\MemberController@MemberList');

// 经纪关系列表
Route::prefix('admin')->middleware('admin.login')->get('union-list','Admin\MemberController@UnionList');

// 客户列表
Route::prefix('admin')->middleware('admin.login')->get('client-list','Admin\ClientController@Index');

// 顾问列表
Route::prefix('admin')->middleware('admin.login')->get('consultant-list','Admin\ConsultantController@ConsultantList');
// 顾问存储
Route::prefix('admin')->middleware('admin.login')->get('consultant-store','Admin\ConsultantController@ConsultantStore');
// 顾问存储成功
Route::prefix('admin')->middleware('admin.login')->post('consultant-store','Admin\ConsultantController@ConsultantStoreOk');
// 顾问编辑
Route::prefix('admin')->middleware('admin.login')->get('consultant-edit/{id}','Admin\ConsultantController@ConsultantEdit');
// 顾问编辑成功
Route::prefix('admin')->middleware('admin.login')->post('consultant-edit','Admin\ConsultantController@ConsultantEditOk');
// 顾问删除
Route::prefix('admin')->middleware('admin.login')->get('consultant-del/{id}','Admin\ConsultantController@ConsultantDel');


// 店铺列表
Route::prefix('admin')->middleware('admin.login')->get('shop-list','Admin\ConsultantController@ShopList');
// 店铺存储
Route::prefix('admin')->middleware('admin.login')->get('shop-store','Admin\ConsultantController@ShopStore');
// 店铺存储成功
Route::prefix('admin')->middleware('admin.login')->post('shop-store','Admin\ConsultantController@ShopStoreOk');
// 店铺编辑
Route::prefix('admin')->middleware('admin.login')->get('shop-edit/{id}','Admin\ConsultantController@ShopEdit');
// 店铺编辑成功
Route::prefix('admin')->middleware('admin.login')->post('shop-edit','Admin\ConsultantController@ShopEditOk');
// 顾问删除
Route::prefix('admin')->middleware('admin.login')->get('shop-del/{id}','Admin\ConsultantController@ShopDel');


// 方案列表
Route::prefix('admin')->middleware('admin.login')->get('plan-list','Admin\PlanController@Index');
// 方案添加
Route::prefix('admin')->middleware('admin.login')->get('plan-insert','Admin\PlanController@Insert');
Route::prefix('admin')->middleware('admin.login')->post('plan-insert','Admin\PlanController@InsertStore');
// 方案更新
Route::prefix('admin')->middleware('admin.login')->get('plan-update/{id}','Admin\PlanController@Update');
Route::prefix('admin')->middleware('admin.login')->post('plan-update','Admin\PlanController@UpdateStore');