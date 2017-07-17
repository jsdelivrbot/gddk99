<?php

namespace App\Http\Controllers\Admin;

use App\Info;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function Index(Info $info){

        // 关联读取所有数据,并且把重复字段别名
        $info_data = $info->select('members.*','members.member_id as me_id','infos.*','infos.member_id as in_id')->join('members','infos.info_invite','=','members.member_id')->paginate(15);

        return view('admin.client-list',['client_info'=>$info_data]);
    }
}
