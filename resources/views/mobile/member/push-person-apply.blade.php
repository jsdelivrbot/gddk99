@extends('layouts.mobile')
@section('content')
    <div class="pet_mian"  style="background-color: white;">

        <div class="pet_content_block pet_hd_con">
            <div class="pet_hd_con_head"><img src="{{ url('build/img/client-list.jpg') }}" alt=""></div>
        </div>

        {!! Form::open(['url'=>'/mobile/client/client-list','class'=>'am-form','data-am-validator']) !!}
        <fieldset>
            <legend>个人申请成为推客</legend>
            <div class="am-form-group">
                <label for="info_name">姓名：</label>
                <input type="text" id="info_name" name="info_name" minlength="2" placeholder="输入您的姓名" required/>
            </div>

            <div class="am-form-group">
                <label for="info_sex">性别</label>
                <select id="info_sex" name="info_sex" required>
                    <option value="">选择性别</option>
                    <option value="1">男</option>
                    <option value="2">女</option>
                    <option value="0">保密</option>
                </select>
            </div>

            <div class="am-form-group">
                <label for="info_quota">年龄：</label>
                <input type="text" id="info_quota" name="info_quota" minlength="1" placeholder="输入贷款额度" required/>
            </div>

            <div class="am-form-group">
                <label for="info_quota">身份证号：</label>
                <input type="text" id="info_quota" name="info_quota" minlength="1" placeholder="输入贷款额度" required/>
            </div>

            <div class="am-form-group">
                <label for="info_sms">身份证正面：</label>
                <table class="am-table am-table-bordered">
                    <tr>
                        <td>
                            <div class="am-form-group am-form-file" style="margin-bottom: 0;">
                                <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                    <i class="am-icon-cloud-upload"></i> 选择上传身份证正面</button>
                                <input type="file" id="con_pic" name="con_pic" multiple>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="am-form-group">
                <label for="info_sms">身份证背面：</label>
                <table class="am-table am-table-bordered">
                    <tr>
                        <td>
                            <div class="am-form-group am-form-file" style="margin-bottom: 0;">
                                <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                    <i class="am-icon-cloud-upload"></i> 选择上传身份证背面</button>
                                <input type="file" id="con_pic" name="con_pic" multiple>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="am-form-group">
                <label for="info_quota">银行卡号：</label>
                <input type="text" id="info_quota" name="info_quota" minlength="1" placeholder="输入贷款额度" required/>
            </div>

            <div class="am-form-group">
                <label for="info_sex">卡号类型</label>
                <select id="info_sex" name="info_sex" required>
                    <option value="">选择卡号类型</option>
                    <option value="1">中国工商银行</option>
                    <option value="2">支付宝</option>
                    <option value="0">微信</option>
                </select>
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