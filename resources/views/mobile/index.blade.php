@extends('layouts.mobile')
@section('content')
@include('include.footer')
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
                <li><a href="" class="iconfont pet_nav_xinxianshi ">&#xe61e;</a><span>信用卡</span></li>
                <li><a href="" class="iconfont pet_nav_zhangzhishi ">&#xe607;</a><span>贷款</span></li>
                <li><a href="" class="iconfont pet_nav_kantuya ">&#xe62c;</a><span>车贷</span></li>
                <li><a href="" class="iconfont pet_nav_mengzhuanti ">&#xe622;</a><span>房贷</span></li>
                <li><a href="{{ url('mobile/client-list') }}" class="iconfont pet_nav_meirong ">&#xe629;</a><span>推荐贷款</span></li>
                <li><a href="" class="iconfont pet_nav_yiyuan ">&#xe602;</a><span>专栏</span></li>
                <li><a href="" class="iconfont pet_nav_dianpu ">&#xe604;</a><span>讨论</span></li>
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
                            <li class="One_ayi" style="background-color: white; margin: 0; padding: 0;">
                                <div class="one_a_con div_allinline">
                                    <div class="subdiv_allinline img_left" urlt="http://admin.miayi.net/modules/WX_MAY/?id=201702280857321836">
                                        <img src="https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=3803512966,1757656304&fm=58" style="height: 140px;">
                                    </div>
                                    <div class="subdiv_allinline right_con">
                                        <p class="ayi_name">习近平</p>
                                        <p class="con_a1">咨询人数：361</p>
                                        <p class="con_a1">从业时间：2年</p>
                                        <p class="haopinglv">评分: 4.5分</p>
                                        <p class="ljyy_bt" urlt="http://admin.miayi.net/modules/WX_MAY/?id=201702280857321836" style="bottom:-15px;">
                                            <img class="ljyy_im" src="http://www.miayi.net/modules/AuntsList/pic/LiJiYuYue.png">
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="One_ayi" style="background-color: white; margin: 0; padding: 0;">
                                <div class="one_a_con div_allinline">
                                    <div class="subdiv_allinline img_left" urlt="http://admin.miayi.net/modules/WX_MAY/?id=201702280857321836">
                                        <img src="https://ss0.baidu.com/6ONWsjip0QIZ8tyhnq/it/u=2336393634,1720362053&fm=58" style="height: 140px;">
                                    </div>
                                    <div class="subdiv_allinline right_con">
                                        <p class="ayi_name">李克强</p>
                                        <p class="con_a1">咨询人数：361</p>
                                        <p class="con_a1">从业时间：2年</p>
                                        <p class="haopinglv">评分: 4.5分</p>
                                        <p class="ljyy_bt" urlt="http://admin.miayi.net/modules/WX_MAY/?id=201702280857321836" style="bottom:-15px;">
                                            <img class="ljyy_im" src="http://www.miayi.net/modules/AuntsList/pic/LiJiYuYue.png">
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="One_ayi" style="background-color: white; margin: 0; padding: 0;">
                                <div class="one_a_con div_allinline">
                                    <div class="subdiv_allinline img_left" urlt="http://admin.miayi.net/modules/WX_MAY/?id=201702280857321836">
                                        <img src="https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=3579502762,2068146944&fm=58" style="height: 140px;">
                                    </div>
                                    <div class="subdiv_allinline right_con">
                                        <p class="ayi_name">张德江</p>
                                        <p class="con_a1">咨询人数：361</p>
                                        <p class="con_a1">从业时间：2年</p>
                                        <p class="haopinglv">评分: 4.5分</p>
                                        <p class="ljyy_bt" urlt="http://admin.miayi.net/modules/WX_MAY/?id=201702280857321836" style="bottom:-15px;">
                                            <img class="ljyy_im" src="http://www.miayi.net/modules/AuntsList/pic/LiJiYuYue.png">
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="pet_comment_list">
            <div class="pet_comment_list_wap"><div class="pet_comment_list_title">线下贷款门店</div>
                <div data-am-widget="tabs" class="am-tabs am-tabs-default pet_comment_list_tab" >
                    <ul class="am-tabs-nav am-cf pet_comment_list_title_tab">
                        <li class="am-active"><a href="[data-tab-panel-0]">人气</a></li>
                        <li class=""><a href="[data-tab-panel-1]">最新</a></li>
                        <li class=""><a href="[data-tab-panel-2]">最早</a></li>
                    </ul>
                    <div class="am-tabs-bd pet_pl_list">
                        <ul>
                            <li class="One_ayi" style="background-color: white; margin: 0; padding: 0;">
                                <div class="one_a_con div_allinline">
                                    <div class="subdiv_allinline img_left" urlt="http://admin.miayi.net/modules/WX_MAY/?id=201702280857321836">
                                        <img src="https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=3579502762,2068146944&fm=58" style="height: 140px;">
                                    </div>
                                    <div class="subdiv_allinline right_con">
                                        <p class="ayi_name">虎门-广东贷款网</p>
                                        <p class="con_a1">咨询电话：13800138000</p>
                                        <p class="con_a1">店面地址：虎门销烟路口188号</p>
                                    </div>
                                </div>
                            </li>
                            <li class="One_ayi" style="background-color: white; margin: 0; padding: 0;">
                                <div class="one_a_con div_allinline">
                                    <div class="subdiv_allinline img_left" urlt="http://admin.miayi.net/modules/WX_MAY/?id=201702280857321836">
                                        <img src="https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=3579502762,2068146944&fm=58" style="height: 140px;">
                                    </div>
                                    <div class="subdiv_allinline right_con">
                                        <p class="ayi_name">虎门-广东贷款网</p>
                                        <p class="con_a1">咨询电话：13800138000</p>
                                        <p class="con_a1">店面地址：虎门销烟路口188号</p>
                                    </div>
                                </div>
                            </li>
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