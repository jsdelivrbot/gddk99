@extends('layouts.admin')
@section('content')

    <div class="tpl-content-wrapper">
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 客户更新表单
                </div>
            </div>
            <div class="tpl-block ">

                <div class="am-g tpl-amazeui-form">

                    <div class="am-u-sm-12 am-u-md-9">
                        {!! Form::open(['url'=>'admin/client/client-list-edit','files'=>'true','class'=>'am-form am-form-horizontal','data-am-validator']) !!}
                        <fieldset>

                            <div class="am-form-group">
                                <label for="info_name" class="am-u-sm-3 am-form-label">客户姓名</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="info_name" name="info_name" value="{{ $info['info_name'] }}" placeholder="输入客户姓名" required>
                                    <input type="hidden" name="member_id" value="{{ $info['member_id'] }}">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="info_sex" class="am-u-sm-3 am-form-label">性别</label>
                                <div class="am-u-sm-9">
                                    <select id="info_sex" name="info_sex" required>
                                        @foreach($sex as $list)
                                        <option value="{{ $list['sex_number'] }}" @if($list['sex_number']==$info['info_sex']) selected @endif>
                                            {{ $list['sex_name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="am-form-group">
                                <label for="info_mobile" class="am-u-sm-3 am-form-label">手机号</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="info_mobile" name="info_mobile" value="{{ $info['info_mobile'] }}" placeholder="输入手机号" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="info_quota" class="am-u-sm-3 am-form-label">贷款额度</label>
                                <div class="am-u-sm-9">
                                    <div class="am-input-group">
                                    <input type="text" id="info_quota" name="info_quota" value="{{ $info['info_quota'] }}" placeholder="输入贷款额度" required class="am-form-field">
                                    <span class="am-input-group-label">万元</span>
                                </div>
                                </div>
                            </div>


                            <div class="am-form-group">
                                <label for="member_surname" class="am-u-sm-3 am-form-label">推客姓名</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="member_surname" name="member_surname" value="{{ $member['member_surname'] }}" disabled>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="in_id" class="am-u-sm-3 am-form-label">扫码渠道</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="in_id" name="in_id" value="@if(substr($info['member_id'],0,2)==10) 来自扫码推客 @else 来自立即申请 @endif" disabled>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="plan_type_a" class="am-u-sm-3 am-form-label">客户状态</label>
                                <div class="am-u-sm-9">
                                    <select id="plan_type_a" name="plan_type_a" required>
                                        @foreach($status as $line)
                                        <option value="{{ $line['number'] }}" @if($line['number']==$info['member_id']) selected @endif>
                                            {{ $line['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="submit" class="am-btn am-btn-primary">保存</button> <button type="button" class="am-btn am-btn-success" onclick="javascript:window.location='{{ url('admin/client-list') }}'">返回列表</button>
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
