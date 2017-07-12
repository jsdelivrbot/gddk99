<?php

namespace App\Http\Controllers\Mobile;

use App\Common\Common;
use App\Consultant;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    // 首页--显示
    public function index(Consultant $consultant,Member $member,Common $common){
        // 接收参数ID
        $memberId = $common->If_com(session('mobile_user')['member_id']);
        $members = $member->find($memberId);

        // 读取数据
        $cons = $consultant->where('con_type',1)->paginate(15);
        $shop = $consultant->where('con_type',2)->paginate(15);

        return view('mobile.index',['consultant'=>$cons,'shop'=>$shop,'member'=>$members]);
    }

    public function FullContent(){
        return view('mobile.full-content');
    }

}
