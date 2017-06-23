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
        if(session()->has('wechat_user') && session('wechat_user')){
            return $next($request);
        }else{

            $url =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

            $url_person = 'http://'.$request->getHttpHost().'/mobile/person-list';
            $url_client = 'http://'.$request->getHttpHost().'/mobile/client-list';

            if ($url==$url_person){
                Cache::add('person',$url_person,1);
            }elseif($url==$url_client){
                Cache::add('client',$url_client,1);
            }

           return redirect('/login');
        }
    }
}
