@extends('layouts.mobile')
@section('content')

    <div class="pet_mian"  style="background-color: white;">

        <div class="pet_content_block pet_hd_con">
            <div class="pet_hd_con_head"><img src="{{ url('build/img/client-list.jpg') }}" alt=""></div>
        </div>

        {!! Form::open(['url'=>'/mobile/client/client-poster-invite','class'=>'am-form','data-am-validator']) !!}
        <fieldset>
            <legend style="font-size: 14px;">扫码成功！<font color="red">{{ $member['user_name'] }}</font> 即将成为 <font color="red">{{ $member['level_name'] }}</font> 名下发展合伙人</legend>
            <legend>完善推客资料</legend>
            <div class="am-form-group">
                <label for="wechat_nickname">昵称：</label>
                <input type="text" id="wechat_nickname" name="wechat_nickname" value="{{ $member_user['wechat_nickname'] or '' }}" disabled/>
            </div>

            <div class="am-form-group">
                <label for="member_surname">姓名：</label>
                <input type="text" id="member_surname" name="member_surname" value="{{ $member_user['member_surname'] }}" minlength="2" placeholder="输入您的姓名" required/>
                <input type="hidden" id="member_id" value="{{ $member_user['member_id'] }}" name="member_id"/>
                <input type="hidden" name="member_parent_id" value="{{ $member['id'] }}">
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
                <label for="member_mobile">手机号：</label>
                <div class="am-input-group">
                    <input type="text" id="member_mobile" name="member_mobile"  value="{{ $member_user['member_mobile'] }}" minlength="3" placeholder="输入您的手机号" required class="am-form-field">
                    <span class="am-input-group-btn">
                            <input type="button" id="btn" value="获取验证码" class="am-btn am-btn-default" onclick="settime(this),Sms()" />
                        </span>
                </div>
            </div>

            <div class="am-form-group">
                <label for="member_sms">验证码：</label>
                <input type="text" id="member_sms" name="member_sms" minlength="3" placeholder="输入您的手机验证码" required/>
            </div>

            <div class="am-g am-g-fixed">
                <div class="am-u-sm-6" style="margin: 0; padding: 0;">
                    <button type="submit" class="am-btn am-btn-warning am-btn-block">立即提交</button>
                </div>
                <div class="am-u-sm-6" style="margin: 0; padding: 0;">
                    <button type="button" class="am-btn am-btn-default am-btn-block" onclick="javascript:window.location='{{ url('mobile/index') }}'" >返回首页</button>
                </div>
            </div>

        </fieldset>
        {!! Form::close() !!}

    </div>

@endsection
@section('script')
    @if(Session::has('message'))
        @if(Session::get('message')==2)
            <script>layer.msg('验证码错误！', {icon: 5}); </script>
        @elseif(Session::get('message')==0)
            <script>layer.msg('提交失败！', {icon: 5}); </script>
        @endif
    @endif

    <script type="text/javascript">
        // 秒数JS
        var countdown=60;
        function settime(obj) {
            if (countdown == 0) {
                obj.removeAttribute("disabled");
                obj.value="发送验证码";
                countdown = 60;
                return;
            } else {
                obj.setAttribute("disabled", true);
                obj.value="重新发送(" + countdown + ")";
                countdown--;
            }
            setTimeout(function() {
                    settime(obj) }
                ,1000)
        }

        //发送请求
        function Sms() {
            var member_mobile = $("#member_mobile").val();
            $.post("{{url('/mobile/member/send')}}",{'_token':'{{csrf_token()}}','mobile':member_mobile});
        }
    </script>
@endsection