@extends('layouts.mobile')
@section('content')

    <div class="pet_mian"  style="background-color: white;">

        <div class="pet_content_block pet_hd_con">
            <div class="pet_hd_con_head"><img src="{{ url('build/img/client-list.jpg') }}" alt=""></div>
        </div>

        {!! Form::open(['url'=>'/mobile/member/member-user-invite','class'=>'am-form','data-am-validator']) !!}
        <fieldset>
            <legend>推荐客户-申请贷款</legend>
            <div class="am-form-group">
                <label for="info_name">客户姓名：</label>
                <input type="text" id="info_name" name="info_name" minlength="2" placeholder="输入您的姓名" required/>
                <input type="hidden" id="info_invite" value="{{ $parent }}" name="info_invite"/>
                <input type="hidden" id="member_id" value="{{ $current }}" name="member_id"/>
            </div>

            <div class="am-form-group">
                <label for="info_sex">性别</label>
                <select id="info_sex" name="info_sex" required>
                    <option value="">选择性别</option>
                    <option value="1">男</option>
                    <option value="2">女</option>
                    <option value="0">保密</option>
                </select>
                <span class="am-form-caret"></span>
            </div>

            <div class="am-form-group">
                <label for="info_quota">贷款额度(万元)：</label>
                <input type="text" id="info_quota" name="info_quota" minlength="1" placeholder="输入贷款额度" required/>
            </div>

            <div class="am-form-group">
                <label for="info_mobile">手机号：</label>
                <div class="am-input-group">
                    <input type="text" id="info_mobile" name="info_mobile" minlength="3" placeholder="输入您的手机号" required class="am-form-field">
                    <span class="am-input-group-btn">
                        <input type="button" id="btn" value="获取验证码" class="am-btn am-btn-default" onclick="settime(this),Sms()" />
                    </span>
                </div>
            </div>

            <div class="am-form-group">
                <label for="info_sms">验证码：</label>
                <input type="text" id="info_sms" name="info_sms" minlength="3" placeholder="输入您的手机验证码" required/>
            </div>

            <div class="am-g am-g-fixed">
                <div class="am-u-sm-6" style="margin: 0; padding: 0;">
                    <button type="submit" class="am-btn am-btn-warning am-btn-block">提交申请</button>
                </div>
                <div class="am-u-sm-6" style="margin: 0; padding: 0;">
                    <button type="button" class="am-btn am-btn-default am-btn-block" onclick="javascript:window.location='{{ url('mobile/client/client-vip-show',['member_id'=>$current]) }}'" >返回列表</button>
                </div>
            </div>

        </fieldset>
        {!! Form::close() !!}

    </div>

@endsection


@section('script')
    @if(Session::has('message'))
        @if(Session::get('message')=='push')
            <script>
                layer.open({
                    type: 1,
                    title: false,
                    skin:'layui-layer-demo',
                    area: ['78%', '18%'],
                    content: '<div class="am-panel am-panel-primary"><div class="am-panel-hd">恭喜，提交成功！</div><div class="am-panel-bd">查看提交状态，返回客户列表</div></div>'
                });
            </script>
        @elseif(Session::get('message')==0)
            <script>layer.msg('提交失败，或者填写资料有误！', {icon: 5}); </script>
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
            var info_mobile = $("#info_mobile").val();
            $.post("{{url('/mobile/member/send')}}",{'_token':'{{csrf_token()}}','mobile':info_mobile});
        }
    </script>
@endsection