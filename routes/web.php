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

// ------------------------------- PC端 -----------------------------------------

Route::get('/','Home\IndexController@index');



// ------------------------------- 微信登录路由配置 -----------------------------------------

//微信提交Token验证
Route::prefix('mobile')->any('weixin', 'WechatController@serve');

//微信登陆
Route::prefix('mobile')->any('login', 'WechatController@login');

//微信获取授权回调
Route::prefix('mobile')->any('oauth_callback', 'WechatController@oauth_callback');

// 微信网页授权登录
Route::prefix('mobile')->any('ws-login', 'WechatController@WsLogin');

//微信网页授权回调
Route::prefix('mobile')->any('ws-callback', 'WechatController@WsCallback');

// 微信开放平台
Route::prefix('mobile')->get('wx-login','WechatController@WxLogin');

// 微信开放平台授权回调
Route::prefix('mobile')->get('wx-callback','WechatController@WxCallback');

//微信菜单导航
Route::prefix('mobile')->any('menu', 'WechatController@Menu');

//渠道入口登录-------手机端----微信端----所有的登录通通走这个入口
Route::prefix('mobile')->any('channel', 'WechatController@Channel');

// -------------------------------  微信端  -----------------------------------------


//--------------------------------- 首页管理区 ------------------------------//

// 首页
Route::prefix('mobile')->get('/','Mobile\IndexController@index');
Route::prefix('mobile')->get('index','Mobile\IndexController@index');

// 退出
Route::prefix('mobile')->middleware('active.nav')->get('logout','Mobile\MemberController@Logout');

//--------------------------------- 会员管理区 ------------------------------//

// 会员管理---普通会员--个人中心列表显示
Route::prefix('mobile')->middleware('active.nav')->get('/member/ordinary-person-list','Mobile\MemberController@OrdinaryPerson');

// 会员管理----VIP会员--个人中心列表显示
Route::prefix('mobile')->middleware('active.nav')->get('/member/person-list','Mobile\MemberController@Person');

// 会员管理---合伙人---个人中心列表显示
Route::prefix('mobile')->middleware('active.nav')->get('/member/union-person-list','Mobile\MemberController@unionPerson');

// 会员管理---级别判定进入相应页面---个人中心列表显示
Route::prefix('mobile')->middleware('active.nav')->get('/member/person-level','Mobile\MemberController@Level');

// 会员管理---个人中心--生成海报页面--扫码成为经纪人
Route::prefix('mobile')->middleware('active.nav')->get('/member/poster-list','Mobile\MemberController@Poster');

//会员管理---个人中心--生成海报页面--扫码成为经纪人--扫码跳转页面
Route::prefix('mobile')->middleware('active.nav')->get('/member/member-user-invite','Mobile\MemberController@MemberUserInvite');
Route::prefix('mobile')->middleware('active.nav')->post('/member/member-user-invite','Mobile\MemberController@MemberUserInviteStore');

// 会员管理---个人中心---完善资料
Route::prefix('mobile')->middleware('active.nav')->get('/member/person-edit/{member_id}','Mobile\MemberController@PersonEdit');
// 会员管理---个人中心---完善资料--存储
Route::prefix('mobile')->middleware('active.nav')->post('/member/person-edit','Mobile\MemberController@PersonEditStore');

// 会员管理---发送验证码
Route::prefix('mobile')->middleware('active.nav')->post('/member/send','Mobile\MemberController@Send');

// 我的经纪人列表---显示
Route::prefix('mobile')->middleware('active.nav')->get('/member/union-list/{member_id}','Mobile\MemberController@UnionList');

// 申请成为推客---列表
Route::prefix('mobile')->middleware('active.nav')->get('/member/push-apply-list','Mobile\MemberController@PushApplyList');

// 个人申请成为推客--填写资料
Route::prefix('mobile')->middleware('active.nav')->get('/member/push-person-apply/{member_id}','Mobile\MemberController@PushPersonApply');
Route::prefix('mobile')->middleware('active.nav')->post('/member/push-person-apply','Mobile\MemberController@PushPersonApplyStore');

// 企业申请成为推客--填写资料
Route::prefix('mobile')->middleware('active.nav')->get('/member/push-firm-apply/{member_id}','Mobile\MemberController@PushFirmApply');

// 我的合伙人设置功能---是否审核状态
Route::prefix('mobile')->middleware('active.nav')->post('/member/member-check-status','Mobile\MemberController@memberCheckStatus');

