<?php

namespace App\Http\Controllers\Mobile;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MemberController extends Controller
{
    public function Person(){
        $id= session('wechat_user');
        $member = Member::find($id);

        $qrcode_pictrue = public_path('build/uploads/qrcode'.$member[0]['member_id'].'.png');
        if(!file_exists($qrcode_pictrue)){
            $url= 'http://gddk99.tunnel.qydev.com/user-invite?member_parent_id='.$member[0]['member_id'];
            QrCode::encoding('UTF-8')->format('png')->size(300)->generate($url,public_path('build/uploads/qrcode'.$member[0]['member_id'].'.png'));
        }

        return view('mobile.person-list',['member' => $member]);
    }

    /*public function userQrcode(Request $request)
    {
        $qrcode_pictrue = public_path('build/uploads/qrcode'.$request->get('member_id').'.png');
        if(!file_exists($qrcode_pictrue)){
            $url= 'http://'.$request->getHttpHost().'/user-invite?member_parent_id='.$request->get('member_id');
            $member = Member::find($request->get('member_id'));
            $member_url = 'http://'.$request->getHttpHost().'/build/uploads/'.$member['member_avatar'];
            $member_wx =$member['wechat_headimgurl'].'.jpg';
            $member_pic = $member['member_avatar'] ? $member_url : $member_wx;
            QrCode::encoding('UTF-8')->format('png')->size(300)->merge($member_pic,.15)->generate($url,public_path('build/uploads/qrcode'.$request->get('member_id').'.png'));
        }
        return view('mobile.member_user-qrcode',['member_id'=>$request->get('member_id')]);
    }*/

    public function userInvite(Request $request)
    {
        $user_parent_id = $request->get('user_parent_id');
        return view('wechat.user-invite',['user_parent_id'=>$user_parent_id]);
    }

    public function userInviteStore(Request $request){
        $user = User::find($request->get('user_id'));
        $user->user_parent_id = $request->get('user_parent_id');
        $user->save();
        return redirect('user-list');
    }

}
