<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Overtrue\Socialite\SocialiteManager;

class LoginController extends Controller
{

    protected $config = [
        'wechat_open' => [
            'client_id'     => 'wx9f3dd1dd7cc72602',
            'client_secret' => '9b1f2df7431975bd734fbf33c83cb681',
            'redirect'      => 'http://www.gddk99.com/',
        ],
    ];

    public function WxLogin(){
        $socialite = new SocialiteManager($this->config);
        return $socialite->driver('wechat_open')->redirect();
    }

    public function WxCallback(){
        $socialite = new SocialiteManager($this->config);
        $user = $socialite->driver('wechat_open')->user();
        dd($user);
    }
}
