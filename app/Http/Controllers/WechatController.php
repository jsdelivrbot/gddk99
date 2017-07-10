<?php

namespace App\Http\Controllers;

use App\Common\Common;
use App\Member;
use Illuminate\Http\Request;
use EasyWeChat\Foundation\Application;
use Overtrue\Socialite\SocialiteManager;
use Cache;

class WechatController extends Controller
{

    // -----------------------微信公众号--关注公众号-----------------------------
    protected  $option = [
        'debug'     => true,
        'app_id'    => 'wx3f8962decbe79ba4',
        'secret'    => '18277875d53776b5dcf05676563acce2',
        'token'     => 'CWI4y86blVB8OhUQg4BnMF',
        'log' => [
            'level' => 'debug',
            'file'  => '/tmp/easywechat.log',
        ],
        'oauth' => [
            'scopes' =>['snsapi_base'],
            'callback' => '/mobile/oauth_callback',
        ],
    ];

    // -----------------------微信公众号网页授权-----------------------------
    protected  $options = [
        'debug'     => true,
        'app_id'    => 'wx3f8962decbe79ba4',
        'secret'    => '18277875d53776b5dcf05676563acce2',
        'token'     => 'CWI4y86blVB8OhUQg4BnMF',
        'log' => [
            'level' => 'debug',
            'file'  => '/tmp/easywechat.log',
        ],
        'oauth' => [
            'scopes' =>['snsapi_userinfo'],
            'callback' => '/mobile/ws-callback',
        ],
    ];

    // -----------------------开放平台网页第三方登录-----------------------------
    protected $config = [
        'wechat' => [
            'client_id'     => 'wx9f3dd1dd7cc72602',
            'client_secret' => 'b2600888426c904583800ac5a9de4a8f',
            'redirect'      => 'http://www.gddk99.com/mobile/wx-callback',
        ]
    ];

    //******************************* 封装方法区域 ***********************************************

    // 封装存储数据方法
    protected function BackData($result){
        $res = (new Common())->if_empty($result['openid']);
        $member = Member::where('wechat_openid',$res)->first();
        $memberId =$member['member_id'];
        $row = (new Common())->if_empty($memberId);
        if ($row == 0){
            session()->forget('mobile_user');
            $mem = new Member();
            $mem->wechat_openid = $result['openid'];
            $mem->wechat_nickname = $result['nickname'];
            $mem->member_sex = $result['sex'];
            $mem->wechat_headimgurl = $result['headimgurl'];
            $mem->member_type = Member::MEMBER_TYPE_ONE;
            $mem->is_member = Member::IS_MEMBER;
            $mem->save();
            $rows = Member::find($mem->getQueueableId());
            session(['mobile_user'=>$rows]);
        }
        session(['mobile_user'=>$member]);

        return redirect()->action('WechatController@login');
    }

    // 登录成功进入对应页面方法
    protected function enter(){

        // 线上地址
        // $str = "http://www.gddk99.com/mobile/client/client-poster-invite?member_id=5";
        //echo substr($str,21);  输出结果：/mobile/client/client-poster-invite?member_id=5

        // 本地测试地址
        // $str = "http://gddk99.tunnel.qydev.com/mobile/client/client-poster-invite?member_id=5";
        //echo substr($str,30);  输出结果：/mobile/client/client-poster-invite?member_id=5

        // 本地测试地址
        // $str = "http://snsm.natapp1.cc";
        //echo substr($str,22);  输出结果：/mobile/client/client-poster-invite?member_id=5

        if (Cache::get('url')){
            $str = Cache::get('url');
            $res = substr($str,30);
            return redirect($res);
        }
        return redirect('/mobile/index');

    }

    // 渠道入口登录判断
    public function Channel(){

        $scope = Cache::get('scope');

        switch ($scope)
        {
            case 'snsapi_userinfo':
                return redirect()->action('WechatController@WsLogin');
                break;
            case 'snsapi_base':
                return redirect()->action('WechatController@login');
                break;
            case 'snsapi_login':
                return redirect()->action('WechatController@WxLogin');
                break;
            default:
                return redirect()->action('WechatController@WsLogin');
        }

    }


    // -----------------------微信公众号--关注公众号-----------------------------

    public function serve(){
        $app = new Application($this->option);
        $server = $app->server;
        $user = $app->user;
        $server->setMessageHandler(function($message) use ($user) {
            $fromUser = $user->get($message->FromUserName);
            return "{$fromUser->nickname} 您好！欢迎关注 广东贷款网";
        });
        $server->serve()->send();
    }

    public function login(){
        // 未登录
        $app = new Application($this->option);
        $oauth = $app->oauth;
        if (!session()->has('mobile_user')){
            return $oauth->redirect();
        }

        // 已登录
        return $this->enter();
    }

    public function oauth_callback(){
        $app = new Application($this->option);
        $oauth = $app->oauth;
        $user = $oauth->user();
        $token = $user['token']->toArray();
        $scope =$token['scope'];
        $openId =$user['id'];
        $userService = $app->user;
        $result = $userService->get($openId)->toArray();

        // --------------获取到用户资料，存储数据库------------

        Cache::add('scope',$scope,1);
        return $this->BackData($result);
    }


    //  -----------------------微信公众号网页授权-----------------------------
    public function WsLogin(){

        $app = new Application($this->options);
        $oauth = $app->oauth;
        return $oauth->redirect();

    }
    public function WsCallback(){

        $app = new Application($this->options);
        $oauth = $app->oauth;
        $user = $oauth->user();
        $token = $user['token']->toArray();
        $scope = $token['scope'];
        $result = $user['original'];

        // --------------获取到用户资料，存储数据库------------

        Cache::add('scope',$scope,1);
        return $this->BackData($result);

    }


    //  -----------------------微信开放平台网页授权-----------------------------

    public function WxLogin(){
        $socialite = new SocialiteManager($this->config);
        return $socialite->driver('wechat')->redirect();
    }

    public function WxCallback(){
        $socialite = new SocialiteManager($this->config);
        $user = $socialite->driver('wechat')->user();
        dd($user);
    }


    //  -----------------------微信测试号菜单设置，到时可以注销-----------------------------

    public function Menu(Request $request){
        $app = new Application($this->option);
        $menu = $app->menu;
        $buttons = [
            [
                "type" => "view",
                "name" => "官网首页",
                "url"  => $request->getHttpHost()
            ],
            [
                "type" => "view",
                "name" => "立即申请",
                "url"  => $request->getHttpHost()."/mobile/client/client-list"
            ],
            [
                "type" => "view",
                "name" => "个人中心",
                "url"  =>  $request->getHttpHost()."/mobile/member/person-list"
            ],
        ];
        $menu->add($buttons);
        //$menu->destroy();
    }

}
