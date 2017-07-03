@extends('layouts.mobile')
@section('content')
@include('include.mobile.footer')
    <div class="pet_mian" id="top">
        <div data-am-widget="slider" class="am-slider am-slider-a1" data-am-slider='{"directionNav":false}' >
            <ul class="am-slides">
                <li>
                    <img src="{{ url('build/img/fl03.png') }}">
                </li>
                <li>
                    <img src="{{ url('build/img/fl02.png') }}">
                </li>
                <li>
                    <img src="{{ url('build/img/fl01.png') }}">
                </li>
            </ul>
        </div>

        <div class="pet_circle_nav">
            <ul class="pet_circle_nav_list">
                <li><a href="{{ url('mobile/plan-details/1') }}" class="iconfont pet_nav_xinxianshi ">&#xe61e;</a><span>信用贷</span></li>
                <li><a href="{{ url('mobile/plan-details/2') }}" class="iconfont pet_nav_zhangzhishi ">&#xe607;</a><span>企业贷</span></li>
                <li><a href="{{ url('mobile/plan-details/3') }}" class="iconfont pet_nav_kantuya ">&#xe62c;</a><span>车贷</span></li>
                <li><a href="{{ url('mobile/plan-details/4') }}" class="iconfont pet_nav_mengzhuanti ">&#xe622;</a><span>房贷</span></li>
                <li><a href="{{ url('mobile/plan-details/5') }}" class="iconfont pet_nav_yiyuan ">&#xe602;</a><span>工资贷</span></li>
                <li><a href="{{ url('mobile/client/client-poster-list') }}" class="iconfont pet_nav_meirong ">&#xe629;</a><span>推客</span></li>
                <li><a href="{{ url('mobile/member/person-list') }}" class="iconfont pet_nav_dianpu ">&#xe604;</a><span>我的</span></li>
                <li><a href="javascript:;" class="iconfont pet_nav_gengduo ">&#xe600;</a><span>更多</span></li>
            </ul>
            <div class="pet_more_list"><div class="pet_more_list_block">
                    <div class="iconfont pet_more_close">×</div>
                    <div class="pet_more_list_block">
                        <div class="pet_more_list_block_name">
                            <div class="pet_more_list_block_name_title">阅读 Read</div>
                            <a class="pet_more_list_block_line">
                                <i class="iconfont pet_nav_xinxianshi pet_more_list_block_line_ico">&#xe61e;</i>
                                <div class="pet_more_list_block_line_font">新鲜事</div>
                            </a>
                            <a class="pet_more_list_block_line">
                                <i class="iconfont pet_nav_zhangzhishi pet_more_list_block_line_ico">&#xe607;</i>
                                <div class="pet_more_list_block_line_font">趣闻</div>
                            </a>
                            <a class="pet_more_list_block_line">
                                <i class="iconfont pet_nav_kantuya pet_more_list_block_line_ico">&#xe62c;</i>
                                <div class="pet_more_list_block_line_font">阅读</div>
                            </a>
                            <a class="pet_more_list_block_line">
                                <i class="iconfont pet_nav_mengzhuanti pet_more_list_block_line_ico">&#xe622;</i>
                                <div class="pet_more_list_block_line_font">专题</div>
                            </a>
                            <a class="pet_more_list_block_line">
                                <i class="iconfont pet_nav_bk pet_more_list_block_line_ico">&#xe629;</i>
                                <div class="pet_more_list_block_line_font">订阅</div>
                            </a>
                            <a class="pet_more_list_block_line">
                                <i class="iconfont pet_nav_wd pet_more_list_block_line_ico">&#xe602;</i>
                                <div class="pet_more_list_block_line_font">专栏</div>
                            </a>
                            <div class="pet_more_list_block_name_title pet_more_list_block_line_height">服务 Service</div>
                            <a class="pet_more_list_block_line">
                                <i class="iconfont pet_nav_xinxianshi pet_more_list_block_line_ico">&#xe61e;</i>
                                <div class="pet_more_list_block_line_font">新鲜事</div>
                            </a>
                            <a class="pet_more_list_block_line">
                                <i class="iconfont pet_nav_zhangzhishi pet_more_list_block_line_ico">&#xe607;</i>
                                <div class="pet_more_list_block_line_font">趣闻</div>
                            </a>
                            <a class="pet_more_list_block_line">
                                <i class="iconfont pet_nav_kantuya pet_more_list_block_line_ico">&#xe62c;</i>
                                <div class="pet_more_list_block_line_font">阅读</div>
                            </a>
                            <a class="pet_more_list_block_line">
                                <i class="iconfont pet_nav_mengzhuanti pet_more_list_block_line_ico">&#xe622;</i>
                                <div class="pet_more_list_block_line_font">专题</div>
                            </a>
                            <a class="pet_more_list_block_line">
                                <i class="iconfont pet_nav_bk pet_more_list_block_line_ico">&#xe629;</i>
                                <div class="pet_more_list_block_line_font">订阅</div>
                            </a>
                            <a class="pet_more_list_block_line">
                                <i class="iconfont pet_nav_wd pet_more_list_block_line_ico">&#xe602;</i>
                                <div class="pet_more_list_block_line_font">专栏</div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="pet_comment_list">
            <div class="pet_comment_list_wap"><div class="pet_comment_list_title">热门贷款顾问</div>
                <div data-am-widget="tabs" class="am-tabs am-tabs-default pet_comment_list_tab" >
                    <ul class="am-tabs-nav am-cf pet_comment_list_title_tab">
                        <li class="am-active"><a href="[data-tab-panel-0]">人气</a></li>
                        <li class=""><a href="[data-tab-panel-1]">最新</a></li>
                        <li class=""><a href="[data-tab-panel-2]">最早</a></li>
                    </ul>
                    <div class="am-tabs-bd pet_pl_list">
                        <ul>
                            @foreach($consultant as $con_val)
                            <li class="One_ayi" style="background-color: white; margin: 0; padding: 0;">
                                <div class="one_a_con div_allinline">
                                    <a href="{{ url('mobile/consultant/consultant-details',['id'=>$con_val]) }}">
                                    <div class="subdiv_allinline img_left">
                                        <img src="{{ url('build/uploads/'.$con_val['con_pic']) }}" style="height: 140px;">
                                    </div>
                                    </a>
                                    <div class="subdiv_allinline right_con">
                                        <p class="ayi_name">{{ $con_val['con_name'] }}</p>
                                        <p class="con_a1">咨询人数：{{ $con_val['con_person'] }}</p>
                                        <p class="con_a1">从业时间：{{ $con_val['con_time'] }}</p>
                                        <p class="haopinglv">评分: 4.5分</p>
                                        <a href="tel:{{ $con_val['con_tel'] }}">
                                        <p class="ljyy_bt" style="bottom:-15px;">
                                            <img class="ljyy_im" src="http://www.miayi.net/modules/AuntsList/pic/LiJiYuYue.png">
                                        </p>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="pet_comment_list">
            <div class="pet_comment_list_wap"><div class="pet_comment_list_title">O2O线下门店</div>
                <div data-am-widget="tabs" class="am-tabs am-tabs-default pet_comment_list_tab" >
                    <ul class="am-tabs-nav am-cf pet_comment_list_title_tab">
                        <li class="am-active"><a href="[data-tab-panel-0]">人气</a></li>
                        <li class=""><a href="[data-tab-panel-1]">最新</a></li>
                        <li class=""><a href="[data-tab-panel-2]">最早</a></li>
                    </ul>
                    <div class="am-tabs-bd pet_pl_list">
                        <ul>
                            @foreach($shop as $conVal)
                            <li class="One_ayi" style="background-color: white; margin: 0; padding: 0;">
                                <div class="one_a_con div_allinline">
                                    <a href="{{ url('mobile/shop-details',['id'=>$conVal['id']]) }}">
                                    <div class="subdiv_allinline img_left">
                                        <img src="{{ url('build/uploads/'.$conVal['con_pic']) }}" style="width:120px; height: 140px;">
                                    </div>
                                    </a>
                                    <div class="subdiv_allinline right_con">
                                        <p class="ayi_name">{{ $conVal['con_name'] }}</p>
                                        <p class="con_a1">咨询电话：{{ $conVal['con_tel'] }}</p>
                                        <p class="con_a1">店面地址：{{ $conVal['con_add'] }}</p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 38px;"></div>

    </div>
@endsection
@section('script')
    <script>
        $(function(){

            // 动态计算新闻列表文字样式
            auto_resize();
            $(window).resize(function() {
                auto_resize();
            });
            $('.am-list-thumb img').load(function(){
                auto_resize();
            });

            $('.am-list > li:last-child').css('border','none');
            function auto_resize(){
                $('.pet_list_one_nr').height($('.pet_list_one_img').height());
            }
            $('.pet_nav_gengduo').on('click',function(){
                $('.pet_more_list').addClass('pet_more_list_show');
            });
            $('.pet_more_close').on('click',function(){
                $('.pet_more_list').removeClass('pet_more_list_show');
            });
        });
    </script>
@endsection