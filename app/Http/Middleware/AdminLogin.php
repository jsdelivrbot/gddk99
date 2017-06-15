<?php
namespace App\Http\Middleware;
use Closure;
use Cache;
class AdminLogin
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
        if (Cache::has('admin_user')){
            if (Cache::get('admin_user')){
                return $next($request);
            }else{
                return redirect('/admin/login')->with('message','2');
            }
        }else{
            return redirect('/admin/login')->with('message','2');
        }
    }
}