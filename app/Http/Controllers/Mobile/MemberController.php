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

    public function PersonEdit($member_id){
        $member = Member::find($member_id);
        $member_sex = (new Member())->Sex();
        return view('mobile.person-edit',['member'=>$member,'member_sex'=>$member_sex]);
    }

    public function PersonEditStore(Request $request){
        //dd($request->all());
        $member_name = $request->get('member_name');
        $password = $request->get('password');
        $member_surname = $request->get('member_surname');
        $member_id = $request->get('member_id');
        // $wechat_nickname = $request->get('wechat_nickname');
        $member_sex = $request->get('member_sex');
        $member_age = $request->get('member_age');
        $member_mobile = $request->get('member_mobile');
        $member_tel = $request->get('member_tel');
        $member_card = $request->get('member_card');
        $member_content = $request->get('member_content');
        $member_add = $request->get('member_add');
        $member_avatar = $request->file('member_avatar');

        if($request->isMethod('POST')) {
            $pic = new Common();
            $av_pic = $pic->FileOne($member_avatar);
            if (empty($av_pic)) {
                $member = Member::find($member_id);
                $member->member_name = empty($member_name) ? null:$member_name;
                $member->password = empty($password) ? null:$password;
                $member->member_surname = $member_surname;
                $member->member_sex = $member_sex;
                $member->member_age = $member_age;
                $member->member_mobile = $member_mobile;
                $member->member_tel = $member_tel;
                $member->member_card = $member_card;
                $member->member_content = $member_content;
                $member->member_add = $member_add;
                if ($member->save()){
                    return redirect('mobile/person-list')->with('message', '3');
                }else{
                    return redirect('mobile/person-list')->with('message', '2');
                }
            } else {
                $member = Member::find($member_id);
                if (isset($member_avatar)) {
                    if (!empty($member['member_avatar'])) {
                        $images = public_path('build/uploads/') . $member['member_avatar'];
                        if (file_exists($images)) {
                            unlink($images);
                        }
                    }
                }
                $member->member_name = empty($member_name) ? null:$member_name;
                $member->password = empty($password) ? null:$password;
                $member ->member_avatar = empty($av_pic)? $member['member_avatar'] :$av_pic;
                $member->member_surname = $member_surname;
                $member->member_sex = $member_sex;
                $member->member_age = $member_age;
                $member->member_mobile = $member_mobile;
                $member->member_tel = $member_tel;
                $member->member_card = $member_card;
                $member->member_content = $member_content;
                $member->member_add = $member_add;
                if ($member->save()){
                    return redirect('mobile/person-list')->with('message', '3');
                }else{
                    return redirect('mobile/person-list')->with('message', '2');
                }
            }

        }

    }

}