// 我的合伙人设置功能---是否审核状态---取消
Route::prefix('mobile')->middleware('active.nav')->post('/member/member-cancel-status','Mobile\MemberController@memberCancelStatus');

// 我的合伙人设置功能---是否审核状态---详细资料
Route::prefix('mobile')->middleware('active.nav')->get('/member/union-list-details/{member_id}','Mobile\MemberController@unionListDetails');


//--------------------------------- 客户管理区 ------------------------------//

// 推客----客户海报列表，生成海报页面---显示
Route::prefix('mobile')->middleware('active.nav')->get('/client/client-poster-list','Mobile\ClientController@ClientPoster');

// 推客----客户海报列表---扫码跳转---填写绑定合伙人----跳转发展推客
Route::prefix('mobile')->middleware('active.nav')->get('/client/client-poster-invite','Mobile\ClientController@ClientPosterInvite');
Route::prefix('mobile')->middleware('active.nav')->post('/client/client-poster-invite','Mobile\ClientController@ClientPosterInviteStore');

// 推客----客户海报列表---扫码跳转---填写绑定合伙人----推客--邀请合伙人---跳转发展推客
Route::prefix('mobile')->middleware('active.nav')->get('/client/client-poster-invite-apply','Mobile\ClientController@ClientPosterInviteApply');
Route::prefix('mobile')->middleware('active.nav')->post('/client/client-poster-invite-apply','Mobile\ClientController@ClientPosterInviteApplyStore');

// 立即申请贷款----客户列表
Route::prefix('mobile')->middleware('active.nav')->get('/client/client-list','Mobile\ClientController@ClientList');
Route::prefix('mobile')->middleware('active.nav')->post('/client/client-list','Mobile\ClientController@ClientListStore');

// 我的合伙人列表
Route::prefix('mobile')->middleware('active.nav')->get('/client/client-union-show/{member_id}','Mobile\ClientController@ClientUnionShow');

// 我的合伙人--申报客户列表
Route::prefix('mobile')->middleware('active.nav')->get('/client/client-union-list/{member_id}','Mobile\ClientController@ClientUnionList');

// 我的合伙人--申报客户列表--详情
Route::prefix('mobile')->middleware('active.nav')->get('/client/client-union-details/{info_id}/{member_id}','Mobile\ClientController@ClientUnionDetails');


//--------------------------------- 顾问管理区 ------------------------------//

// 顾客列表详情
Route::prefix('mobile')->middleware('active.nav')->get('/consultant/consultant-details/{id}','Mobile\ConsultantController@Index');


//--------------------------------- 店面管理区 ------------------------------//

// 门店列表详情
Route::prefix('mobile')->middleware('active.nav')->get('/shop/shop-details/{id}','Mobile\ShopController@ShopDetails');



// 内容页
Route::prefix('mobile')->middleware('active.nav')->get('full-content','Mobile\IndexController@FullContent');

// 方案详情
Route::prefix('mobile')->middleware('active.nav')->get('plan-details/{id}','Mobile\PlanController@Detail');

// 网站建设服务页面
Route::prefix('mobile')->middleware('active.nav')->get('serve','Mobile\OtherController@Index');


// -------------------------------  后台端 -----------------------------------------

// 登录页
Route::prefix('admin')->get('/','Admin\IndexController@Login');
Route::prefix('admin')->get('login','Admin\IndexController@Login');
Route::prefix('admin')->post('login','Admin\IndexController@LoginSignin');

// 登出
Route::prefix('admin')->get('/logout', 'Admin\IndexController@logout');

// 首页
Route::prefix('admin')->middleware('admin.login')->get('/','Admin\IndexController@Index');
Route::prefix('admin')->middleware('admin.login')->get('index','Admin\IndexController@Index');



//--------------------------------- 会员管理区 ------------------------------//

// 会员列表
Route::prefix('admin')->middleware('admin.login')->get('member-list','Admin\MemberController@MemberList');

// 推客列表
Route::prefix('admin')->middleware('admin.login')->get('/push/push-list','Admin\MemberController@MemberPush');

// 我的合伙人设置功能---是否审核状态
Route::prefix('admin')->middleware('admin.login')->post('/member/member-check-status','Admin\MemberController@memberCheckStatus');



// 用户列表
Route::prefix('admin')->middleware('admin.login')->get('user-list','Admin\UserController@UserList');


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