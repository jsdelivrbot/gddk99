<?php

namespace App\Http\Middleware;

use Closure;
use Cache;

class ActiveNav
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Cache::has('mobile_user') && Cache::get('mobile_user')){

            if (Cache::get('mobile_user')['is_member']==1){
                return $next($request);
            }

            return redirect('/mobile/index');

        }else{

            // ------------定义，未登录前---访问该页面---登录成功后---返回该页面---否则直接跳转首页-------

            // 获取URL地址，写入缓存，1分钟失效
            $url =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            Cache::add('cache_url',$url,1);

            // 获取到的URL地址是否与缓存URL相同，如果相同，在此写入缓存，否则清除缓存，在写入缓存
            if ($url == Cache::get('cache_url')){
                Cache::pull('cache_url');
                Cache::pull('url');
                Cache::add('url',$url,1);
            }else{
                Cache::pull('cache_url');
                Cache::pull('url');
                Cache::add('url',$url,1);
            }

            return redirect('/mobile/channel');
        }

    }
}
