@extends('layouts.mobile')
@section('content')
    <div class="pet_mian"  style="background-color: white;">

        <div class="pet_content_block pet_hd_con">
            <div class="pet_hd_con_head"><img src="{{ url('build/img/client-list.jpg') }}" alt=""></div>
        </div>

        {!! Form::open(['url'=>'/mobile/member/push-person-apply','files'=>'true','class'=>'am-form','data-am-validator']) !!}
        <fieldset>
            <legend>个人申请成为推客</legend>
            <div class="am-form-group">
                <label for="app_name">姓名：</label>
                <input type="text" id="app_name" name="app_name" value="{{ $member['member_surname'] }}" minlength="2" placeholder="输入您的姓名" required/>
                <input type="hidden" id="member_id" name="member_id" value="{{ $id }}"/>
            </div>

            <div class="am-form-group">
                <label for="member_sex">性别</label>
                <select id="member_sex" name="member_sex" required>
                    @foreach($sex as $list)
                        <option value="{{ $list['sex_number'] }}" @if($list['sex_number'] == $member['member_sex']) selected @endif>
                            {{ $list['sex_name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="am-form-group">
                <label for="member_age">年龄：</label>
                <input type="text" id="member_age" value="{{ $member['member_age'] }}" name="member_age" minlength="1" placeholder="输入您的年龄" required/>
            </div>

            <div class="am-form-group">
                <label for="member_card">身份证号：</label>
                <input type="text" id="member_card" value="{{ $member['member_card'] }}" name="member_card" minlength="1" placeholder="输入您的身份证号码" required/>
            </div>

            <div class="am-form-group">
                <label for="app_pic_z">身份证正面：</label>
                <table class="am-table am-table-bordered">
                    <tr>
                        <td>
                            <div class="am-form-group am-form-file" style="margin-bottom: 0;">
                                <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                    <i class="am-icon-cloud-upload"></i> 选择上传身份证正面</button>
                                <input type="file" id="app_pic_z" name="app_pic_z" multiple required>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="am-form-group">
                <label for="app_pic_b">身份证背面：</label>
                <table class="am-table am-table-bordered">
                    <tr>
                        <td>
                            <div class="am-form-group am-form-file" style="margin-bottom: 0;">
                                <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                    <i class="am-icon-cloud-upload"></i> 选择上传身份证背面</button>
                                <input type="file" id="app_pic_b" name="app_pic_b" multiple required>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="am-form-group">
                <label for="member_card_type">卡号类型</label>
                <select id="member_card_type" name="member_card_type" required>

                    @foreach($cardType as $list)
                        <option value="{{ $list['id'] }}" @if($list['id'] == $member['member_card_type']) selected @endif>
                            {{ $list['name'] }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="am-form-group">
                <label for="member_bank_card">银行卡号：</label>
                <input type="text" id="member_bank_card" value="{{ $member['member_bank_card'] }}" name="member_bank_card" minlength="1" placeholder="输入您的银行卡号" required/>
            </div>

            <div class="am-form-group">
                <label for="app_mobile">手机号：</label>
                <div class="am-input-group">
                    <input type="text" id="app_mobile" value="{{ $member['member_mobile'] }}" name="app_mobile" minlength="3" placeholder="输入您的手机号" required class="am-form-field">
                    <span class="am-input-group-btn">
                        <input type="button" id="btn" value="获取验证码" class="am-btn am-btn-default" onclick="settime(this),Sms()" />
                    </span>
                </div>
            </div>

            <div class="am-form-group">
                <label for="app_sms">验证码：</label>
                <input type="text" id="app_sms" name="app_sms" minlength="3" placeholder="输入您的手机验证码" required/>
            </div>

            <div class="am-g am-g-fixed">
                <div class="am-u-sm-6" style="margin: 0; padding: 0;">
                    <button type="submit" class="am-btn am-btn-warning am-btn-block">提交申请</button>
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
        @if(Session::get('message')=='yzm')
            <script>layer.msg('验证码错误！', {icon: 5}); </script>
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
            var app_mobile = $("#app_mobile").val();
            $.post("{{url('/mobile/member/send')}}",{'_token':'{{csrf_token()}}','mobile':app_mobile});
        }
    </script>

@endsection