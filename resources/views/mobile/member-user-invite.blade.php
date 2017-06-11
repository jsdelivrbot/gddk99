@extends('layouts.mobile')
@section('content')

    <div class="pet_grzx">
        <div class="pet_grzx_nr">
            <div class="pet_grzx_name">扫码成功！</div>

            <div class="pet_grzx_num_font">
                即将成为<font color="red">{{ session('wechat_user')[0]['member_name']=="" ? session('wechat_user')[0]['wechat_nickname'] : session('wechat_user')[0]['member_name'] }}</font>下线发展合伙人
            </div>

            <br>
            <div class="pet_grzx_num_font">
                {!! Form::open(['url'=>'mobile/member-user-invite','method'=>'POST']) !!}
                <input type="hidden" name="member_parent_id" value="{{ $member_parent_id }}">
                <input type="hidden" name="member_id" value="{{ session('wechat_user')[0]['member_id'] }}">
                <div class="am-g am-g-fixed">
                    <div class="am-u-sm-6" style="margin: 0; padding: 0;">
                        <button type="submit" class="am-btn am-btn-primary am-btn-block">确定</button>
                    </div>
                    <div class="am-u-sm-6" style="margin: 0; padding: 0;">
                        <a href="{{ url('mobile/person-list') }}" class="am-btn am-btn-success am-btn-block">取消</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div style="height: 100px;"></div>
    </div>

@endsection