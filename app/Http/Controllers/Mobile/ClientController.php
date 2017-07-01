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
            QrCode::encoding('UTF-8')->format('png')->size(200)->margin(1)->generate($url,public_path('build/uploads/poster'.$memberID.'.png'));
        }

        //生成海报
        $poster = public_path('build/uploads/sc_poster'.$memberID.'.png');
        if(!file_exists($poster)){
            (new Common())->PosterUnion(url('build/img/poster.png'),asset('build/uploads/poster'.$memberID.'.png'),public_path('build/uploads/sc_poster'.$memberID.'.png'));
        }

        return view('mobile.client-poster-list',['member_id'=>$member_id]);
    }

    public function ClientPosterInvite(Request $request){
        // http://www.gddk99.com/mobile/client-poster-invite?member_id=1;
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
        $member_sex = (new Member())->Sex();

        return view('mobile.client-poster-invite',['member'=>$member,'member_user'=>$member_user,'member_sex'=>$member_sex]);
    }

    public function ClientPosterInviteStore(Request $request){

        $member_surname = $request->get('member_surname');
        $member_id = $request->get('member_id');
        $member_parent_id = $request->get('member_parent_id');
        $member_sex = $request->get('member_sex');
        $member_mobile = $request->get('member_mobile');
        $member_sms = $request->get('member_sms');
        $cacheSms = Cache::get('sms');

        if ($member_sms != $cacheSms){
            return redirect('mobile/client-poster-invite?member_id='.$member_parent_id.'')->with('message', '2');
        }

        $member = Member::find($member_id);
        $str = $member['member_parent_id'];
        $num = substr($str,0,2);
        if ($num==10){
            return redirect('mobile/client-poster-invite-apply?member_id='.$member_parent_id.'')->with('message', '3');
        }
        $member->member_surname = $member_surname;
        $member->member_parent_id = '10'.$member_parent_id;  // 10表示合伙人ID加拼接
        $member->member_sex = $member_sex;
        $member->member_mobile = $member_mobile;
        $member->created_at = date('Y-m-d H:i:s',time());

        if ($member ->save()){
            Cache::forget('sms');
            return redirect('mobile/client-poster-invite-apply?member_id='.$member_parent_id.'')->with('message', '1');
        }else{
            return redirect('mobile/client-poster-invite-apply?member_id='.$member_parent_id.'')->with('message', '0');
        }

    }

    public function ClientPosterInviteApply(Request $request){
        //http://www.gddk99.com/mobile/client-poster-invite-apply?member_id=1

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
        $member_sex = (new Member())->Sex();

        return view('mobile.client-poster-invite-apply',['member'=>$member,'member_user'=>$member_user,'member_sex'=>$member_sex]);
    }

    public function ClientPosterInviteApplyStore(Request $request){
            $name = $request->get('info_name');
            $sex = $request->get('info_sex');
            $quota = $request->get('info_quota');
            $mobile = $request->get('info_mobile');
            $memberID = $request->get('member_id');
            $invite = $request->get('info_invite');

            $info_sms =$request->get('info_sms');
            $cacheSms = Cache::get('sms');
            if ($info_sms != $cacheSms){
                return redirect('mobile/client-poster-invite-apply?member_id='.$invite.'')->with('message', '2');
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
                return redirect('mobile/client-poster-invite-apply?member_id='.$invite.'')->with('message', '4');
            }else{
                return redirect('mobile/client-poster-invite-apply?member_id='.$invite.'')->with('message', '5');
            }
    }

    public function ClientUnionShow($member_id){
        $member = Member::where('member_parent_id','10'.$member_id)->get();
        $total = count($member);
        return view('mobile.client-union-show',['member'=>$member,'total'=>$total]);
        
        /*$info = Info::where('info_invite',$member_id)->get()->toArray();
        $info_all = array_column($info,'member_id');
        dd($info_all);
        $num = $info['member_id'];
        $str = substr($num,2,100);
        $member = Member::where('member_id',$str)->get();
        return view('mobile.client-union-show',['member'=>$member,'info'=>$info]);*/
    }

    public function ClientUnionList($member_id){
        $info = Info::join('members','infos.info_invite','=','members.member_id')->where('info_invite',$member_id)->get();
        return view('mobile.client-union-list',['info'=>$info]);
    }

    public function ClientUnionDetails($info_id,$member_id){
        $info = Info::join('members','infos.info_invite','=','members.member_id')->where('info_invite','=',$member_id,'AND','info_id','=',$info_id)->get();
        $info_member =  Info::where('info_id',$info_id)->first();
        $num = $info_member['member_id'];
        $str = substr($num,2,100);
        $member = Member::where('member_id',$str)->first();
        return view('mobile.client-union-details',['info'=>$info,'member'=>$member,'info_member'=>$info_member]);
    }

}
