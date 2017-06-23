<?php

namespace App\Http\Controllers\Mobile;

use App\Info;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Common\Common;
use Cache;

class ClientController extends Controller
{
    public function ClientList(){
        return view('mobile.client-list');
    }

    public function ClientListStore(Request $request){

        $id= session('wechat_user');
        $member_id = isset($id[0]['member_id']) ? $id[0]['member_id'] : $id['member_id'];

        $name = $request->get('info_name');
        $sex = $request->get('info_sex');
        $quota = $request->get('info_quota');
        $mobile = $request->get('info_mobile');
        $memeberID = $member_id;

        $info_sms =$request->get('info_sms');
        $cacheSms = Cache::get('sms');
        if ($info_sms != $cacheSms){
            return redirect('mobile/client-list')->with('message', '2');
        }

        $info = new Info();
        $info ->info_name = $name;
        $info ->info_sex = $sex;
        $info ->info_quota = $quota;
        $info ->info_mobile = $mobile;
        $info ->member_id = $memeberID? $memeberID :'0';

        if ($info ->save()){
            Cache::forget('sms');
            return redirect('mobile/client-list')->with('message', '1');
        }else{
            return redirect('mobile/client-list')->with('message', '0');
        }

    }

    public function ClientPoster(Request $request){

        // http://gddk99.tunnel.qydev.com/mobile/client-poster-invite?member_id=1
        // 生成二维码
        $id= session('wechat_user');
        $member_id = isset($id[0]['member_id']) ? $id[0]['member_id'] : $id['member_id'];

        $memberID = $member_id;
        $qrcode_pictrue = public_path('build/uploads/poster'.$memberID.'.png');
        if(!file_exists($qrcode_pictrue)){
            $url='http://'.$request->getHttpHost().'/mobile/client-poster-invite?member_id='.$memberID;
            QrCode::encoding('UTF-8')->format('png')->size(200)->generate($url,public_path('build/uploads/poster'.$memberID.'.png'));
        }

        //生成海报
        $poster = public_path('build/uploads/sc_poster'.$memberID.'.png');
        if(!file_exists($poster)){
            (new Common())->Poster(url('build/img/haibao.png'),asset('build/uploads/poster'.$memberID.'.png'),public_path('build/uploads/sc_poster'.$memberID.'.png'));
        }

        return view('mobile.client-poster-list',['member_id'=>$member_id]);
    }

    public function ClientPosterInvite(Request $request){
        $id= session('wechat_user');
        $memberId = isset($id[0]['member_id']) ? $id[0]['member_id'] : $id['member_id'];
        $member_id = $request->get('member_id');
        $sessionID = $memberId;

        // 显示所属上级资料
        $member = Member::find($member_id);
        if ($member_id==$sessionID){
            return redirect('mobile/client-poster-list')->with('message', '4');
        }elseif(!$member['member_id']==$member_id){
            return redirect('mobile/client-poster-list')->with('message', '5');
        }

        //显示当前用户资料
        $member_user = Member::find($sessionID);

        return view('mobile.client-poster-invite',['member'=>$member,'member_user'=>$member_user]);
    }

    public function ClientPosterInviteStore(Request $request){
        $name = $request->get('info_name');
        $sex = $request->get('info_sex');
        $quota = $request->get('info_quota');
        $mobile = $request->get('info_mobile');
        $memberID = $request->get('member_id');
        $invite = $request->get('info_invite');

        $info_sms =$request->get('info_sms');
        $cacheSms = Cache::get('sms');
        if ($info_sms != $cacheSms){
            return redirect('mobile/client-poster-invite?member_id='.$invite.'')->with('message', '2');
        }

        $info = new Info();
        $info ->info_name = $name;
        $info ->info_sex = $sex;
        $info ->info_quota = $quota;
        $info ->info_mobile = $mobile;
        $info ->member_id = '10'.$memberID;
        $info ->info_invite = $invite;

        if ($info ->save()){
            Cache::forget('sms');
            return redirect('mobile/client-poster-invite?member_id='.$invite.'')->with('message', '1');
        }else{
            return redirect('mobile/client-poster-invite?member_id='.$invite.'')->with('message', '0');
        }

    }
}
