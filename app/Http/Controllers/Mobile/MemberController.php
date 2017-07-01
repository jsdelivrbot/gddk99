<?php

namespace App\Http\Controllers\Mobile;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
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

        // 判断图片是否存在，不存在生成图片
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

    // 会员管理---发送验证码
    public function Send(Request $request,Common $common){
        $common->Send_sms($request->get('mobile'));
    }

    public function UnionList($member_id){
        $union = Member::where('member_parent_id',$member_id)->get();
        return view('mobile.union-list',['union'=>$union]);
    }

}
