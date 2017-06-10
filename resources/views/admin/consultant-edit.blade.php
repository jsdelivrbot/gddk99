@extends('layouts.admin')
@section('content')

<div class="tpl-content-wrapper">
    <div class="tpl-portlet-components">
        <div class="portlet-title">
            <div class="caption font-green bold">
                <span class="am-icon-code"></span> 顾客编辑表单
            </div>
        </div>
        <div class="tpl-block ">

            <div class="am-g tpl-amazeui-form">


                <div class="am-u-sm-12 am-u-md-9">
                    {!! Form::open(['url'=>'admin/consultant-edit','files'=>'true','class'=>'am-form am-form-horizontal','data-am-validator']) !!}
                        <fieldset>
                            <input type="hidden" name="con_id" value="{{ $consultant['id'] }}">
                        <div class="am-form-group" style="margin-bottom: 0;">
                            <label for="con_pic" class="am-u-sm-3 am-form-label">上传头像</label>
                            <div class="am-u-sm-9">
                                <table class="am-table am-table-bordered">
                                    <tr>
                                        <td>
                                            <div class="am-form-group am-form-file" style="margin-bottom: 0;">
                                                <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                                    <i class="am-icon-cloud-upload"></i> 选择上传头像</button>
                                                <input type="file" id="con_pic" name="con_pic" multiple>
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
                                            @if(!empty($consultant['con_pic']))
                                            <img src="{{ url('build/uploads/'.$consultant['con_pic']) }}" alt="" width="160" height="140">
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="con_name" class="am-u-sm-3 am-form-label">顾问姓名</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="con_name" name="con_name" value="{{ $consultant['con_name'] }}" placeholder="输入顾问姓名" required>
                            </div>
                        </div>

                        <div class="am-form-group" style="margin-bottom: 0;">
                            <label for="con_wx_pic" class="am-u-sm-3 am-form-label">微信号二维码</label>
                            <div class="am-u-sm-9">
                                <table class="am-table am-table-bordered">
                                    <tr>
                                        <td>
                                            <div class="am-form-group am-form-file" style="margin-bottom: 0;">
                                                <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                                    <i class="am-icon-cloud-upload"></i> 选择上传二维码</button>
                                                <input type="file" id="con_wx_pic" name="con_wx_pic" multiple>
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
                                            @if(!empty($consultant['con_wx_pic']))
                                            <img src="{{ url('build/uploads/'.$consultant['con_wx_pic']) }}" alt="" width="160" height="140">
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="con_tel" class="am-u-sm-3 am-form-label">顾客电话</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="con_tel" name="con_tel" value="{{ $consultant['con_tel'] }}" placeholder="输入顾客电话" required>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="con_person" class="am-u-sm-3 am-form-label">顾客咨询人数</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="con_person" name="con_person" value="{{ $consultant['con_person'] }}" placeholder="输入顾客咨询人数" required>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="con_time" class="am-u-sm-3 am-form-label">顾问从业时间</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="con_time" name="con_time" value="{{ $consultant['con_time'] }}" placeholder="输入顾问从业时间" required>
                            </div>
                        </div>

                        <div class="am-form-group" style="margin-bottom: 0;">
                            <label for="con_pic_all" class="am-u-sm-3 am-form-label">店铺多张图片</label>
                            <div class="am-u-sm-9">
                                <table class="am-table am-table-bordered">
                                    <tr>
                                        <td>
                                            <div class="am-form-group am-form-file" style="margin-bottom: 0;">
                                                <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                                    <i class="am-icon-cloud-upload"></i> 选择上传多张图片</button>
                                                <input type="file" id="con_pic_all" name="con_pic_all[]" multiple>
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
                                            @if(!empty($consultant['con_pic_all']))
                                            @foreach(unserialize($consultant['con_pic_all']) as $list)
                                                <img src="{{ url('build/uploads/'.$list) }}" alt="" style="width: 147px; height:130px; margin-top: 6px;">
                                            @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="con_content" class="am-u-sm-3 am-form-label">个人介绍</label>
                            <div class="am-u-sm-9">
                                <textarea class="" rows="5" id="con_content" name="con_content" placeholder="输入个人介绍" required>{{ $consultant['con_content'] }}</textarea>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="con_content_area" class="am-u-sm-3 am-form-label">业务区域</label>
                            <div class="am-u-sm-9">
                                <textarea class="" rows="5" id="con_content_area" name="con_content_area" placeholder="输入业务区域" required>{{ $consultant['con_content_area'] }}</textarea>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="con_content_range" class="am-u-sm-3 am-form-label">业务范围</label>
                            <div class="am-u-sm-9">
                                <textarea class="" rows="5" id="con_content_range" name="con_content_range" placeholder="输入业务范围" required>{{ $consultant['con_content_range'] }}</textarea>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="con_add" class="am-u-sm-3 am-form-label">地址</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="con_add" name="con_add" value="{{ $consultant['con_add'] }}" placeholder="输入地址" required>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="submit" class="am-btn am-btn-primary">保存</button> <button type="button" class="am-btn am-btn-success" onclick="javascript:window.location='{{ url('admin/consultant-list') }}'">返回列表</button>
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
