@extends('layouts.mobile')
@section('content')
<div class="pet_content_block pet_hd_con">
    <div data-am-widget="list_news" class="am-list-news am-list-news-default" style="padding: 10px;">
        <!--列表标题-->
        <div class="am-list-news-hd am-cf">
            <!--带更多链接-->
                <h2>我的合伙人</h2>
        </div>

        <div class="am-list-news-bd">
            <ul class="am-list">
                @if(!empty($info[0]['info_id']))
                @foreach($info as $list)
                <li class="am-g am-list-item-dated">
                    <a href="{{ url('/mobile/client-union-details',['info_id'=>$list['info_id'],'member_id'=>$list['member_id']]) }}" class="am-list-item-hd ">{{ $list['info_name'] }}</a>
                    <span class="am-list-date">{{ $list['updated_at'] }}</span>
                </li>
                @endforeach
                @else
                    <li class="am-g am-list-item-dated">
                        <span style="font-size: 1.3rem;">暂无数据</span>
                    </li>
                @endif
            </ul>
        </div>

    </div>
    <div style="height: 5px;"></div>
</div>
@endsection