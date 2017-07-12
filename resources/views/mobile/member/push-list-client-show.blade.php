@extends('layouts.mobile')
@section('content')
    <div class="pet_content_block pet_hd_con">

        <div data-am-widget="list_news" class="am-list-news am-list-news-default"  style="padding: 10px;">
            <!--列表标题-->
            <div class="am-list-news-hd am-cf">
                <!--带更多链接-->
                <h2>推客名下所有客户<font color="red">{{ $total or '0' }}</font> 位</h2>
            </div>

            <div class="am-list-news-bd">
                <ul class="am-list">
                        @foreach($info as $list)
                        <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                            <span class="widget-name" style="padding-left: 10px;">
                                {{ $list['info_name'] }}
                                <span style="float: right; margin-top: 10px;">{{ $list['created_at'] }}</span>
                            </span>
                        </li>
                        @endforeach
                </ul>
            </div>

        </div>
        <div style="height: 5px;"></div>
    </div>
@endsection