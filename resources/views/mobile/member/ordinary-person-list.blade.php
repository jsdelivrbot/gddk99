@extends('layouts.mobile')
@section('title','个人中心')
@section('content')

    <div class="pet_grzx">
        <div class="pet_grzx_nr">
            <div class="pet_grzx_ico">
                <img src="{{ $groupData['avatar']  }}" alt="">
            </div>
            <div class="pet_grzx_name">{{ $groupData['name'] }}</div>

            <div class="pet_grzx_num_font">
                您当前是：{{ $groupData['type'] }}
            </div>

            @if($member['member_status']==\App\Member::MEMBER_STATUS_TWO)
                <div class="pet_grzx_num_font">
                    <font color="red">正在初审核推客身份，请耐心等待...</font>
                </div>
            @elseif($member['member_status']==\App\Member::MEMBER_STATUS_THREE)
                <div class="pet_grzx_num_font">
                    <font color="red">初审核通过，请耐心等待...</font>
                </div>
            @endif

            <div class="pet_grzx_num">
                <span>653<i>喜欢</i></span>
                <span>236<i>关注</i></span>
                <span>36<i>文章</i></span>
            </div>

            <ul class="am-list am-list-border">

                <li>
                    <a href="#"><i class="am-icon-briefcase am-icon-fw"></i>
                        客户列表
                    </a>
                </li>
                <li>
                    <a href="#"> <i class="am-icon-book am-icon-fw"></i>
                        我的佣金
                    </a>
                </li>
                <li>
                    <a href="#"> <i class="am-icon-user-plus am-icon-fw"></i>
                        申请成为推客
                    </a>
                </li>
                <li><a href="{{ url('/mobile/member/person-edit',['member_id'=>$member['member_id']]) }}"><i class="am-icon-pencil am-icon-fw"></i>完善个人信息</a></li>
            </ul>
        </div>
    </div>

    @include('include.mobile.guide')
@endsection

@section('script')
    @if(Session::has('message'))
        @if(Session::get('message')==3)
            <script>layer.msg('信息完善成功！', {icon: 6}); </script>
        @elseif(Session::get('message')==2)
            <script>layer.msg('信息完善失败！', {icon: 5}); </script>
        @elseif(Session::get('message')=='ordinary1')
            <script>layer.msg('审核提交成功！', {icon: 6}); </script>
        @elseif(Session::get('message')=='ordinary0')
            <script>layer.msg('审核提交失败！', {icon: 5}); </script>
        @endif
    @endif
@endsection