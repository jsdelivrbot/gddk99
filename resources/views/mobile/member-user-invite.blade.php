@extends('layouts.mobile')
@section('content')

    <div class="pet_grzx">
        <div class="pet_grzx_nr">
            {{--<div class="pet_grzx_ico">
                <img src="{{ empty(file_exists(url('build/uploads/'.$member['member_avatar'])))? $member['wechat_headimgurl'] :url('build/uploads/'.$member['member_avatar'])}}" alt="">
            </div>--}}
            <div class="pet_grzx_name">扫码成功！</div>

            <div class="pet_grzx_num_font">
                即将成为<font color="red">{{ empty($member['member_surname'])? $member['wechat_nickname']:$member['member_surname'] }}</font>下线发展经纪人
            </div>

            <br>
            {!! Form::open(['url'=>'mobile/member-user-invite','method'=>'POST','class'=>'am-form','data-am-validator']) !!}
            <fieldset>
                <legend>申请成为经纪人</legend>
                <div class="am-form-group">
                    <label for="member_surname">姓名：</label>
                    <input type="text" id="member_surname" name="member_surname" value="{{ $member_user['member_surname'] }}" minlength="2" placeholder="输入您的姓名" required/>
                    <input type="hidden" name="member_id" value="{{ $member_user['member_id'] }}">
                    <input type="hidden" name="member_parent_id" value="{{ $member['member_id'] }}">
                </div>

                <div class="am-form-group">
                    <label for="member_sex">性别</label>
                    <select id="member_sex" name="member_sex" required>
                        @foreach($member_sex as $sex)
                            <option value="{{ $sex['sex_number'] }}" @if($sex['sex_number'] == $member_user['member_sex']) selected @endif>
                                {{ $sex['sex_name'] }}
                            </option>
                        @endforeach
                    </select>
                    <span class="am-form-caret"></span>
                </div>

                <div class="am-form-group">
                    <label for="member_mobile">手机：</label>
                    <input type="text" id="member_mobile" name="member_mobile" value="{{ $member_user['member_mobile'] }}" minlength="2" placeholder="输入您的手机" required/>
                </div>

                <div class="am-form-group">
                    <label for="member_card">身份证号：</label>
                    <input type="text" id="member_card" name="member_card" minlength="2" value="{{ $member_user['member_card'] }}" placeholder="输入您的身份证号" required/>
                </div>

                <div class="am-form-group">
                    <label for="member_add">地址：</label>
                    <input type="text" id="member_add" name="member_add" value="{{ $member_user['member_add'] }}" minlength="2" placeholder="输入您的地址" required/>
                </div>

                <div class="am-g am-g-fixed">
                    <div class="am-u-sm-6" style="margin: 0; padding: 0;">
                        <button type="submit" class="am-btn am-btn-primary am-btn-block">确定</button>
                    </div>
                    <div class="am-u-sm-6" style="margin: 0; padding: 0;">
                        <a href="{{ url('mobile/person-list') }}" class="am-btn am-btn-success am-btn-block">取消</a>
                    </div>
                </div>

            </fieldset>
            {!! Form::close() !!}
        </div>
        <div style="height: 30px;"></div>
    </div>

@endsection