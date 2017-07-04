@extends('layouts.mobile')
@section('content')
    @include('include.mobile.footer')
    <div class="pet_head">
        <header data-am-widget="header" class="am-header am-header-default" style="background-color:#f9fafc;">
            <div class="am-header-left am-header-nav ">
                <a href="#left-link" class="iconfont">&#xe601;</a>
            </div>
            <div class="pet_news_list_tag_name" style="color: black; text-align: left; text-indent: 50px;">{{ $plan['plan_title'] }}</div>
            <div class="am-header-right am-header-nav">
                <a href="javascript:;" class="iconfont pet_head_gd_ico">&#xe600;</a>
            </div>
        </header>
    </div>

    <div class="pet_content_block pet_hd_con">
        <div style="height: 30px;"></div>
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
@endsection