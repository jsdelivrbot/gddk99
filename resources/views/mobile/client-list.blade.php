@extends('layouts.mobile')
@section('content')

<div class="pet_mian"  style="background-color: white;">

    <div class="pet_content_block pet_hd_con">
        <div class="pet_hd_con_head"><img src="{{ url('build/img/client-list.jpg') }}" alt=""></div>
    </div>

    {!! Form::open(['url'=>'/mobile/client-list','class'=>'am-form','data-am-validator']) !!}
        <fieldset>
            <legend>推荐贷款</legend>
            <div class="am-form-group">
                <label for="info_name">客户姓名：</label>
                <input type="text" id="info_name" name="info_name" minlength="3" placeholder="输入您的姓名" required/>
            </div>

            <div class="am-form-group">
                <label for="info_sex">姓名</label>
                <select id="info_sex" name="info_sex" required>
                    <option value="">选择性别</option>
                    <option value="1">男</option>
                    <option value="2">女</option>
                    <option value="0">保密</option>
                </select>
                <span class="am-form-caret"></span>
            </div>

            <div class="am-form-group">
                <label for="info_quota">贷款额度(元)：</label>
                <input type="text" id="info_quota" name="info_quota" minlength="3" placeholder="输入贷款额度" required/>
            </div>

            <div class="am-form-group">
                <label for="info_mobile">手机号：</label>
                <input type="text" id="info_mobile" name="info_mobile" minlength="3" placeholder="输入联系手机号" required/>
            </div>

            <button class="am-btn am-btn-primary am-btn-block" type="submit" >提交申请</button>

        </fieldset>
    {!! Form::close() !!}
        <div id="tong">
            <div class="am-panel am-panel-primary">
                <div class="am-panel-hd">恭喜，申请成功！</div>
                <div class="am-panel-bd">
                    您好！请保持电话畅通，稍后客服人员与你联络。
                </div>
            </div>
        </div>
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
                    content: $('#tong')
                });
            </script>
        @elseif(Session::get('message')==0)
            <script>layer.msg('申请失败！', {icon: 5}); </script>
        @endif
    @endif
@endsection