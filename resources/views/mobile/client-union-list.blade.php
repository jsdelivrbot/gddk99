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
        <div style="height: 30px;"></div>
        <article data-am-widget="paragraph" class="am-paragraph am-paragraph-default pet_content_article" style="padding-left: 0; padding-right: 0;" >
            <div class="pet_hd_con_gp_list_nr">
                @if(!empty($info[0]['member_id']))
                @foreach($info as $key=>$list)
                <div class="am-panel am-panel-secondary">
                    <div class="am-panel-hd" data-am-collapse="{parent: '#accordion', target: '#do-not-say-{{ $key }}'}">
                      {{ $list['info_name'] }} <span style="float: right;">{{ $list['updated_at'] }}</span>
                    </div>
                    <div id="do-not-say-{{ $key }}" class="am-panel-collapse am-collapse">
                        <div class="am-panel-bd">
                            <button type="button" class="am-btn am-btn-success am-round" style="float: right; margin-top: 10px;">查看详情</button>
                            <p style="padding: 0; margin: 0;">姓名：{{ $list['info_name'] }}</p>
                            <p style="padding: 0; margin: 0;">电话：{{ $list['info_mobile'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                    <div class="pet_hd_con_gp_list_nr_title">暂无数据</div>
                @endif
            </div>
        </article>
        <div style="height: 5px;"></div>
    </div>
@endsection