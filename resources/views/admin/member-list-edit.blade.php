@extends('layouts.admin')
@section('content')

    <div class="tpl-content-wrapper">
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 会员更新表单
                </div>
            </div>
            <div class="tpl-block ">

                <div class="am-g tpl-amazeui-form">

                    <div class="am-u-sm-12 am-u-md-9">
                        {!! Form::open(['url'=>'admin/member-list-edit','files'=>'true','class'=>'am-form am-form-horizontal','data-am-validator']) !!}
                        <fieldset>

                            <div class="am-form-group" style="margin-bottom: 0;">
                                <label for="member_avatar" class="am-u-sm-3 am-form-label">上传头像</label>
                                <div class="am-u-sm-9">
                                    <table class="am-table am-table-bordered">
                                        <tr>
                                            <td>
                                                <div class="am-form-group am-form-file" style="margin-bottom: 0;">
                                                    <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                                        <i class="am-icon-cloud-upload"></i> 选择上传头像</button>
                                                    <input type="file" id="member_avatar" name="member_avatar" multiple>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label"></label>
                                <div class="am-u-sm-9">
                                    <table class="am-table am-table-bordered">
                                        <tr>
                                            <td>
                                                @if(empty($member['member_avatar']))
                                                    <img src="{{ $member['wechat_headimgurl'] }}" alt="" width="160" height="140">
                                                @else
                                                    <img src="{{ url('build/uploads/'.$member['member_avatar']) }}" alt="" width="160" height="140">
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="wechat_nickname" class="am-u-sm-3 am-form-label">昵称</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="wechat_nickname" name="wechat_nickname" value="{{ $member['wechat_nickname'] }}" disabled>
                                    <input type="hidden" name="member_id" value="{{ $member['member_id'] }}">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="member_surname" class="am-u-sm-3 am-form-label">真实姓名</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="member_surname" name="member_surname" value="{{ $member['member_surname'] }}" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="member_sex" class="am-u-sm-3 am-form-label">性别</label>
                                <div class="am-u-sm-9">
                                    <select id="member_sex" name="member_sex" required>
                                            @foreach($sex as $list)
                                            <option value="{{ $list['sex_number'] }}" @if($list['sex_number']==$member['member_sex']) selected @endif>
                                                {{ $list['sex_name'] }}
                                            </option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="am-form-group">
                                <label for="member_mobile" class="am-u-sm-3 am-form-label">手机号</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="member_mobile" name="member_mobile" value="{{ $member['member_mobile'] }}" placeholder="输入手机号" required>
                                </div>
                            </div>



                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="submit" class="am-btn am-btn-primary">保存</button> <button type="button" class="am-btn am-btn-success" onclick="javascript:window.location='{{ url('admin/member-list') }}'">返回列表</button>
                                </div>
                            </div>

                        </fieldset>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
