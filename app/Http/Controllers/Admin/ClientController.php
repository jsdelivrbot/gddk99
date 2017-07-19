<?php

namespace App\Http\Controllers\Admin;

use App\Info;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    // 客户列表
    public function Index(Info $info){

        // 关联读取所有数据,并且把重复字段别名
        $info_data = $info->select('members.*','members.member_id as me_id','infos.*','infos.member_id as in_id')->join('members','infos.info_invite','=','members.member_id')->paginate(15);

        return view('admin.client-list',['client_info'=>$info_data]);
    }

    // 客户列表---编辑
    public function ClientListEdit($info_id,Info $info,Member $member){
        $data = $info->find($info_id);
        $sex = $member->Sex();
        $str = substr($data['member_id'],2,100);
        $emp = empty($str) ? $data['member_id'] : $str;
        $members = $member->find($emp);
        $inf_status = $info->InfoStatus();
        return view('admin.client.client-list-edit',['info'=>$data,'sex'=>$sex,'member'=>$members,'status'=>$inf_status]);
    }

}
