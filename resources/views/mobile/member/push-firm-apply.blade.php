@extends('layouts.mobile')
@section('content')
    <div class="pet_mian"  style="background-color: white;">

        <div class="pet_content_block pet_hd_con">
            <div class="pet_hd_con_head"><img src="{{ url('build/img/client-list.jpg') }}" alt=""></div>
        </div>

        {!! Form::open(['url'=>'/mobile/client/client-list','files'=>'true','class'=>'am-form','data-am-validator']) !!}
        <fieldset>
            <legend>企业申请成为推客</legend>
            <div class="am-form-group">
                <label for="app_name">公司名称：</label>
                <input type="text" id="app_name" name="app_name" minlength="2" placeholder="输入您的公司名称" required/>
                <input type="hidden" id="member_id" name="member_id" value="{{ $id }}" />
            </div>

            <div class="am-form-group">
                <label for="app_nature">企业性质</label>
                <select id="app_nature" name="app_nature" required>
                    <option value="">选择企业性质</option>
                    <option value="1">金融</option>
                    <option value="2">其它</option>
                </select>
            </div>

            <div class="am-form-group">
                <label for="app_username">法定代表人：</label>
                <input type="text" id="app_username" name="app_username" minlength="1" placeholder="输入法定代表人" required/>
            </div>

            <div class="am-form-group">
                <label for="app_number">机构代码号：</label>
                <input type="text" id="app_number" name="app_number" minlength="1" placeholder="输入机构代码号" required/>
            </div>

            <div class="am-form-group">
                <label for="app_pic_z">营业执照：</label>
                <table class="am-table am-table-bordered">
                    <tr>
                        <td>
                            <div class="am-form-group am-form-file" style="margin-bottom: 0;">
                                <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                    <i class="am-icon-cloud-upload"></i> 选择上传营业执照</button>
                                <input type="file" id="app_pic_z" name="app_pic_z" multiple required>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="am-form-group">
                <label for="member_bank_card">银行卡号：</label>
                <input type="text" id="member_bank_card" name="member_bank_card" value="{{ $member['member_bank_card'] }}" minlength="1" placeholder="输入您的银行卡号" required/>
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
                <label for="app_mobile">手机号：</label>
                <div class="am-input-group">
                    <input type="text" id="app_mobile" name="app_mobile" value="{{ $member['member_mobile'] }}" minlength="3" placeholder="输入您的手机号" required class="am-form-field">
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