<?php

namespace App\Http\Controllers\Admin;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    //  会员列表
    public function MemberList(){
        $member = Member::paginate(15);
        return view('admin.member-list',['member' =>$member ]);
    }

    public function UnionList(){
        $member = Member::all();
        $union_users[]='';
        foreach ($member as $list){
            $member_parent= Member::where('member_parent_id',$list['member_id'])->get();
            foreach ($member_parent as $parent_list){
                $union_users[]= [
                    'member_id'=>$parent_list['member_id'],
                    'member_avatar'=>$parent_list['wechat_headimgurl'] ? $parent_list['wechat_headimgurl'] : asset('build/uploads/'.$parent_list['member_avatar'].''),
                    'member_name'=>$parent_list['member_name'] ? $parent_list['member_name'] : $parent_list['wechat_nickname'],
                    'member_mobile'=>$parent_list['member_mobile'],
                    'member_parent_id'=>$parent_list['member_parent_id'],
                    'updated_at'=>$parent_list['updated_at'],
                    'member_parent_name'=>$list['member_name'] ? $list['member_name'] : $list['wechat_nickname'],
                ];
            }
        }
        $union_user = array_filter($union_users);
        return view('admin.union-list',['union_user'=>$union_user]);
    }
}
