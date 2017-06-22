<?php

namespace App\Http\Controllers\Mobile;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Overtrue\Socialite\SocialiteManager;
use EasyWeChat\Foundation\Application;

class LoginController extends Controller
{

    // 开放平台网页第三方登录
    protected $config = [
        'wechat' => [
            'client_id'     => 'wx9f3dd1dd7cc72602',
            'client_secret' => 'b2600888426c904583800ac5a9de4a8f',
            'redirect'      => 'http://www.gddk99.com/mobile/wx-callback',
        ]
    ];

    public function WxLogin(){
        $socialite = new SocialiteManager($this->config);
        return $socialite->driver('wechat')->redirect();
    }

    public function WxCallback(){
        $socialite = new SocialiteManager($this->config);
        $user = $socialite->driver('wechat')->user();
        dd($user);
    }

    //公众号网页授权登录
    protected $options = [
        'debug'     => true,
        'app_id'    => 'wx9152149c92384a68',
        'secret'    => 'babf0f03bf0480141f65198557ae7936',
        'token'     => 'CWI4y86blVB8OhUQg4BnMF2vDr3ZbnNk',
        'log' => [
            'level' => 'debug',
            'file'  => '/tmp/easywechat.log',
        ],
        'oauth' => [
            'scopes' => ['snsapi_userinfo'],
            'callback'  => 'http://www.gddk99.com/mobile/m-callback',
        ],

    ];

    public function MLogin(){
        $app = new Application($this->options);
        $oauth = $app->oauth;
        return $oauth->redirect();
    }

    public function MCallback(){
        $app = new Application($this->options);
        $oauth = $app->oauth;
        $user = $oauth->user();
        
		$row = Member::where('wechat_openid',$user['original']['openid'])->first();
        if (isset($row)){
            $data_row[] = $row->toArray();
            session(['wechat_user' =>$data_row]);
        }else{
            //添加Member数据
            $mem = new Member();
            $mem->wechat_openid = $user['original']['openid'];
            $mem->wechat_nickname = $this->filterEmoji($user['original']['nickname']);
            $mem->member_sex =$user['original']['sex'];
            $mem->wechat_headimgurl =$user['original']['headimgurl'];
            $mem->member_type = 1;
            $mem->save();
            $row = Member::find($mem->getQueueableId());
            session(['wechat_user' =>$row->toArray()]);
        }
		
		return redirect('/mobile/index');
    }

    // 过滤掉emoji表情
    function filterEmoji($str)
    {
        $str = preg_replace_callback(
            '/./u',
            function (array $match) {
                return strlen($match[0]) >= 4 ? '' : $match[0];
            },
            $str);
        return $str;
    }
}
