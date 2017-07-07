<?php

namespace App\Http\Controllers\Admin;

use App\Common\Common;
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

    // 合伙人列表
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

    // 推客列表
    public function MemberPush(Member $member,Common $common){
        // 读取合伙人资料
        $union = $member->all();

        // 定义数据
        $data[]='';

        // 循环合伙人信息
        foreach ($union as $listUnion){
            // 读取推客资料 10 条件是表示合伙人
            $push = $member->where('member_parent_id','10'.$listUnion['member_id'])->get();

            // 循环推客信息
            foreach ($push as $listPush){
                // 组装数据
                $data[]= [
                    'push_id' => $listPush['member_id'],
                    'push_name' => $listPush['member_surname'],
                    'push_avatar' => $common->If_val($listPush['member_avatar'],$listPush['wechat_headimgurl']),
                    'push_mobile' => $listPush['member_mobile'],
                    'push_type' => $listPush['member_type'],
                    'push_status' => $listPush['member_status'],
                    'push_time' => $listPush['created_at'],

                    'union_id' => $listUnion['member_id'],
                    'union_name' => $listUnion['member_surname'],
                    'union_mobile' => $listUnion['member_mobile'],
                ];
            }
        }

        $user = array_filter($data);

        return view('admin.push.push-list',['member'=>$user]);
    }

    // 我的合伙人设置功能---是否初审核状态
    public function memberCheckStatus(Request $request,Member $member){
        $data=$request->except(['_token']);
        $member->where('member_id',$data['member_id'])->update($data);
        return redirect()->back();
    }

}
