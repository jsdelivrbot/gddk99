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
            if (Cache::get('mobile_user')['is_mobile']==1){
                return $next($request);
            }

            return redirect('/mobile/index');

        }else{
            return redirect('/mobile/channel');
        }


    }
}
