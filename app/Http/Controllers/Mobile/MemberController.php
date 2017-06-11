<?php

namespace App\Http\Controllers\Mobile;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Session;

class MemberController extends Controller
{
    public function Person(Request $request){

        $id= Session::get('wechat_user');
        $member = Member::find($id);
        if (empty($member)){
            Session::forget('wechat_user_session');
            Session::forget('wechat_user');
        }

        // 生成二维码
        $qrcode_pictrue = public_path('build/uploads/qrcode'.$member[0]['member_id'].'.png');
        if(!file_exists($qrcode_pictrue)){
            $url='http://'.$request->getHttpHost().'/mobile/member-user-invite?member_parent_id='.$member[0]['member_id'];
            QrCode::encoding('UTF-8')->format('png')->size(300)->generate($url,public_path('build/uploads/qrcode'.$member[0]['member_id'].'.png'));
        }
        return view('mobile.person-list',['member' => $member]);

    }

    public function MemberUserInvite(Request $request)
    {
        // http://gddk99.tunnel.qydev.com/mobile/member-user-invite?member_parent_id=41
        dd($request->get('member_parent_id'));

        $user_parent_id = $request->get('user_parent_id');
        return view('wechat.user-invite',['user_parent_id'=>$user_parent_id]);
    }

    public function MemberUserInviteStore(Request $request){
        $user = User::find($request->get('user_id'));
        $user->user_parent_id = $request->get('user_parent_id');
        $user->save();
        return redirect('user-list');
    }

}
