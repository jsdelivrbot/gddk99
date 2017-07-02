@extends('layouts.mobile')
@section('content')

    <div class="pet_mian"  style="background-color: white;">

        <div class="pet_content_block pet_hd_con">
            <div class="pet_hd_con_head"><img src="{{ url('build/img/client-list.jpg') }}" alt=""></div>
        </div>

        {!! Form::open(['url'=>'/mobile/client/client-poster-invite-apply','class'=>'am-form','data-am-validator']) !!}
        <fieldset>
            <legend>推荐客户-申请贷款</legend>
            <div class="am-form-group">
                <label for="info_name">客户姓名：</label>
                <input type="text" id="info_name" name="info_name" minlength="2" placeholder="输入您的姓名" required/>
                <input type="hidden" id="info_invite" value="{{ $member['member_id'] }}" name="info_invite"/>
                <input type="hidden" id="member_id" value="{{ $member_user['member_id'] }}" name="member_id"/>
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
                <input type="text" id="info_quota" name="info_quota" minlength="3" placeholder="输入贷款额度" required/>
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
                    <button type="button" class="am-btn am-btn-default am-btn-block" onclick="javascript:window.location='{{ url('mobile/index') }}'" >返回首页</button>
                </div>
            </div>

        </fieldset>
        {!! Form::close() !!}

    </div>

@endsection
@section('script')
    @if(Session::has('message'))
        @if(Session::get('message')==1)
            <script>
                layer.open({
                    type: 1,
                    title: false,
                    skin:'layui-layer-demo',
                    area: ['78%', '18%'],
                    content: '<div class="am-panel am-panel-primary"><div class="am-panel-hd">恭喜，绑定成功！</div><div class="am-panel-bd">您好，我们已经是合伙人了，立即推荐客户享受更多优惠！</div></div>'
                });
            </script>
        @elseif(Session::get('message')==0)
            <script>layer.msg('绑定失败！', {icon: 5}); </script>
        @elseif(Session::get('message')==2)
            <script>layer.msg('验证码错误！', {icon: 5}); </script>
        @elseif(Session::get('message')==3)
            <script>
                layer.open({
                    type: 1,
                    title: false,
                    skin:'layui-layer-demo',
                    area: ['78%', '18%'],
                    content: '<div class="am-panel am-panel-primary"><div class="am-panel-hd">您好，您已经是合伙人身份！</div><div class="am-panel-bd">立即推荐客户享受更多优惠！</div></div>'
                });
            </script>
        @elseif(Session::get('message')==4)
            <script>
                layer.open({
                    type: 1,
                    title: false,
                    skin:'layui-layer-demo',
                    area: ['78%', '18%'],
                    content: '<div class="am-panel am-panel-primary"><div class="am-panel-hd">恭喜，申请成功！</div><div class="am-panel-bd">您好！请保持电话畅通，稍后客服人员与你联络。</div></div>'
                });
            </script>
        @elseif(Session::get('message')==5)
            <script>layer.msg('申请失败！', {icon: 5}); </script>
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