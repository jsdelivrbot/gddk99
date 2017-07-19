<?php

namespace App\Http\Controllers\Mobile;

use App\Application;
use App\Info;
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


    // 会员管理---级别判定进入相应页面---个人中心列表显示
    public function Level(Common $common,Member $member){
        // 接收ID参数
        $memberId = $common->If_com(session('mobile_user')['member_id']);
        $members =$member->where('member_id',$memberId)->first();;
        switch ($members['member_type'])
        {
            case '1':
                return redirect()->action('Mobile\MemberController@OrdinaryPerson');
                break;
            case '2':
                return redirect()->action('Mobile\MemberController@Person');
                break;
            case '3':
                return redirect()->action('Mobile\MemberController@unionPerson');
                break;
            default:
                return redirect('/mobile/channel');
        }
    }

    // 会员管理---普通会员---个人中心列表显示
    public function OrdinaryPerson(Request $request,Member $member,Common $common){
        // 接收ID参数
        $memberUser = $common->If_com(session('mobile_user')['member_id']);
        // 从数据库读取数据
        $members = $member->where(['member_id'=>$memberUser,'member_type'=>Member::MEMBER_TYPE_ONE])->first();

        if (!$members['member_type']==Member::MEMBER_TYPE_ONE){
            return redirect('/mobile/member/person-level');
        }

        // 组装判断数据，减少前端代码优雅
        $groupData =[
            'avatar' => $common->If_val($common->picUrlPath($members['member_avatar']),$members['wechat_headimgurl']),
            'name' => $common->If_val($members['member_surname'],$members['wechat_nickname']),
            'type' => $member->memberType($members['member_type']),
        ];

        return view('mobile.member.ordinary-person-list',['groupData'=>$groupData,'member' =>$members]);
    }

    // 会员管理---VIP会员---个人中心列表显示
    public function Person(Request $request,Member $member,Common $common){

        // 接收ID参数
        $memberUser = $common->If_com(session('mobile_user')['member_id']);
        // 从数据库读取数据
        $member = $member->where(['member_id'=>$memberUser,'member_type'=>Member::MEMBER_TYPE_TWO])->first();
        $memberID = $member['member_id'];
        if (!$member['member_type']==Member::MEMBER_TYPE_TWO){
            return redirect('/mobile/member/person-level');
        }

        // 生成二维码
        $Qrcode = $common->QrCode($memberID,$this->path,$this->HttpUrl);

        // 组装判断数据，减少前端代码优雅
        $groupData =[
            'avatar' => $common->If_val($common->picUrlPath($member['member_avatar']),$member['wechat_headimgurl']),
            'name' => $common->If_val($member['member_surname'],$member['wechat_nickname']),
            'type' => $member->memberType($member['member_type']),
        ];

        return view('mobile.member.person-list',['groupData'=>$groupData,'member' =>$member,'qrcode'=>$Qrcode]);

    }

    // 会员管理---合伙人会员---个人中心列表显示
    public function unionPerson(Request $request,Member $member,Common $common){

        // 接收ID参数
        $memberUser = $common->If_com(session('mobile_user')['member_id']);

        // 从数据库读取数据
        $member = $member->where(['member_id'=>$memberUser,'member_type'=>Member::MEMBER_TYPE_THREE])->first();
        $memberID = $member['member_id'];
        if (!$member['member_type']==Member::MEMBER_TYPE_THREE){
            return redirect('/mobile/member/person-level');
        }

        // 生成二维码
        $Qrcode = $common->QrCode($memberID,$this->path,$this->HttpUrl);

        // 组装判断数据，减少前端代码优雅
        $groupData =[
            'avatar' => $common->If_val($common->picUrlPath($member['member_avatar']),$member['wechat_headimgurl']),
            'name' => $common->If_val($member['member_surname'],$member['wechat_nickname']),
            'type' => $member->memberType($member['member_type']),
        ];

        return view('mobile.member.union-person-list',['groupData'=>$groupData,'member' =>$member,'qrcode'=>$Qrcode]);

    }

    // 会员管理---个人中心--生成海报页面--扫码成为经纪人---改成推客
    public function Poster(Common $common,Member $member){

        // 接收ID参数
        $memberId = $common->If_com(session('mobile_user')['member_id']);

        // 查询当前用户，判断当前用户资料是否完善
        $members = $member->where('member_id',$memberId)->first();
        if ($members['member_mobile']==""){
            return redirect('/mobile/member/person-edit/'.$memberId.'')->with('message','1');
        }

        // 读取图片
        $poster = $common->PublicPath('sc',$memberId);

        // 判断图片是否存在，不存在生成图片---取反
        if(!file_exists($poster)){
            $common->Poster($common->picUrlPath('hbbg.png'),$common->PublicPath('qrcode',$memberId),$common->PublicPath('sc',$memberId),$dst_x='270',$dst_y='910');
        }

        // 获取图片输出到前端界面
        $poster_pic = $common->picUrlPath('sc'.$memberId.'.png');

        return view('mobile.member.poster-list',['poster'=>$poster_pic]);
    }


    //会员管理---个人中心--生成海报页面--扫码成为经纪人--扫码跳转页面---改成推客
    public function MemberUserInvite(Request $request,Common $common,Member $member)
    {
        // http://gddk99.tunnel.qydev.com/mobile/member/member-user-invite?member_parent_id=2

        // 接收ID参数,父级ID，当前用户ID
        $member_parent_id = $request->get('member_parent_id');
        $memberId = $common->If_com(session('mobile_user')['member_id']);

        return view('mobile.member.member-user-invite',['parent'=>$member_parent_id,'current'=>$memberId]);

    }

    //会员管理---个人中心--生成海报页面--扫码成为经纪人--扫码跳转页面--存储---改成推客
    public function MemberUserInviteStore(Request $request,Info $info){

        // 接收POST参数
        $data = $request->except(['_token','info_sms']);

        // 判断手机验证码是否正确
        $cacheSms = Cache::get('sms');
        if ($request->get('info_sms') != $cacheSms){
            return redirect('mobile/member/member-user-invite?member_parent_id='.$data['info_invite'].'')->with('message', '2');
        }

       // 组装存储数据
        $arr = array_except($data,'member_id');
        $id = ['member_id'=>'10'.$data['member_id']];

        // 存储数据库
        $result = $info->create(array_merge($arr,$id));

        if ($result){
            Cache::forget('sms');
            return redirect('mobile/member/member-user-invite?member_parent_id='.$data['info_invite'].'')->with('message', 'push');
        }else{
            return redirect('mobile/member/member-user-invite?member_parent_id='.$data['info_invite'].'')->with('message', '0');
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

    // 我的经纪人列表---显示---改成推客
    public function UnionList($member_id,Member $member,Application $application){

        // 读取父级数据
        $union =$member->where(['member_parent_id'=>'10'.$member_id])->orderBy('member_id','desc')->get();
        // 定义数据
        $app[]='';
        // 循环数组数据
        foreach ($union as $list){
            // 读取属于父级数据，并且拼接当前申请用户ID，和，所属名下ID，读取数据
            $apps = $application->where('member_id',$member_id.'|'.$list['member_id'])->get();
            // 循环数据，并且组装数据，过滤空数组数据
            foreach ($apps as $line){
                $app[]=[
                    'member_id' => $list['member_id'],
                    'member_status' => $list['member_status'],

                    'app_id' => $line['app_id'],
                    'app_name' => $line['app_name'],
                    'app_mobile' => $line['app_mobile'],
                    'app_pic_z' => $line['app_pic_z'],
                    'app_pic_b' => $line['app_pic_b'],
                    'app_type' => $line['app_type'],
                    'created_at' => $line['created_at'],
                ];
            }
        }
        $res = array_filter($app);
        $total = count($res);
        return view('mobile.member.union-list',['union'=>$res,'total'=>$total]);
    }

    // 我的个人中心---推客列表---查看客户
    public function PushListClientShow($member_id,Info $info){
        $info = $info->where('info_invite',$member_id)->get();
        $total =count($info);
        return view('mobile.member.push-list-client-show',['info'=>$info,'total'=>$total]);
    }

    // 我的合伙人设置功能---是否审核状态---详细资料
    public function unionListDetails($member_id,Member $member,Application $application){
        $union = $member->where('member_id',$member_id)->first();
        $str = substr($union['member_parent_id'],2,100);
        $app = $application->where('member_id',$str.'|'.$union['member_id'])->first();
        return view('mobile.member.union-list-details',['union'=>$union,'app'=>$app]);
    }

    // 退出
    public function Logout(){
        session()->forget('mobile_user');
        Cache::pull('scope');
        return redirect('mobile/index');
    }


    // 我的合伙人设置功能---是否初审核状态
    public function memberCheckStatus(Request $request,Member $member){
        // 接收参数
        $data=$request->except(['_token']);

        // 读取更新状态数据
        $member->where('member_id',$data['member_id'])->update($data);
        return redirect()->back();
    }

    // 我的合伙人设置功能---是否初审核状态---取消
    public function memberCancelStatus(Request $request,Member $member,Common $common,Application $application){
        // 接收参数
        $data=$request->except(['_token']);

        // 删除图片,删除数据
        $mem = $member->find($data['member_id']);
        $str = substr($mem['member_parent_id'],2,100);
        $app = $application->where('member_id',$str)->first();
        $common->DataPicDel($app['app_pic_z']);
        $common->DataPicDel($app['app_pic_b']);
        $app->delete($app['app_id']);

        // 读取更新状态数据
        $member->where('member_id',$data['member_id'])->update($data);
        return redirect()->back();
    }

    // 申请成为推客---列表
    public function PushApplyList(){
        return view('mobile.member.push-apply-list');
    }

    // 个人申请成为推客--填写资料
    public function PushPersonApply($member_id,Member $member,Common $common){
        // 接收参数
        $memberId = $common->If_com(session('mobile_user')['member_id']);
       // 读取当前用户信息
        $members = $member->find($memberId);
        // 判定是否完善信息
        if ($members['member_card']==""){
            return redirect('/mobile/member/person-edit/'.$memberId.'')->with('message','1');
        }
        // 判定当前用户是否申请过
        if ($members['member_status']==Member::MEMBER_STATUS_TWO){
            return redirect('/mobile/member/ordinary-person-list')->with('message','apply');
        }

        $sex = $member->Sex();
        $cardType = $member->cardType();
        return view('mobile.member.push-person-apply',['member'=>$members,'sex'=>$sex,'cardType'=>$cardType,'id'=>$member_id]);
    }

    // 个人申请成为推客--填写资料--存储
    public function PushPersonApplyStore(Request $request,Member $member,Application $application,Common $common){

        // 接收参数
        $picz =$request->file('app_pic_z');
        $picb =$request->file('app_pic_b');
        $member_id =$request->get('member_id');

        $data = $request->only(['app_name','app_mobile','app_sms','member_id']);
        $memberId = $common->If_com(session('mobile_user')['member_id']);

        // 判定验证码是否匹配
        $cacheSms = Cache::get('sms');

        if ($data['app_sms'] != $cacheSms){
            return redirect('mobile/member/push-person-apply/'.$data['member_id'].'')->with('message', 'yzm');
        }

        // 上传图片
        $arrPicZ = $common->FileOne($picz);
        $arrPicB = $common->FileOne($picb);
        $arrData = array_except($data,['app_sms','member_id']);


        // 修改当前用户状态
        $member->where('member_id',$memberId)->update(['member_status'=>Member::MEMBER_STATUS_TWO,'member_parent_id'=>'10'.$data['member_id']]);
        // 存储审核数据
        $result = $application->create(array_merge($arrData,['app_pic_z'=>$arrPicZ,'app_pic_b'=>$arrPicB,'member_id'=>$member_id.'|'.$memberId]));
        if ($result){
            Cache::forget('sms');
            return redirect('mobile/member/person-list')->with('message', '1');
        }else{
            return redirect('mobile/member/person-list')->with('message', '0');
        }

    }

    // 企业申请成为推客--填写资料
    public function PushFirmApply($member_id,Common $common,Member $member){

        // 接收参数
        $memberId = $common->If_com(session('mobile_user')['member_id']);

        // 读取当前用户信息
        $members = $member->find($memberId);

        // 判定是否完善信息
        if ($members['member_card']==""){
            return redirect('/mobile/member/person-edit/'.$memberId.'')->with('message','1');
        }

        // 判定当前用户是否申请过
        if ($members['member_status']==Member::MEMBER_STATUS_TWO){
            return redirect('/mobile/member/push-apply-list')->with('message','apply');
        }

        $cardType = $member->cardType();

        return view('mobile.member.push-firm-apply',['member'=>$members,'cardType'=>$cardType,'id'=>$member_id]);

    }

    // 企业申请成为推客--填写资料---存储
    public function PushFirmApplyStore(Request $request,Common $common,Member $member,Application $application){

        $pic = $request->file('app_pic_z');
        $data = $request->only(['app_name','member_id','app_nature','app_username','app_number','app_mobile']);
        $memberId = $common->If_com(session('mobile_user')['member_id']);

        // 判定验证码是否匹配
        $cacheSms = Cache::get('sms');

        if ($request->get('app_sms') != $cacheSms){
            return redirect('mobile/member/push-firm-apply/'.$data['member_id'].'')->with('message', 'yzm');
        }

        // 上传图片
        $arrPicZ = $common->FileOne($pic);

        // 修改当前用户状态
        $member->where('member_id',$memberId)->update(['member_status'=>Member::MEMBER_STATUS_TWO,'member_parent_id'=>'10'.$data['member_id']]);

        // 存储审核数据
        $result = $application->create(array_merge($data,['app_pic_z'=>$arrPicZ,'app_type'=>1]));
        if ($result){
            Cache::forget('sms');
            return redirect('mobile/member/person-list')->with('message', '1');
        }else{
            return redirect('mobile/member/person-list')->with('message', '0');
        }

    }

}
