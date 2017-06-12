<?php

namespace App\Http\Controllers\Mobile;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Session;
use App\Common\Common;

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
            QrCode::encoding('UTF-8')->format('png')->size(200)->generate($url,public_path('build/uploads/qrcode'.$member[0]['member_id'].'.png'));
        }
        return view('mobile.person-list',['member' => $member]);

    }

    public function MemberUserInvite(Request $request)
    {
        // http://gddk99.tunnel.qydev.com/mobile/member-user-invite?member_parent_id=41
        $member_parent_id = $request->get('member_parent_id');
        return view('mobile.member-user-invite',['member_parent_id'=>$member_parent_id]);
    }

    public function MemberUserInviteStore(Request $request){
        $member = Member::find($request->get('member_id'));
        $member-> member_parent_id = $request->get('member_parent_id');

        if ($member ->save()){
            return redirect('mobile/person-list')->with('message', '1');
        }else{
            return redirect('mobile/person-list')->with('message', '0');
        }
    }

    public function Poster(){

        $poster = public_path('build/uploads/sc'.session('wechat_user')[0]['member_id'].'.png');
        if(!file_exists($poster)){
            (new Common())->Poster(url('build/img/haibao.png'),asset('build/uploads/qrcode'.session('wechat_user')[0]['member_id'].'.png'),public_path('build/uploads/sc'.session('wechat_user')[0]['member_id'].'.png'));
        }

        return view('mobile.poster-list');
    }

}
