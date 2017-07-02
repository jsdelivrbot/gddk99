<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LoginSigninRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Cache;

class IndexController extends Controller
{

    public function Login(){
        return view('admin.login');
    }

    public function LoginSignin(LoginSigninRequest $request){
        $mobile =$request->get('user_mobile');
        $password =$request->get('password');

        $user = (User::where('user_mobile',$mobile)->first())->toArray();
        if (!Hash::check($password,$user['password'])){
            return redirect('admin/login')->with('message','0');
        }
        if ($user['is_admin'] == User::IS_USER){
           Cache::add('admin_user',$user,User::FAIL_TIME);
            return redirect('admin/index')->with('message','1');
        }else{
            return redirect('admin/login')->with('message','2');
        }
    }

    public function logout(){
        Cache::pull('admin_user');
        return redirect('admin/login')->with('message','3');
    }

    public function Index(){
        return view('admin.index');
    }
}
