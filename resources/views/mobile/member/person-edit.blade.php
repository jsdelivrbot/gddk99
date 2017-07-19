@extends('layouts.mobile')
@section('content')

<div class="pet_mian"  style="background-color: white;">

    {!! Form::open(['url'=>'/mobile/member/person-edit','files'=>'true','class'=>'am-form','data-am-validator']) !!}
        <fieldset>
            <legend>个人信息</legend>

            <table class="am-table am-table-bordered">
                <tr>
                    <td align="center">
                        <div class="am-form-group am-form-file" style="width: 80px; height: 80px; margin: 0px; padding: 0px;">
                            <img class="am-img-thumbnail am-circle" alt="80*80" src="{{ $data['avatar'] }}" style="width: 80px; height: 80px;" />
                            {!! Form::file('member_avatar',['multiple'=>'multiple']) !!}
                        </div>
                    </td>
                </tr>
            </table>

            @if(!empty($member['member_name']))
            <div class="am-form-group">
                <label for="member_name">会员名称：</label>
                <input type="text" id="member_name" name="member_name" value="{{ $member['member_name'] }}" minlength="2" placeholder="输入会员名称"/>
            </div>

            <div class="am-form-group">
                <label for="password">会员密码：</label>
                <input type="text" id="password" name="password" minlength="2" value="{{ $member['password'] }}" placeholder="输入会员密码" />
            </div>
            @endif

            <div class="am-form-group">
                <label for="wechat_nickname">昵称：</label>
                <input type="text" id="wechat_nickname" name="wechat_nickname" minlength="2" value="{{ $member['wechat_nickname'] }}" placeholder="输入您的昵称" disabled/>
                <input type="hidden" id="member_id" name="member_id" value="{{ $member['member_id'] }}" />
            </div>

            <div class="am-form-group">
                <label for="member_surname">姓名：</label>
                <input type="text" id="member_surname" name="member_surname" minlength="2" value="{{ $member['member_surname'] }}" placeholder="输入您的姓名" required/>
            </div>

            <div class="am-form-group">
                <label for="member_sex">性别</label>
                <select id="member_sex" name="member_sex" required>
                    @foreach($data['sex'] as $sex)
                        <option value="{{ $sex['sex_number'] }}" @if($sex['sex_number'] == $member['member_sex']) selected @endif>
                            {{ $sex['sex_name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="am-form-group">
                <label for="member_age">年龄：</label>
                <input type="text" id="member_age" name="member_age" minlength="2" value="{{ $member['member_age'] }}" placeholder="输入年龄" required/>
            </div>

            <div class="am-form-group">
                <label for="member_mobile">手机号：</label>
                <input type="text" id="member_mobile" name="member_mobile" minlength="3" value="{{ $member['member_mobile'] }}" placeholder="输入联系手机号" required/>
            </div>

            {{--<div class="am-form-group">
                <label for="member_tel">电话：</label>
                <input type="text" id="member_tel" name="member_tel" minlength="3" value="{{ $member['member_tel'] }}" placeholder="输入联系电话" required/>
            </div>--}}

            <div class="am-form-group">
                <label for="member_card_type">卡号类型</label>
                <select id="member_card_type" name="member_card_type" required>
                    <option value="">请选择卡号类型</option>
                    @foreach($data['card'] as $card)
                        <option value="{{ $card['id'] }}" @if($card['id'] == $member['member_card_type']) selected @endif>
                            {{ $card['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="am-form-group">
                <label for="member_bank_card">银行卡号：</label>
                <input type="text" id="member_bank_card" name="member_bank_card" minlength="3" value="{{ $member['member_bank_card'] }}" placeholder="输入银行卡号" required/>
            </div>

            <div class="am-form-group">
                <label for="member_card">身份证：</label>
                <input type="text" id="member_card" name="member_card" minlength="3" value="{{ $member['member_card'] }}" placeholder="输入身份证号码" required/>
            </div>

            {{--<div class="am-form-group">
                <label for="member_content">个人介绍：</label>
                <textarea id="member_content" name="member_content" minlength="10" maxlength="100">{{ $member['member_content'] }}</textarea>
            </div>--}}

            <div class="am-form-group">
                <label for="member_add">地址：</label>
                <input type="text" id="member_add" name="member_add" minlength="3" value="{{ $member['member_add'] }}" placeholder="输入地址" required/>
            </div>

            <div class="am-g am-g-fixed">
                <div class="am-u-sm-6" style="margin: 0; padding: 0;">
                    <button class="am-btn am-btn-warning am-btn-block" type="submit" >提交</button>
                </div>
                <div class="am-u-sm-6" style="margin: 0; padding: 0;">
                    <button type="button" class="am-btn am-btn-default am-btn-block" onclick="javascript:window.location='{{ url('mobile/member/person-list') }}'" >返回</button>
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
                    content: '<div class="am-panel am-panel-primary"><div class="am-panel-hd">您好，你的资料未完善！</div><div class="am-panel-bd">请完善个人信息。</div></div>'
                });
            </script>
        @endif
    @endif

@endsection