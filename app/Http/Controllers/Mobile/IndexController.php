<?php

namespace App\Http\Controllers\Mobile;

use App\Consultant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    // 首页--显示
    public function index(Consultant $consultant){
        $cons = $consultant->where('con_type',1)->paginate(15);
        $shop = $consultant->where('con_type',2)->paginate(15);
        return view('mobile.index',['consultant'=>$cons,'shop'=>$shop]);
    }

    public function FullContent(){
        return view('mobile.full-content');
    }

}
