@extends('layouts.home')
@section('content')
    {{--top--}}
    <div class="am-g bg_grey">
        <div class="am-container am-padding-horizontal-0" style="height: 40px;">
            <div class="am-u-lg-3 am-fl am-padding-0">
                <dt class="am-text-xs font_black" style="padding-top:8px;">贷款：<sapn class="font_black no_bold" style="font-size: 16px; color: white;">4008-041-051</sapn></dt>
            </div>
            <div class="am-u-lg-3 am-fr am-padding-0">
                <dl class="am-cf am-margin-0" style="padding-top:4px;">
                    <dt class="am-fr am-text-xs am-margin-right-sm am-padding-top-xs"><a href="#" class="font_black no_bold"><i class="am-icon-envelope-square am-icon-fw"></i>手机广东贷款网</a></dt>
                    <dt class="am-fr am-text-xs am-margin-right-sm am-padding-top-xs"><a href="#" class="font_black no_bold" >资讯</a></dt>
                    <dt class="am-fr am-text-xs am-margin-right-sm am-padding-top-xs"><a href="#" class="font_black no_bold" >问答</a></dt>
                </dl>
            </div>
        </div>
    </div>

     {{--ngv--}}
    <div class="am-g am-g-fixed">
        <div class="am-u-lg-4 am-padding-horizontal-0 am-padding-vertical"><img src="{{ url('build/img/logo.jpg') }}"></div>
        <div class="am-u-lg-8 am-padding-0">
            <ul class="am-nav am-nav-pills am-nav-justify am-padding-top-lg" style="width: 500px; float: right;">
                <li class="am-text-gx"><a href="#" class="font_green">首页</a></li>
                <li class="am-text-gx"><a href="#" class="font_green">贷款</a></li>
                <li class="am-text-gx"><a href="#" class="font_green">关于我们</a></li>
                <li class="am-text-gx"><a href="#" class="font_green">注册</a></li>
                <li class="am-text-gx"><a href="#" class="font_green">登录</a></li>
            </ul>
        </div>
    </div>

    {{--hdp--}}
    <div class="am-g am-g-fixed">
        <div class="am-u-lg-9 am-padding-horizontal-xs">
            <div data-am-widget="slider" class="am-slider am-slider-a1 am-no-layout" data-am-slider="{&quot;directionNav&quot;:false}">
                <div class="am-viewport" style="overflow: hidden; position: relative;">
                    <ul class="am-slides" style="width: 2000%; transition-duration: 0.6s; transform: translate3d(-2450px, 0px, 0px);">
                        <li class="clone" aria-hidden="true" style="width: 490px; float: left; display: block;"><img src="{{ url('build/img/fl03.png') }}" draggable="false"></li>
                        <li style="width: 490px; float: left; display: block;" class=""><img src="{{ url('build/img/fl02.png') }}" draggable="false" ></li>
                        <li style="width: 490px; float: left; display: block;" class="clone" aria-hidden="true"><a href="#" target="_blank"><img src="{{ url('build/img/fl01.png') }}" draggable="false"></a></li>
                    </ul>
                </div>
                <ol class="am-control-nav am-control-paging"><li><a class="">1</a><i></i></li><li><a class="">2</a><i></i></li><li><a class="">3</a><i></i></li></ol>
            </div>
        </div>

        <div class="am-u-lg-3 am-padding-horizontal-xs">
            <div data-am-widget="tabs" class="am-tabs am-tabs-d2 am-margin-0 br_lf br_rg br_tp_g am-no-layout">
                <ul class="am-tabs-nav am-cf">
                    <li class="am-active"><a href="[data-tab-panel-0]">我要贷款</a></li>
                    <li class=""><a href="[data-tab-panel-1]">申请贷款</a></li>
                </ul>
                <div class="am-tabs-bd" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                    <div data-tab-panel-0="" class="am-tab-panel am-active am-in">
                        <form class="am-form" name="formLogin" action="#" method="post" onsubmit="return userLogin()">
                            <fieldset class="am-form-set am-margin-bottom-xs">
                                <div class="am-input-group am-margin-top-sm">
                                    <span class="am-input-group-label">贷款类型</span>
                                    <select id="doc-select-1" class="am-form-field">
                                        <option value="option1">信用贷款</option>
                                        <option value="option2">企业贷款</option>
                                        <option value="option3">保单贷款</option>
                                    </select>
                                </div>
                                <div class="am-input-group am-margin-top-sm">
                                    <span class="am-input-group-label">贷款用途</span>
                                    <select id="doc-select-1" class="am-form-field">
                                        <option value="option1">不限</option>
                                        <option value="option2">打工</option>
                                        <option value="option3">创业</option>
                                    </select>
                                </div>
                                <div class="am-input-group am-margin-top-sm">
                                    <span class="am-input-group-label">贷款期限</span>
                                    <select id="doc-select-1" class="am-form-field">
                                        <option value="option1">不限</option>
                                        <option value="option2">随借随还</option>
                                        <option value="option3">1—12个月</option>
                                    </select>
                                </div>
                            </fieldset>
                            <div class="loginbar_btn" style="padding-top:10px;">
                                <input type="hidden" name="act" value="act_login">
                                <input type="hidden" name="back_act" value="">
                                <input class="am-btn am-btn-success am-btn-block" type="submit" name="submit" value="搜&nbsp;&nbsp;索">
                            </div>
                        </form>
                    </div>

                    <div data-tab-panel-1="" class="am-tab-panel am-padding-vertical-0">
                        <form class="am-form" action="user.php" method="post" name="formuser" onsubmit="return register();">
                            <fieldset class="am-form-set am-margin-bottom-0">
                                <input type="text" placeholder="贷款金额(万元)" name="username" class="am-input-sm am-margin-top-xs">
                                <input type="password" placeholder="您的姓氏" name="password" class="am-input-sm am-margin-top-xs">
                                <select id="doc-select-1" class="am-input-sm am-margin-top-xs">
                                    <option value="option1">选择性别</option>
                                    <option value="option1">男</option>
                                    <option value="option2">女</option>
                                    <option value="option3">保密</option>
                                </select>
                                <div class="am-input-group">
                                    <input type="text" placeholder="手机号" class="am-form-field am-input-sm am-margin-top-xs">
                                    <span class="am-input-group-btn">
                                    <button class="am-btn am-btn-default am-input-sm am-margin-top-xs" type="button">获取验证码</button>
                                    </span>
                                </div>
                                <input type="password" placeholder="验证码" name="confirm_password" class="am-input-sm am-margin-top-xs">
                            </fieldset>
                            <input class="am-btn am-btn-success am-btn-block am-margin-vertical-xs" name="submit" type="submit" value="立即申请">
                        </form>
                    </div>
                </div>
            </div>

            <div class="am-container am-padding-0 br_lf br_rg br_bt br_tp_g">
                <ul class="am-avg-lg-2 am-avg-sm-2">
                    <li class="am-text-center am-vertical-align br_bt br_rg" style="height:46px;"><a href="user.php" class="am-vertical-align-middle font_black"><span><img src="http://www.61tk.com/themes/default/images/ico/ico_1.jpg" style="margin:0 5px 4px 0"></span>征信查询</a></li>
                    <li class="am-text-center am-vertical-align br_bt " style="height:46px;"><a href="goods.php" class="am-vertical-align-middle font_black"><span><img src="http://www.61tk.com/themes/default/images/ico/ico_2.jpg" style="margin:0 5px 4px 0"></span>在线预约</a></li>
                </ul>
            </div>
        </div>
        <div style="width: 100%; margin:0 auto; padding: 0;">
            <img src="{{ url('build/img/show2.jpg') }}" alt="" style="width: 100%;">
        </div>
    </div>

    {{--new--}}
    <div class="am-g am-g-fixed am-margin-top-lg ">

        <div class="am-u-lg-9 am-padding-0">
            <div data-am-widget="titlebar" class="am-titlebar am-titlebar-multi am-margin-top-xs am-no-layout">
                <h1 class="am-margin-bottom-0 am-text-xxl no_bold am-hide-md-down">贷款资讯</h1>
                <nav class="am-titlebar-nav">
                    <a href="article_cat.php?id=12" class="">更多资讯»</a>
                </nav>
            </div>
            <div class="am-container am-padding-0 am-list-news-bd">
                <ul class="am-list am-margin-bottom-0">
                    <li class="am-list-item-dated am-padding-horizontal-xs">
                        <a href="article.php?id=66862" class="am-list-item-hd">辣么多app就是贷不到款 可能真是你的手机问题</a>
                        <span class="am-list-date">2017-06-17</span>
                    </li>
                    <li class="am-list-item-dated am-padding-horizontal-xs">
                        <a href="article.php?id=66858" class="am-list-item-hd">汽车抵押不押车贷款怎么办理</a>
                        <span class="am-list-date">2017-06-06</span>
                    </li>
                    <li class="am-list-item-dated am-padding-horizontal-xs">
                        <a href="article.php?id=66860" class="am-list-item-hd">【中佳信】成都房屋抵押贷款 不限房产类型配偶可不用签字</a>
                        <span class="am-list-date">2017-06-01</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="am-u-lg-3 am-padding-right-0 ">
            <ul class="am-avg-lg-2 am-avg-sm-2 br_tp_g br_lf br_rg am-margin-top-xl">
                <li class="am-text-center am-vertical-align br_bt br_rg" style="height:58px;"><a href="goto.php?act=goto" class="am-vertical-align-middle ">深资顾问</a></li>
                <li class="am-text-center am-vertical-align br_bt " style="height:58px;"><a href="goto_1.php?act=goto" class="am-vertical-align-middle ">贷款顾问</a></li>
                <li class="am-text-center am-vertical-align br_bt br_rg" style="height:58px;"><a href="goto_2.php?act=goto" class="am-vertical-align-middle ">客户信赖</a></li>
                <li class="am-text-center am-vertical-align br_bt" style="height:58px;"><a href="goto_3.php?act=goto" class="am-vertical-align-middle ">贷款问答</a></li>
                <li class="am-text-center am-vertical-align br_bt br_rg" style="height:58px;"><a href="goto_4.php?act=goto" class="am-vertical-align-middle ">体验网点</a></li>
                <li class="am-text-center am-vertical-align br_bt" style="height:58px;"><a href="goto_5.php?act=goto" class="am-vertical-align-middle ">贷款计算机</a></li>
            </ul>
        </div>
    </div>

    {{--daik--}}
    <div class="am-g am-g-fixed am-margin-top-lg" style="margin-top: 3.5rem">

        <div class="am-u-lg-9 am-padding-horizontal-xs">
            <div data-am-widget="tabs" class="am-tabs am-tabs-d2 am-margin-0 am-no-layout">
                <ul class="am-tabs-nav am-cf am-padding-0">
                    <h1 class="am-margin-bottom-0 am-padding-right-sm am-padding-bottom-sm br_bt am-text-xxl no_bold am-hide-md-down">轻松贷款</h1>
                    <li class="am-padding-top-sm am-text-lg am-active" style="height:64px;"><a href="[data-tab-panel-1]">信用贷</a></li>
                    <li class="am-padding-top-sm am-text-lg" style="height:64px;"><a href="[data-tab-panel-2]">房产贷</a></li>
                    <li class="am-padding-top-sm am-text-lg" style="height:64px;"><a href="[data-tab-panel-3]">企业贷</a></li>
                    <li class="am-padding-top-sm am-text-lg" style="height:64px;"><a href="[data-tab-panel-4]">保单贷</a></li>
                    <li class="am-padding-top-sm am-text-lg" style="height:64px;"><a href="[data-tab-panel-5]">工资贷</a></li>
                    <li class="am-padding-top-sm am-text-lg" style="height:64px;"><a href="[data-tab-panel-6]">汽车贷</a></li>
                    <li class="am-padding-top-sm am-text-lg" style="height:64px;"><a href="[data-tab-panel-7]">应急贷</a></li>
                </ul>
                <div class="am-tabs-bd am-margin-left-0 am-margin-right-0" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                    <div data-tab-panel-1="" class="am-tab-panel am-padding-0 am-active">
                        <div class="am-u-lg-2 am-padding-vertical-sm am-u-sm-6">
                            <ul>
                                <li class="font_grey"><a href="diaocha.php?act=edit_diary&amp;id=8" class="font_grey am-text-sm" target="_black">东莞贷款了</a></li>
                            </ul>
                        </div>
                    </div>

                    <div data-tab-panel-2="" class="am-tab-panel am-padding-0">
                        <div class="am-u-lg-2 am-padding-vertical-sm am-u-sm-6">
                            <ul>
                                <li class="font_grey"><a href="diaocha.php?act=edit_diary&amp;id=8" class="font_grey am-text-sm" target="_black">深圳贷款了</a></li>
                            </ul>
                        </div>
                    </div>
                    <div data-tab-panel-3="" class="am-tab-panel am-padding-0">

                        <div class="am-u-lg-2 am-padding-vertical-sm am-u-sm-6">
                            <ul>
                                <li class="font_grey"><a href="diaocha.php?act=edit_diary&amp;id=8" class="font_grey am-text-sm" target="_black">广州贷款了</a></li>
                            </ul>
                        </div>
                    </div>
                    <div data-tab-panel-4="" class="am-tab-panel am-padding-0">
                        <div class="am-u-lg-2 am-padding-vertical-sm am-u-sm-6">
                            <ul>
                                <li class="font_grey"><a href="diaocha.php?act=edit_diary&amp;id=19" class="font_grey am-text-sm" target="_black">惠州贷款了</a></li>
                            </ul>
                        </div>
                    </div>
                    <div data-tab-panel-5="" class="am-tab-panel am-padding-0">
                        <div class="am-u-lg-2 am-padding-vertical-sm am-u-sm-6">
                            <ul>
                                <li class="font_grey"><a href="diaocha.php?act=edit_diary&amp;id=19" class="font_grey am-text-sm" target="_black">河源贷款了</a></li>
                            </ul>
                        </div>
                    </div>
                    <div data-tab-panel-6="" class="am-tab-panel am-padding-0">
                        <div class="am-u-lg-2 am-padding-vertical-sm am-u-sm-6">
                            <ul>
                                <li class="font_grey"><a href="diaocha.php?act=edit_diary&amp;id=18" class="font_grey am-text-sm" target="_black">中山贷款了</a></li>
                            </ul>
                        </div>
                    </div>
                    <div data-tab-panel-7="" class="am-tab-panel am-padding-0">
                        <div class="am-u-lg-2 am-padding-vertical-sm am-u-sm-6">
                            <ul>
                                <li class="font_grey"><a href="diaocha.php?act=edit_diary&amp;id=28" class="font_grey am-text-sm" target="_black">江门贷款了</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="am-u-lg-3 am-padding-horizontal-xs">
            <div data-am-widget="titlebar" class="am-titlebar am-titlebar-multi am-margin-top-0 am-no-layout">
                <h1 class=" am-margin-bottom-0 am-padding-bottom-sm am-text-xxl no_bold">贷款申请</h1>
            </div>
            <div class="am-container am-padding-horizontal-0 br_bt br_lf br_rg" style="padding-top:1.5rem;">
                <form class="am-form" action="user.php?act=add_diary_do" method="post" name="frmDiary">
                    <fieldset class="am-margin-bottom-xs">
                        <div class="am-form-group">
                            <label for="doc-ipt-email-1">贷款额度（万元）</label>
                            <input type="text" class="" id="doc-ipt-email-1" placeholder="输入贷款额度">
                        </div>

                        <div class="am-form-group">
                            <label for="doc-ipt-email-1">您的姓氏</label>
                            <input type="text" class="" id="doc-ipt-email-1" placeholder="输入您的姓氏">
                        </div>

                        <div class="am-form-group">
                            <label for="doc-select-1">性别</label>
                            <select id="doc-select-1">
                                <option value="option1">请选择</option>
                                <option value="option2">男</option>
                                <option value="option3">女</option>
                                <option value="option3">保密</option>
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label for="doc-ipt-email-1">手机号</label>
                        <div class="am-input-group">
                            <input type="text" placeholder="输入您的手机号" class="am-form-field am-input-sm am-margin-top-xs">
                            <span class="am-input-group-btn">
                                    <button class="am-btn am-btn-default am-input-sm am-margin-top-xs" type="button">获取验证码</button>
                                    </span>
                        </div>
                        </div>
                        <div class="am-form-group">
                            <label for="doc-ipt-email-1">验证码</label>
                            <input type="text" class="" id="doc-ipt-email-1" placeholder="输入验证码">
                        </div>
                        <input class="am-btn am-btn-success am-btn-block am-margin-vertical-xs" name="submit" type="submit" value="立即申请">
                    </fieldset>
                </form>
            </div>
        </div>

    </div>

    {{--zix--}}
    <div class="am-g am-g-fixed am-margin-top-lg" style="margin-top: 3.5rem">
        <div class="am-u-lg-9 am-padding-0">
            <div data-am-widget="titlebar" class="am-titlebar am-titlebar-multi am-margin-top-xs am-no-layout">
                <h1 class="am-margin-bottom-0 am-text-xxl no_bold am-hide-md-down">热门贷款顾问</h1>
                <nav class="am-titlebar-nav">
                    <a href="article_cat.php?id=9" class="">更多顾问»</a>
                </nav>
            </div>
            <div class="am-container am-padding-0 am-slider am-slider-default" data-am-flexslider="{itemWidth:180, itemMargin:0, slideshow: true,move: 1,controlNav: false,animationLoop: true,}">

                <div class="am-viewport" style="overflow: hidden; position: relative;"><ul class="am-slides" style="width: 1600%; transition-duration: 0.6s; transform: translate3d(-180px, 0px, 0px);">

                        <li class="br_lf br_bt br_rg am-padding-top-sm am-padding-bottom-0 am-padding-horizontal-sm" style="height: 328px; width: 180px; float: left; display: block;">
                            <a href="#">
                                <img src="{{ url('build/uploads/2017-06-13-11-17-21-593f59414bd8d.jpg') }}" class="am-img-thumbnail am-circle am-img-responsive" draggable="false">
                                <p class="am-text-gx am-text-center am-margin-bottom-0">王经理</p>
                                <p class="am-text-sm am-text-center am-margin-vertical-0 br_bt font_green">信用贷款顾问</p>
                                <p class="am-text-xs font_grey am-margin-top-xs">擅长：信用贷款、房产贷款、企业贷款、多种渠道。</p>
                            </a>
                        </li>
                        <li class="br_lf br_bt br_rg am-padding-top-sm am-padding-bottom-0 am-padding-horizontal-sm" style="height: 328px; width: 180px; float: left; display: block;">
                            <a href="#">
                                <img src="{{ url('build/uploads/2017-06-13-11-17-21-593f59414bd8d.jpg') }}" class="am-img-thumbnail am-circle am-img-responsive" draggable="false">
                                <p class="am-text-gx am-text-center am-margin-bottom-0">王经理</p>
                                <p class="am-text-sm am-text-center am-margin-vertical-0 br_bt font_green">信用贷款顾问</p>
                                <p class="am-text-xs font_grey am-margin-top-xs">擅长：信用贷款、房产贷款、企业贷款、多种渠道。</p>
                            </a>
                        </li>
                        <li class="br_lf br_bt br_rg am-padding-top-sm am-padding-bottom-0 am-padding-horizontal-sm" style="height: 328px; width: 180px; float: left; display: block;">
                            <a href="#">
                                <img src="{{ url('build/uploads/2017-06-13-11-17-21-593f59414bd8d.jpg') }}" class="am-img-thumbnail am-circle am-img-responsive" draggable="false">
                                <p class="am-text-gx am-text-center am-margin-bottom-0">王经理</p>
                                <p class="am-text-sm am-text-center am-margin-vertical-0 br_bt font_green">信用贷款顾问</p>
                                <p class="am-text-xs font_grey am-margin-top-xs">擅长：信用贷款、房产贷款、企业贷款、多种渠道。</p>
                            </a>
                        </li>
                        <li class="br_lf br_bt br_rg am-padding-top-sm am-padding-bottom-0 am-padding-horizontal-sm" style="height: 328px; width: 180px; float: left; display: block;">
                            <a href="#">
                                <img src="{{ url('build/uploads/2017-06-13-11-17-21-593f59414bd8d.jpg') }}" class="am-img-thumbnail am-circle am-img-responsive" draggable="false">
                                <p class="am-text-gx am-text-center am-margin-bottom-0">王经理</p>
                                <p class="am-text-sm am-text-center am-margin-vertical-0 br_bt font_green">信用贷款顾问</p>
                                <p class="am-text-xs font_grey am-margin-top-xs">擅长：信用贷款、房产贷款、企业贷款、多种渠道。</p>
                            </a>
                        </li>
                        <li class="br_lf br_bt br_rg am-padding-top-sm am-padding-bottom-0 am-padding-horizontal-sm" style="height: 328px; width: 180px; float: left; display: block;">
                            <a href="#">
                                <img src="{{ url('build/uploads/2017-06-13-11-17-21-593f59414bd8d.jpg') }}" class="am-img-thumbnail am-circle am-img-responsive" draggable="false">
                                <p class="am-text-gx am-text-center am-margin-bottom-0">王经理</p>
                                <p class="am-text-sm am-text-center am-margin-vertical-0 br_bt font_green">信用贷款顾问</p>
                                <p class="am-text-xs font_grey am-margin-top-xs">擅长：信用贷款、房产贷款、企业贷款、多种渠道。</p>
                            </a>
                        </li>
                        <li class="br_lf br_bt br_rg am-padding-top-sm am-padding-bottom-0 am-padding-horizontal-sm" style="height: 328px; width: 180px; float: left; display: block;">
                            <a href="#">
                                <img src="{{ url('build/uploads/2017-06-13-11-17-21-593f59414bd8d.jpg') }}" class="am-img-thumbnail am-circle am-img-responsive" draggable="false">
                                <p class="am-text-gx am-text-center am-margin-bottom-0">王经理</p>
                                <p class="am-text-sm am-text-center am-margin-vertical-0 br_bt font_green">信用贷款顾问</p>
                                <p class="am-text-xs font_grey am-margin-top-xs">擅长：信用贷款、房产贷款、企业贷款、多种渠道。</p>
                            </a>
                        </li>
                        <li class="br_lf br_bt br_rg am-padding-top-sm am-padding-bottom-0 am-padding-horizontal-sm" style="height: 328px; width: 180px; float: left; display: block;">
                            <a href="#">
                                <img src="{{ url('build/uploads/2017-06-13-11-17-21-593f59414bd8d.jpg') }}" class="am-img-thumbnail am-circle am-img-responsive" draggable="false">
                                <p class="am-text-gx am-text-center am-margin-bottom-0">王经理</p>
                                <p class="am-text-sm am-text-center am-margin-vertical-0 br_bt font_green">信用贷款顾问</p>
                                <p class="am-text-xs font_grey am-margin-top-xs">擅长：信用贷款、房产贷款、企业贷款、多种渠道。</p>
                            </a>
                        </li>
                        <li class="br_lf br_bt br_rg am-padding-top-sm am-padding-bottom-0 am-padding-horizontal-sm" style="height: 328px; width: 180px; float: left; display: block;">
                            <a href="#">
                                <img src="{{ url('build/uploads/2017-06-13-11-17-21-593f59414bd8d.jpg') }}" class="am-img-thumbnail am-circle am-img-responsive" draggable="false">
                                <p class="am-text-gx am-text-center am-margin-bottom-0">王经理</p>
                                <p class="am-text-sm am-text-center am-margin-vertical-0 br_bt font_green">信用贷款顾问</p>
                                <p class="am-text-xs font_grey am-margin-top-xs">擅长：信用贷款、房产贷款、企业贷款、多种渠道。</p>
                            </a>
                        </li>

                    </ul></div><ul class="am-direction-nav"><li class="am-nav-prev"><a class="am-prev" href="#"> </a></li><li class="am-nav-next"><a class="am-next" href="#"> </a></li></ul></div>
        </div>

        <div class="am-u-lg-3 am-padding-horizontal-xs">
            <div data-am-widget="titlebar" class="am-titlebar am-titlebar-multi am-margin-top-0 am-no-layout">
                <h1 class=" am-margin-bottom-0 am-padding-bottom-sm am-text-xxl no_bold">免费提问</h1>
            </div>
            <div class="am-container am-padding-horizontal-0 br_bt br_lf br_rg" style="padding-top:1.5rem;">
                <form class="am-form" action="user.php?act=add_diary_do" method="post" name="frmDiary">
                    <fieldset class="am-margin-bottom-xs">
                        <div class="am-form-group am-cf">
                            <label for="doc-ipt-name-1" class="font_grey am-fl">姓名</label>
                            <input type="name" name="title" class="am-margin-left-sm am-input-sms" id="doc-ipt-name-1" placeholder="" autocomplete="on">
                        </div>
                        <div class="am-form-group am-cf am-margin-bottom-0">
                            <div class="am-u-lg-6 am-padding-horizontal-0 am-cf am-margin-vertical-xs">
                                <label for="doc-select-1" class="font_grey am-fl">性别</label>
                                <select id="doc-select-1" class="am-margin-left-sm am-fl am-input-sm" style="width:60px;">
                                    <option value="0" name="sex">男</option>
                                    <option value="1" name="sex">女</option>
                                    <option value="" name="sex">保密</option>
                                </select>
                            </div>
                            <div class="am-u-lg-6 am-padding-horizontal-0 am-cf am-margin-vertical-xs">
                                <label for="doc-ipt-email-1" class="font_grey am-fl">年龄</label>
                                <input type="text" name="age" class="am-margin-left-sm am-margin-right-xs am-fl am-input-sm" id="doc-ipt-email-1" placeholder="" style="width:80px;">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="doc-ta-1" class="font_grey">提问</label>
                            <textarea class="" rows="4" id="doc-ta-1" name="content"></textarea>
                        </div>
                        <div class="am-form-group am-form-file am-cf">
                            <label class="font_grey am-fl am-margin-right">图片</label>
                            <i class="am-icon-cloud-upload"></i> 选择要上传的文件
                            <input id="doc-form-file" type="file" multiple="">
                        </div>
                        <div id="file-list"></div>
                        <script>
                            $(function() {
                                $('#doc-form-file').on('change', function() {
                                    var fileNames = '';
                                    $.each(this.files, function() {
                                        fileNames += '<span class="am-badge">' + this.name + '</span> ';
                                    });
                                    $('#file-list').html(fileNames);
                                });
                            });
                        </script>
                        <div class="am-form-group">
                            <label for="doc-ipt-name-1" class="font_grey">电话</label>
                            <input type="name" class="am-margin-left-sm" id="doc-ipt-name-1" name="phone" placeholder="">
                        </div>
                        <input type="submit" value="快&nbsp;&nbsp;速&nbsp;&nbsp;提&nbsp;&nbsp;问" class="am-btn am-btn-success am-btn-block am-text-lg" style="height:46px;padding-bottom:10px;">
                    </fieldset>
                </form>
            </div>
        </div>

    </div>

    {{--bo--}}
    <div class="am-g am-g-fixed">
        <div data-am-widget="titlebar" class="am-titlebar am-titlebar-multi am-margin-top-0 am-no-layout">
            <h1 class="am-margin-bottom-0 am-padding-right-sm am-padding-bottom-sm br_bt am-text-xxl no_bold am-hide-md-down">合作伙伴</h1>
        </div>
        <div class="am-container br_tp br_bt br_lf br_rg am-margin-top-sm am-padding-horizontal-0">
            <ul class="am-avg-lg-6 am-avg-sm-2 am-margin-vertical-sm am-padding-left-sm">
                <li class=""><a href="#"><img src=""></a></li>
            </ul>
        </div>
    </div>

    {{--foter--}}
    <div class="am-g bg_grey am-margin-top-lg" style="margin-top: 3.5rem;">
        <div class="am-container">
            <div class="am-footer-miscs am-text-center am-margin-vertical-xs">
                <a class="am-text-xs font_grey am-margin-horizontal-sm">东莞市永盟企业投资咨询有限公司</a>
                <a class="am-text-xs font_grey am-margin-horizontal-sm">备案号：粤ICP备17063317号-1</a>
                <p align="center" class="am-margin-vertical-xs">
                    <a class="am-text-xs font_grey am-margin-horizontal-sm">咨询热线：0769-22210105</a>
                    <a class="am-text-xs font_grey am-margin-horizontal-sm">预约热线：4008-041-051</a>
                </p>
            </div>
        </div>
    </div>

@endsection