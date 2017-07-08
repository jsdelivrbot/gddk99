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
    public function UnionList(Member $member,Common $common){
        // 读取合伙人信息
        $union_user = $member->all();
        $data[]='';
        foreach ($union_user as $unionList){
            $current_user = $member->where('member_parent_id',$unionList['member_id'])->get();
            foreach ($current_user as $currentList){
                $data[]=[
                  'current_id' => $currentList['member_id'],
                  'current_avatar' => $common->If_val($currentList['member_avatar'],$currentList['wechat_headimgurl']),
                  'current_name' => $currentList['member_surname'],
                  'current_mobile' => $currentList['member_mobile'],
                  'updated_at' => $currentList['updated_at'],

                  'union_id' => $unionList['member_id'],
                  'union_name' => $unionList['member_surname'],
                  'union_mobile' => $unionList['member_mobile'],
                ];
            }
        }
        $union = array_filter($data);
        return view('admin.union-list',['union'=>$union]);
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
