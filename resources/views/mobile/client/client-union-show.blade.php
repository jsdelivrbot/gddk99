@extends('layouts.mobile')
@section('content')
    <div class="pet_content_block pet_hd_con">

        <div data-am-widget="list_news" class="am-list-news am-list-news-default"  style="padding: 10px;">
            <!--列表标题-->
            <div class="am-list-news-hd am-cf">
                <!--带更多链接-->
                <h2>我的合伙人 <font color="red">{{ $total or '0' }}</font> 位</h2>
            </div>

            <div class="am-list-news-bd">
                <ul class="am-list">
                    @foreach($member as $list)
                    <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                        <a href="#">
                            <img class="widget-icon am-img-thumbnail am-circle" src="{{ $list['union_user_avatar'] }}" style="width: 50px; height: 50px;">
                            <span class="widget-name" style="padding-left: 10px;">
                                {{ $list['union_user_name'] }}
                                <span style="float: right; margin-top: 10px;">{{ $list['union_user_time'] }}</span>
                            </span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
        <div style="height: 5px;"></div>
    </div>
@endsection