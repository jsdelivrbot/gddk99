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


    // 立即申请贷款----客户列表
    public function ClientList(Common $common){
        // 接收ID参数
        $memberId = $common->If_com(session('mobile_user')['member_id']);
        return view('mobile.client.client-list',['member_id'=>$memberId]);
    }

    // 立即申请贷款----客户列表--存储
    public function ClientListStore(Request $request,Common $common,Info $info){

        // 接收ID参数，组装数据
        $data =$request->except(['_token']);
        $memberId = $common->If_com(session('mobile_user')['member_id']);
        $member_id = ['member_id'=> $common->if_empty($memberId)];

        // 读取缓存验证码
        $cacheSms = Cache::get('sms');
        if ($data['info_sms'] != $cacheSms){
            return redirect('mobile/client/client-list')->with('message', '2');
        }

        // 插入数据
        $result = $info->create(array_merge(array_except($data,['info_sms']),$member_id));
        if ($result){
            Cache::pull('sms');
            return redirect('mobile/client/client-list')->with('message', '1');
        }else{
            return redirect('mobile/client/client-list')->with('message', '0');
        }

    }

    // 推客----客户海报列表，生成海报页面---显示
    public function ClientPoster(Request $request,Common $common){

        // http://gddk99.tunnel.qydev.com/mobile/client/client-poster-invite?member_id=1

        // 接收ID参数
        $memberId = $common->If_com(session('mobile_user')['member_id']);
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
        $memberId = $common->If_com(session('mobile_user')['member_id']);

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

        //读取父级用户数据
        $member_parent_id = $member->find($data['member_parent_id']);

        // 读取当前用户数据，推客父级以10开头，截取后位数，是否等等于10，保存数据
        $user_id = $member->find($data['member_id']);
        $str = $user_id['member_parent_id'];
        $num = substr($str,0,2);

        // 是否等等于10，如果是跳转，你已经是推客身份了，不是则改变，保存数据
        if ($num==10){
            return redirect('mobile/client/client-poster-invite-apply?member_id='.$data['member_parent_id'].'')->with('message', '3');
        }

        // 需要审核,0未审核，1初审核，2审核完成
        if ($member_parent_id['member_check']==Member::MEMBER_CHECK_ONE){

            $user_id->member_surname = $data['member_surname'];
            $user_id->member_parent_id = '10'.$data['member_parent_id'];  // 10表示合伙人ID加拼接
            $user_id->member_sex = $data['member_sex'];
            $user_id->member_mobile = $data['member_mobile'];
            $user_id->member_status = Member::MEMBER_STATUS_TWO;
            $user_id->created_at = date('Y-m-d H:i:s',time());

            if ($user_id ->save()){
                Cache::pull('sms');
                return redirect('mobile/member/ordinary-person-list')->with('message', 'ordinary1');
            }else{
                return redirect('mobile/member/ordinary-person-list')->with('message', 'ordinary0');
            }

        }

    }

    // 推客----客户海报列表---扫码跳转---填写绑定合伙人----推客--邀请合伙人---跳转发展推客
    public function ClientPosterInviteApply(Request $request,Common $common,Member $member){

        //http://gddk99.tunnel.qydev.com/mobile/client/client-poster-invite-apply?member_id=5

        // 接收当前用户参数
        $member_id = $request->get('member_id');
        $memberId = $common->If_com(session('mobile_user')['member_id']);

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

    // 我的合伙人列表
    public function ClientUnionShow($member_id,Member $member){

        // 接收参数读取数据
        $members = $member->find($member_id);
        // 定义数组
        $mem_union[]='';
        // 遍历数据
        $union = $member->where('member_parent_id',$members['member_id'])->get();
        foreach ($union as $unList){
            $mem_union[]=[
                'union_user_id' => $unList['member_id'],
                'union_user_name' => $unList['member_surname'],  //我名下的合伙人姓名
                'union_user_time' => $unList['created_at'],
                'union_user_avatar' => $unList['wechat_headimgurl'],
            ];
        }
        $member_union = array_filter($mem_union);

        return view('mobile.client.client-union-show',['member'=>$member_union,'total'=>count($member_union)]);
    }

    // 我的合伙人--申报客户列表
    public function ClientUnionList($member_id,Info $info){
        $info_data = $info->join('members','infos.info_invite','=','members.member_id')->where('info_invite',$member_id)->get();
        return view('mobile.client-union-list',['info'=>$info_data]);
    }

    // 我的合伙人--申报客户列表--详情
    public function ClientUnionDetails($info_id,$member_id,Member $member,Info $info){
        $info_data = $info->join('members','infos.info_invite','=','members.member_id')->where('info_invite','=',$member_id,'AND','info_id','=',$info_id)->get();
        $info_member = $info->where('info_id',$info_id)->first();
        $num = $info_member['member_id'];
        $str = substr($num,2,100);
        $member_data = $member->where('member_id',$str)->first();
        return view('mobile.client-union-details',['info'=>$info_data,'member'=>$member_data,'info_member'=>$info_member]);
    }

    // 我的客户列表---vip--显示
    public function ClientVipShow($member_id,Info $info){
        // 读取推客所有客户信息
        $infos = $info->where('info_invite',$member_id)->get();
        $total = count($infos);
        return view('mobile.client.client-vip-show',['info'=>$infos,'total'=>$total]);
    }

}
