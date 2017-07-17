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

    // 推客----客户海报列表，生成海报页面---显示---改了推客
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

    // 推客----客户海报列表---扫码跳转---填写绑定合伙人----跳转发展推客---改了推客
    public function ClientPosterInvite(Request $request,Member $member){

        // 接收ID参数
        $member_id = $request->get('member_id');

        // 读取父级用户信息
        $members = $member->find($member_id);

        return view('mobile.client.client-poster-invite',['member'=>$members]);

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
        $data = $info->where('member_id','10'.$member_id)->get();
        $total = count($infos)+count($data);
        return view('mobile.client.client-vip-show',['info'=>$infos,'total'=>$total,'data'=>$data]);
    }

}
