@extends('layouts.mobile')
@section('content')

    <div class="pet_grzx">
        <div class="pet_grzx_nr">
            <div class="pet_grzx_ico">
                <img src="{{ url('build/uploads/'.$consultant['con_pic']) }}" alt="">
            </div>
            <div class="pet_grzx_name">{{ $consultant['con_name'] }}</div>
            <div class="pet_grzx_num_font">
                <button type="button" class="am-btn am-btn-default am-radius"data-am-modal="{target: '#my-alert'}">点击获取二维码加微信</button>

                <div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
                    <div class="am-modal-dialog">
                        <div class="am-modal-bd">
                            <img src="{{ url('build/uploads/'.$consultant['con_wx_pic']) }}" alt="" style="width: 160px; height: 160px;">
                        </div>
                        <div class="am-modal-footer">
                            <span class="am-modal-btn">确定</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pet_grzx_num_font"></div>
            <table class="am-table am-table-bordered">
                <tbody>
                <tr align="center">
                    <td>成功办理</td>
                    <td>{{ $consultant['con_person'] }}</td>
                </tr>
                <tr align="center">
                    <td>从业时间</td>
                    <td>{{ $consultant['con_time'] }}</td>
                </tr>
                </tbody>
            </table>
            <div class="pet_grzx_map">
                <div class="am-g am-g-fixed">
                    <div class="am-u-sm-6" style="margin: 0; padding: 0;">
                        <button type="button" class="am-btn am-btn-primary am-btn-block" onclick="javascript:window.location='{{ url('mobile/client-list') }}'" >贷款申请</button>
                    </div>
                    <div class="am-u-sm-6" style="margin: 0; padding: 0;">
                        <a href="tel:{{ $consultant['con_tel'] }}" class="am-btn am-btn-success am-btn-block">电话咨询</a>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <div class="pet_grzx_nr" style="padding-top: 0px;">
            <div class="pet_grzx_name" style="text-align: left">顾问介绍</div>
            <hr style="margin: 0;padding: 10px;">
            <div class="am-panel am-panel-secondary">
                <div class="am-panel-hd">业务区域</div>
                <div class="am-panel-bd">
                    {{ $consultant['con_content_area'] }}
                </div>
            </div>
            <div class="am-panel am-panel-secondary">
                <div class="am-panel-hd">业务范围</div>
                <div class="am-panel-bd">
                    {{ $consultant['con_content_range'] }}
                </div>
            </div>
            <div class="am-panel am-panel-secondary">
                <div class="am-panel-hd">个人介绍</div>
                <div class="am-panel-bd">
                    {{ $consultant['con_content'] }}
                </div>
            </div>
        </div>
    </div>

@endsection