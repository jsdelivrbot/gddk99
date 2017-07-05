@extends('layouts.mobile')
@section('content')
    <div class="pet_grzx">
        <div class="pet_grzx_nr">
            <div class="pet_grzx_ico">
                <img src="{{ url('build/uploads/'.$shop['con_pic']) }}" alt="" style="width: 200px; height:200px;">
            </div>
            <div class="pet_grzx_name"></div>
            <div class="pet_grzx_num_font"></div>
            <table class="am-table am-table-bordered">
                <tbody>
                <tr align="center">
                    <td colspan="2">{{ $shop['con_name'] }}</td>
                </tr>
                <tr align="center">
                    <td>咨询电话</td>
                    <td>{{ $shop['con_tel'] }}</td>
                </tr>
                <tr align="center">
                    <td>店面地址</td>
                    <td>{{ $shop['con_add'] }}</td>
                </tr>
                </tbody>
            </table>
            <div class="pet_grzx_map">
                <div class="am-g am-g-fixed">
                    <div class="am-u-sm-6" style="margin: 0; padding: 0;">
                        <button type="button" class="am-btn am-btn-primary am-btn-block" onclick="javascript:window.location='{{ url('mobile/client/client-list') }}'" >贷款申请</button>
                    </div>
                    <div class="am-u-sm-6" style="margin: 0; padding: 0;">
                        <a href="tel:{{ $shop['con_tel'] }}" class="am-btn am-btn-success am-btn-block">电话咨询</a>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <div class="pet_grzx_nr" style="padding-top: 0px;">
            <div class="pet_grzx_name" style="text-align: left">店铺介绍</div>
            <hr style="margin: 0;padding: 10px;">
            <div class="am-panel am-panel-secondary">
                <div class="am-panel-hd">店铺图片</div>
                <div class="am-panel-bd">
                    @foreach(unserialize($shop['con_pic_all']) as $list)
                        <img src="{{ url('build/uploads/'.$list) }}" alt="" style="width: 100%; margin-top: 6px;">
                    @endforeach
                </div>
            </div>
            <div class="am-panel am-panel-secondary">
                <div class="am-panel-hd">业务区域</div>
                <div class="am-panel-bd">
                    {{ $shop['con_content_area'] }}
                </div>
            </div>
            <div class="am-panel am-panel-secondary">
                <div class="am-panel-hd">业务范围</div>
                <div class="am-panel-bd">
                    {{ $shop['con_content_range'] }}
                </div>
            </div>
            <div class="am-panel am-panel-secondary">
                <div class="am-panel-hd">店铺介绍</div>
                <div class="am-panel-bd">
                    {{ $shop['con_content'] }}
                </div>
            </div>
        </div>
    </div>

@endsection