<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Overtrue\Socialite\SocialiteManager;

class LoginController extends Controller
{

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
}
