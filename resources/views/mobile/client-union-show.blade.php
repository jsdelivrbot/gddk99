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
                    @if(!empty($member[0]['member_id']))
                    @foreach($member as $list)
                    <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                        <a href="#">
                            <img class="widget-icon am-img-thumbnail am-circle" src="{{ $list['wechat_headimgurl'] }}" style="width: 50px; height: 50px;">
                            <span class="widget-name" style="padding-left: 10px;">
                                {{ empty($list['member_surname']) ? $list['wechat_nickname'] : $list['member_surname'] }}
                                <span style="float: right; margin-top: 10px;">{{ $list['created_at'] }}</span>
                            </span>
                        </a>
                    </li>
                    @endforeach
                    @else
                        <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                            <span class="widget-name" style="padding-left: 10px;">没有数据哦</span>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
        <div style="height: 5px;"></div>
    </div>
@endsection