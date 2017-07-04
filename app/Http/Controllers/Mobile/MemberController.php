<?php

namespace App\Http\Controllers\Mobile;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Common;
use Cache;

class MemberController extends Controller
{
    // 设置存储图片目录路径
    protected $path = 'build/uploads/qrcode';

    // 设置会员管理---个人中心--专属二维码中URL地址
    protected $HttpUrl = 'mobile/member/member-user-invite?member_parent_id=';


    // 会员管理---个人中心列表显示
    public function Person(Request $request,Member $member,Common $common){

        // 接收ID参数
        $memberUser = $common->If_com(Cache::get('mobile_user')['member_id']);
        // 从数据库读取数据
        $member = $member->find($memberUser);
        $memberID = $member['member_id'];
        // 生成二维码
        $Qrcode = $common->QrCode($memberID,$this->path,$this->HttpUrl);

        // 组装判断数据，减少前端代码优雅
        $groupData =[
            'avatar' => $common->If_val($common->picUrlPath($member['member_avatar']),$member['wechat_headimgurl']),
            'name' => $common->If_val($member['member_surname'],$member['wechat_nickname']),
        ];

        return view('mobile.member.person-list',['groupData'=>$groupData,'member' => $member,'qrcode'=>$Qrcode]);

    }

    // 会员管理---个人中心--生成海报页面--扫码成为经纪人
    public function Poster(Common $common){

        // 接收ID参数
        $memberId = $common->If_com(Cache::get('mobile_user')['member_id']);
        // 读取图片
        $poster = $common->PublicPath('sc',$memberId);

        // 判断图片是否存在，不存在生成图片---取反
        if(!file_exists($poster)){
            $common->Poster($common->picUrlPath('haibao.png'),$common->PublicPath('qrcode',$memberId),$common->PublicPath('sc',$memberId));
        }
        // 获取图片输出到前端界面
        $poster_pic = $common->picUrlPath('sc'.$memberId.'.png');

        return view('mobile.member.poster-list',['poster'=>$poster_pic]);
    }


    //会员管理---个人中心--生成海报页面--扫码成为经纪人--扫码跳转页面
    public function MemberUserInvite(Request $request,Common $common,Member $member)
    {
        // http://gddk99.tunnel.qydev.com/mobile/member/member-user-invite?member_parent_id=2

        // 接收ID参数
        $member_parent_id = $request->get('member_parent_id');
        $memberId = $common->If_com(Cache::get('mobile_user')['member_id']);

        // 显示所属上级资料
        $member_parent = $member->find($member_parent_id);

        // 判断父级ID不能与主见ID相同------调试阶段可以注释
        if ($member_parent_id==$memberId){
            return redirect('mobile/member/person-list')->with('message', '4');
        }elseif(!$member_parent['member_id']==$member_parent_id){
            return redirect('mobile/member/person-list')->with('message', '5');
        }

        // 显示当前用户资料
        $member_user = $member->find($memberId);
        // 性别方法
        $member_sex = $member->Sex();

        // 组装判断数据，减少前端代码优雅
        $groupData =[
            'id'=> $member_parent['member_id'],
            'avatar' => $common->If_val($common->picUrlPath($member_parent['member_avatar']),$member_parent['wechat_headimgurl']),
            'name' => $common->If_val($member_parent['member_surname'],$member_parent['wechat_nickname']),
        ];

        return view('mobile.member.member-user-invite',['member_parent'=>$groupData,'member_user'=>$member_user,'member_sex'=>$member_sex]);

    }

    //会员管理---个人中心--生成海报页面--扫码成为经纪人--扫码跳转页面--存储
    public function MemberUserInviteStore(Request $request,Member $member){

        // 接收POST参数
        $data = $request->except(['_token','member_sms']);
        // 判断手机验证码是否正确
        $cacheSms = Cache::get('sms');
        if ($request->get('member_sms') != $cacheSms){
            return redirect('mobile/member/member-user-invite?member_parent_id='.$data['member_parent_id'].'')->with('message', '2');
        }
        // 更新操作，成功与否
        $result = $member->where('member_id',$data['member_id'])->update(array_merge($data));
        if ($result){
            Cache::forget('sms');
            return redirect('mobile/member/person-list')->with('message', '1');
        }else{
            return redirect('mobile/member/person-list')->with('message', '0');
        }

    }

    // 会员管理---个人中心---完善资料
    public function PersonEdit($member_id,Member $member,Common $common){

        $user_data = $member->find($member_id);

        // 组装判断数据，减少前端代码优雅
        $groupData =[
            'avatar' => $common->If_val($common->picUrlPath($user_data['member_avatar']),$user_data['wechat_headimgurl']),
            'sex' => $member->Sex(),
            'card' => $member->cardType()
        ];

        return view('mobile.member.person-edit',['member'=>$user_data,'data'=>$groupData]);
    }

    // 会员管理---个人中心---完善资料--存储
    public function PersonEditStore(Request $request,Common $common,Member $member){

        // 接收POST参数数据
        $data =$request->except(['_token']);
        // 判断POST是否提交变量
        if($request->isMethod('POST')) {
            //读取头像并且更新,同时POST头像是否为空
            $data_ava = $request->file('member_avatar');
            $avatar = $common->FileOne($data_ava);
            // 判断头像是否存在
            if (empty($avatar)){
                // 更新操作，成功与否---未上传头像
                $result = $member->where('member_id',$data['member_id'])->update(array_except($data,['member_avatar']));
                return $this->PersonJump($result);
            }else{
                // 已上传头像，并且查询数据库头像是否存在，如果存在，删除替换，不存在忽略
                $detect = $member->find($data['member_id']);
                // 1.填写POST数据， 2填写数据库数据，进行匹配是否相同，如果相同删除返回 true
                $common->DataPic($data['member_avatar'],$detect['member_avatar']);
                // 判断上传成功的图片文件名是否为空，如果为空 默认数据库图片文件名，不为空则更换
                $ava = $common->if_empty($avatar,$detect['member_avatar']);
                // 更新操作，成功与否---已上传头像
                $result = $member->where('member_id',$data['member_id'])->update(array_merge(array_except($data,['member_avatar']),['member_avatar'=>$ava]));
                return $this->PersonJump($result);
            }
        }
    }

    // 封装--  会员管理---个人中心---完善资料--存储---跳转
    protected function PersonJump($result){
        if ($result){
            return redirect('mobile/member/person-list')->with('message', '3');
        }else{
            return redirect('mobile/member/person-list')->with('message', '2');
        }
    }

    // 会员管理---发送验证码
    public function Send(Request $request,Common $common){
        $common->Send_sms($request->get('mobile'));
    }

    // 我的经纪人列表---显示
    public function UnionList($member_id,Member $member){
        $union =$member->where('member_parent_id',$member_id)->get();
        return view('mobile.member.union-list',['union'=>$union]);
    }

    // 退出
    public function Logout(){
        Cache::pull('mobile_user');
        Cache::pull('scope');
        return redirect('mobile/index');
    }

}
