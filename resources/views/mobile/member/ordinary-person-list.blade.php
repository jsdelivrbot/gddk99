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
                <li><a href="{{ url('/mobile/member/person-edit',['member_id'=>$member['member_id']]) }}"><i class="am-icon-pencil am-icon-fw"></i>完善个人信息</a></li>
            </ul>
        </div>
    </div>

    @include('include.mobile.guide')
@endsection