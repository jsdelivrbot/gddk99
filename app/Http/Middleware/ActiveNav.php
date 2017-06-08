<?php

namespace App\Http\Middleware;

use Closure;

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
        if(!session('wechat_user')){
            return redirect('wechat-login');
        }
        return $next($request);
    }
}
