@extends('layouts.mobile')
@section('content')

    <div class="pet_grzx">
        <div class="pet_grzx_nr">
            <div class="pet_grzx_ico">
                <img src="https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=3803512966,1757656304&fm=58" alt="">
            </div>
            <div class="pet_grzx_name"></div>
            <div class="pet_grzx_num_font"></div>
            <table class="am-table am-table-bordered">
                <tbody>
                <tr align="center">
                    <td colspan="2">虎门-广东贷款网</td>
                </tr>
                <tr align="center">
                    <td>咨询电话</td>
                    <td>0769-880638806</td>
                </tr>
                <tr align="center">
                    <td>店面地址</td>
                    <td>虎门销烟路口188号</td>
                </tr>
                </tbody>
            </table>
            <div class="pet_grzx_map">
                <div class="am-g am-g-fixed">
                    <div class="am-u-sm-6" style="margin: 0; padding: 0;">
                        <button type="button" class="am-btn am-btn-primary am-btn-block" onclick="javascript:window.location='{{ url('mobile/client-list') }}'" >贷款申请</button>
                    </div>
                    <div class="am-u-sm-6" style="margin: 0; padding: 0;">
                        <button type="button" class="am-btn am-btn-success am-btn-block">电话咨询</button>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <div class="pet_grzx_nr" style="padding-top: 0px;">
            <div class="pet_grzx_name" style="text-align: left">店铺介绍</div>
            <hr style="margin: 0;padding: 10px;">
            <div class="am-panel am-panel-secondary">
                <div class="am-panel-hd">业务区域</div>
                <div class="am-panel-bd">
                    东莞，惠州，深圳，广州
                </div>
            </div>
            <div class="am-panel am-panel-secondary">
                <div class="am-panel-hd">业务范围</div>
                <div class="am-panel-bd">
                    房产贷款
                </div>
            </div>
            <div class="am-panel am-panel-secondary">
                <div class="am-panel-hd">店铺介绍</div>
                <div class="am-panel-bd">
                    专业办理全国各类信用贷款，房产抵押贷款，汽车抵押贷款。过桥，垫资，解决您的一切资金问题。欢迎来电咨询。
                </div>
            </div>
        </div>
    </div>

@endsection