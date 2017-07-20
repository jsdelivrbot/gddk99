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

                            <div class="am-form-group">
                                <label for="info_name" class="am-u-sm-3 am-form-label">客户姓名</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="info_name" name="info_name" value="00" placeholder="输入客户姓名" required>
                                    <input type="hidden" name="info_id" value="00">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="info_sex" class="am-u-sm-3 am-form-label">性别</label>
                                <div class="am-u-sm-9">
                                    <select id="info_sex" name="info_sex" required>

                                            <option value="00">

                                            </option>

                                    </select>
                                </div>
                            </div>


                            <div class="am-form-group">
                                <label for="info_mobile" class="am-u-sm-3 am-form-label">手机号</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="info_mobile" name="info_mobile" value="00" placeholder="输入手机号" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="info_quota" class="am-u-sm-3 am-form-label">贷款额度</label>
                                <div class="am-u-sm-9">
                                    <div class="am-input-group">
                                        <input type="text" id="info_quota" name="info_quota" value="00" placeholder="输入贷款额度" required class="am-form-field">
                                        <span class="am-input-group-label">万元</span>
                                    </div>
                                </div>
                            </div>


                            <div class="am-form-group">
                                <label for="member_surname" class="am-u-sm-3 am-form-label">推客姓名</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="member_surname" name="member_surname" value="00" disabled>
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
