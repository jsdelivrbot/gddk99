@extends('layouts.mobile')
@section('content')

    <div class="pet_content_block pet_hd_con">
        <article data-am-widget="paragraph" class="am-paragraph am-paragraph-default pet_content_article" data-am-paragraph="{ tableScrollable: true, pureview: true }">
            <div class="pet_hd_con_gp_list_nr">
                <div class="pet_hd_con_gp_list_nr_title">{{ $plan['plan_title'] }}</div>
                <table class="am-table am-table-bordered">
                    <tbody>
                    <tr align="center">
                        <td width="30%">贷款金额</td>
                        <td>{{ $plan['plan_title_a'] }}</td>
                    </tr>
                    <tr align="center">
                        <td>月利率</td>
                        <td>{{ $plan['plan_title_b'] }}</td>
                    </tr>
                    <tr align="center">
                        <td>还款方式</td>
                        <td>{{ $plan['plan_title_c'] }}</td>
                    </tr>
                    <tr align="center">
                        <td>贷款期限</td>
                        <td>{{ $plan['plan_title_d'] }}</td>
                    </tr>
                    </tbody>
                </table>
                <hr>
                <div class="pet_hd_con_gp_list_nr_tag">介绍资料</div>
                <p><pre>{{ $plan['plan_con_c'] }}</pre></p>
                <div class="pet_hd_con_gp_list_nr_tag">申请条件</div>
                <p><pre>{{ $plan['plan_con_a'] }}</pre></p>
                <div class="pet_hd_con_gp_list_nr_tag">所需资料</div>
                <p><pre>{{ $plan['plan_con_b'] }}</pre></p>
            </div>
        </article>
        <div style="height: 50px;"></div>
    </div>

    <div data-am-widget="gotop" class="am-gotop am-gotop-fixed">
        <div class="am-g am-g-fixed">
            <div class="am-u-sm-4" style="margin: 0; padding: 0;">
                <button type="button" class="am-btn am-btn-warning am-btn-block" onclick="javascript:window.location='{{ url('mobile/client/client-list') }}'" >立即申请</button>
            </div>
            <div class="am-u-sm-4" style="margin: 0; padding: 0;">
                <button type="button" class="am-btn am-btn-primary am-btn-block" onclick="javascript:window.location='{{ url('mobile/client/client-list') }}'" >立即申请</button>
            </div>
            <div class="am-u-sm-4" style="margin: 0; padding: 0;">
                <button type="button" class="am-btn am-btn-success am-btn-block" onclick="javascript:window.location='tel:13903032418'">点击拨打</button>
            </div>
        </div>
    </div>
@endsection