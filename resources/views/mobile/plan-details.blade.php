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
            <div style="height: 10px;"></div>
        </article>
    </div>

    @include('include.mobile.guide')

@endsection