<?php
// wx--可以删除
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class WeixinController extends Controller
{
    public function redirectToProvider(Request $request)
    {
        return Socialite::driver('weixin')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        $user = Socialite::driver('weixin')->user();
        dd($user);
    }
}
