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
    // 设置存储图片目录路径，文件名
    protected $path = 'build/uploads/poster';

    // 设置客户管理---推客--专属二维码中URL地址
    protected $HttpUrl = 'mobile/client/client-poster-invite?member_id=';


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



    // 推客----客户海报列表，生成海报页面---显示
    public function ClientPoster(Request $request,Common $common){

        // http://gddk99.tunnel.qydev.com/mobile/client/client-poster-invite?member_id=1

        // 接收ID参数
        $memberId = $common->If_com(Cache::get('mobile_user')['member_id']);
        // 生成二维码
        $common->QrCode($memberId,$this->path,$this->HttpUrl);
        // 读取图片，填写图片文件名，图片ID
        $poster = $common->PublicPath('sc_poster',$memberId);
        // 判断图片是否存在，不存在生成图片---取反
        if(!file_exists($poster)){
            // 背景图片，二维码，合成的图片及文件名路径
            $common->Poster($common->picUrlPath('posterbg.png'),$common->PublicPath('poster',$memberId),$common->PublicPath('sc_poster',$memberId),$dst_x='229',$dst_y='680');
        }
        // 获取图片输出到前端界面
        $poster_pic = $common->picUrlPath('sc_poster'.$memberId.'.png');

        return view('mobile.client.client-poster-list',['poster'=>$poster_pic]);

    }

    // 推客----客户海报列表---扫码跳转---填写绑定合伙人----跳转发展推客
    public function ClientPosterInvite(Request $request,Common $common,Member $member){

        // http://gddk99.tunnel.qydev.com/mobile/client/client-poster-invite?member_id=5

        // 接收ID参数
        $member_id = $request->get('member_id');
        $memberId = $common->If_com(Cache::get('mobile_user')['member_id']);

        // 显示所属上级资料
        $level = $member->find($member_id);

        // 判断父级ID不能与主见ID相同------调试阶段可以注释
        if ($member_id==$memberId){
            return redirect('mobile/client/client-poster-list')->with('message', '4');
        }elseif(!$level['member_id']==$member_id){
            return redirect('mobile/client/client-poster-list')->with('message', '5');
        }

        // 显示当前用户资料
        $member_user = $member->find($memberId);
        // 性别方法
        $member_sex = $member->Sex();

        // 组装判断数据，减少前端代码优雅
        $groupData =[
            'id'=> $level['member_id'],
            'avatar' => $common->If_val($common->picUrlPath($level['member_avatar']),$level['wechat_headimgurl']),
            'level_name' => $common->If_val($level['member_surname'],$level['wechat_nickname']),
            'user_name' => $common->If_val($member_user['member_surname'],$member_user['wechat_nickname']),
        ];

        return view('mobile.client.client-poster-invite',['member'=>$groupData,'member_user'=>$member_user,'member_sex'=>$member_sex]);

    }

    // 推客----客户海报列表---扫码跳转---填写绑定合伙人----跳转发展推客--存储
    public function ClientPosterInviteStore(Request $request,Member $member){
        // 接收POST参数
        $data = $request->except(['_token']);
        // 读取缓存验证码
        $cacheSms = Cache::get('sms');
        // 判断缓存的验证是否和传递过来的验证码是否相同
        if ($data['member_sms'] != $cacheSms){
            return redirect('mobile/client/client-poster-invite?member_id='.$data['member_parent_id'].'')->with('message', '2');
        }
        // 读取当前用户数据，推客父级以10开头，截取后位数，是否等等于10，保存数据
        $user_id = $member->find($data['member_id']);
        $str = $user_id['member_parent_id'];
        $num = substr($str,0,2);
        if ($num==10){
            return redirect('mobile/client/client-poster-invite-apply?member_id='.$data['member_parent_id'].'')->with('message', '3');
        }
        $user_id->member_surname = $data['member_surname'];
        $user_id->member_parent_id = '10'.$data['member_parent_id'];  // 10表示合伙人ID加拼接
        $user_id->member_sex = $data['member_sex'];
        $user_id->member_mobile = $data['member_mobile'];
        $user_id->created_at = date('Y-m-d H:i:s',time());

        if ($user_id ->save()){
            Cache::pull('sms');
            return redirect('mobile/client/client-poster-invite-apply?member_id='.$data['member_parent_id'].'')->with('message', '1');
        }else{
            return redirect('mobile/client/client-poster-invite-apply?member_id='.$data['member_parent_id'].'')->with('message', '0');
        }

    }

    // 推客----客户海报列表---扫码跳转---填写绑定合伙人----推客--邀请合伙人---跳转发展推客
    public function ClientPosterInviteApply(Request $request,Common $common,Member $member){

        //http://gddk99.tunnel.qydev.com/mobile/client/client-poster-invite-apply?member_id=5

        // 接收当前用户参数
        $member_id = $request->get('member_id');
        $memberId = $common->If_com(Cache::get('mobile_user')['member_id']);

        // 显示所属上级资料
        $level_user = $member->find($member_id);
        if ($member_id==$memberId){
            return redirect('mobile/client/client-poster-list')->with('message', '4');
        }elseif(!$member['member_id']==$member_id){
            return redirect('mobile/client/client-poster-list')->with('message', '5');
        }

        //显示当前用户资料
        $member_user = $member->find($memberId);

        // 性别方法
        $member_sex = $member->Sex();

        return view('mobile.client/client-poster-invite-apply',['member'=>$level_user,'member_user'=>$member_user,'member_sex'=>$member_sex]);

    }

    // 推客----客户海报列表---扫码跳转---填写绑定合伙人----推客--邀请合伙人---跳转发展推客--存储
    public function ClientPosterInviteApplyStore(Request $request,Info $info){

        // 接收POST参数，并且组装数据
        $data =$request->except(['_token']);
        $guopData =$request->except(['_token','info_sms','member_id']);
        $member_id = ['member_id'=>'10'.$data['member_id']];

        // 读取缓存验证码
        $cacheSms = Cache::get('sms');
        if ($data['info_sms'] != $cacheSms){
            return redirect('mobile/client/client-poster-invite-apply?member_id='.$data['info_invite'].'')->with('message', '2');
        }
        // 插入数据
        $result = $info->create(array_merge($guopData,$member_id));

        // 重定向
        if ($result){
            Cache::forget('sms');
            return redirect('mobile/client/client-poster-invite-apply?member_id='.$data['info_invite'].'')->with('message', '4');
        }else{
            return redirect('mobile/client/client-poster-invite-apply?member_id='.$data['info_invite'].'')->with('message', '5');
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
