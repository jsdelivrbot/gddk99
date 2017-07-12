<?php

namespace App\Http\Controllers\Admin;

use App\Info;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function Index(Info $info,Member $member){

        $info = $info->all();
        $data[]='';
        foreach ($info as $list){
            $members = $member->where('member_id',$list['info_invite'])->get();
            foreach ($members as $line){
                $data[] = [
                    'info_id' =>$list['info_id'],
                    'info_name' => $list['info_name'],
                    'info_sex' => $list['info_sex'],
                    'info_mobile' => $list['info_mobile'],
                    'info_quota' => $list['info_quota'],
                    'info_status' => $list['info_status'],
                    'member_id' => $list['member_id'],
                    'info_invite' => $list['info_invite'],
                    'created_at' => $list['created_at'],

                    'push_name' => $line['member_surname'],
                    'push_mobile' => $line['member_mobile'],
                ];
            }
        }

        $client_info = array_filter($data);

        return view('admin.client-list',['client_info'=>$client_info]);
    }
}
