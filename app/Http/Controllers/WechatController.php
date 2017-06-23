<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Cache;

class WechatController extends Controller
{
    public function serve(){
        $options =Config::get('wechat');
        $app = new Application($options);
        $server = $app->server;
        $user = $app->user;
        $server->setMessageHandler(function($message) use ($user) {
            switch ($message->MsgType) {
                case 'event':
                    # 事件消息...
                    return "欢迎关注广东贷款网";
                    break;
            }
        });
        $server->serve()->send();
    }

    //封装方法
    public function config(){
        $options =Config::get('wechat');
        $app = new Application($options);
        $oauth = $app->oauth;
        return $oauth;
    }

    //第二步:写访问登陆，并且判断是否未登陆和已经登陆
    public function login(){

        $oauth = $this->config();

        // 未登录
        if (!session()->has('target_user')) {
            // 绕过近期授权登陆
            $or_op = session('wechat_user_session')['original']['openid'];
            $openid= session('wechat_user');
            $wechat_openid = isset($openid[0]['wechat_openid']) ? $openid[0]['wechat_openid'] : $openid['wechat_openid'];
            $or = empty($or_op) ? 1 : $or_op;
            $we =empty($wechat_openid) ? 2 : $wechat_openid;

            if ($or==$we){
                return redirect('/mobile/index');
            }

            return $oauth->redirect();
        }

        // 已经登录过
        session('wechat_user_session');
    }

    //第一步:写登陆授权获取用户信息保存到SESSION中，并且跳转登陆访问
    public function oauth_callback(Request $request){
        $oauth = $this->config();

        // 获取 OAuth 授权结果用户信息
        $member = $oauth->user();
        session(['wechat_user_session' => $member->toArray()]);

        //第三步:采用SESSION获取用户openID查询用户详细信息，并且保存数据库，跳转登陆成功！
        $sess = session('wechat_user_session');
        $openId =$sess['id'];
        $options =Config::get('wechat');
        $app = new Application($options);
        $userService = $app->user;
        $res = $userService->get($openId)->toArray();

        //查询数据当前用户OPENID是否存在，如果存在直接跳转，不存在添加数据跳转
        $row = Member::where('wechat_openid',$res['openid'])->first();
        if (isset($row)){
            $data_row[] = $row->toArray();
            session(['wechat_user' =>$data_row]);
        }else{
            $us = $member->toArray();
            $nicknamea = empty($res['nickname']) ? '1' : $this->filterEmoji($res['nickname']);
            $nicknameb = $this->filterEmoji($us['original']['nickname']);

            //添加Member数据
            $mem = new Member();
            $mem->wechat_openid = isset($res['openid']) ? $res['openid'] : $us['original']['openid'];
            $mem->wechat_nickname = isset($nicknamea)=='1' ? $nicknameb : $nicknamea;
            $mem->member_sex = isset($res['sex']) ? $res['sex'] : $us['original']['sex'];
            $mem->wechat_headimgurl = isset($res['headimgurl']) ? $res['headimgurl'] : $us['original']['headimgurl'];
            $mem->member_type = 1;
            $mem->save();
            $rows = Member::find($mem->getQueueableId());
            session(['wechat_user' =>$rows->toArray()]);
        }

        $url_person = 'http://'.$request->getHttpHost().'/mobile/person-list';
        $url_client = 'http://'.$request->getHttpHost().'/mobile/client-list';
        $qycode_client = 'http://'.$request->getHttpHost().'/mobile/client-poster-invite?member_id='.Cache::get('memberID').'';

        if ($url_person==Cache::get('person')){
            return redirect('/mobile/person-list');
        }elseif($url_client==Cache::get('client')){
            return redirect('/mobile/client-list');
        }elseif($qycode_client==Cache::get('qycode_client')){
            return redirect('/mobile/client-poster-invite?member_id='.Cache::get('memberID').'');
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

    // 微信测试号菜单设置，到时注销
    public function Menu(){
        $options =Config::get('wechat');
        $app = new Application($options);
        $menu = $app->menu;
        $buttons = [
            [
                "type" => "view",
                "name" => "广东贷款网",
                "url"  => "http://gddk99.tunnel.qydev.com"
            ],
            [
                "type" => "view",
                "name" => "贷款申请",
                "url"  => "http://gddk99.tunnel.qydev.com/mobile/client-list"
            ],
            [
                "type" => "view",
                "name" => "个人中心",
                "url"  => "http://gddk99.tunnel.qydev.com/mobile/person-list"
            ],
        ];
        $menu->add($buttons);
        //$menu->destroy();
    }

}
