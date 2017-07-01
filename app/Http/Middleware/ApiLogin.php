<?php
namespace App\Http\Middleware;

use Closure;
use Cache;

class ApiLogin
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
        if (Cache::has('token')) {
            if (Cache::get('token') != $request->get('token')){
                return  response(['status' => 0,'msg' => '用户访问该资源,Token错误或过期']);
            }
            $wechatUser = empty(Cache::get('mobile_user')['member_id']) ? 0 : Cache::get('mobile_user')['member_id'];
            if ($wechatUser == 0){ Cache::pull('token'); Cache::pull('mobile_user');  response(['status'=>0,'msg'=>'Token错误或过期，请登陆！']); }
            if (!Cache::get('mobile_user')['is_member']==1){
                return response(['status'=>0,'msg'=>'您无权访问该资源！']);
            }
            return $next($request);
        }else{
            return response(['status'=>0,'msg'=>'您无权访问该资源，Token错误或过期，请登陆！']);
        }
    }

}