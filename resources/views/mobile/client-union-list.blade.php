@extends('layouts.mobile')
@section('content')

    <div class="pet_head">
        <header data-am-widget="header" class="am-header am-header-default" style="background-color:#f9fafc;">
            <div class="am-header-left am-header-nav ">
                <a href="#left-link" class="iconfont">&#xe601;</a>
            </div>
            <div class="pet_news_list_tag_name" style="color: black; text-align: left; text-indent: 50px;">我的合伙人</div>
            <div class="am-header-right am-header-nav">
                <a href="javascript:;" class="iconfont pet_head_gd_ico">&#xe600;</a>
            </div>
        </header>
    </div>

    <div class="pet_content_block pet_hd_con">
        <div style="height: 50px;"></div>

            <div class="pet_hd_con_gp_list_nr" style="padding: 20px;">
                <div id="demo-list">
                    <div id="demo-scroller" style="transition-timing-function: cubic-bezier(0.1, 0.57, 0.1, 1); transition-duration: 0ms; transform: translate(0px, 0px) translateZ(0px);">
                        <ul class="am-list widget-list">
                            <li><a href="/widgets/divider/default/0">default (灰色分隔线)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <div style="height: 5px;"></div>
    </div>
@endsection