@extends('layouts.mobile')
@section('content')
    <div class="pet_mian" >
        <div class="pet_head">
            <header data-am-widget="header"
                    class="am-header am-header-default pet_head_block" style="background: #303435;">
                <div class="am-header-left am-header-nav ">
                    <a href="{{ url('mobile/index') }}" class="iconfont pet_head_jt_ico">&#xe601;</a>
                </div>
                <div class="pet_news_list_tag_name">建设中...</div>
                <div class="am-header-right am-header-nav">
                    <a href="javascript:;" class="iconfont pet_head_gd_ico">&#xe600;</a>
                </div>
            </header>
        </div>
        <img src="{{ url('build/img/error.jpg') }}" width="100%" alt="">
    </div>
@endsection