@extends('layouts.mobile')
@section('content')
    <div class="am-list-news-hd am-cf" style="padding-left: 10px;">
        <h2>我的客户列表 <font color="red">{{ $total or '0' }}</font> 位</h2>
    </div>

    <div class="pet_article_like" style="margin-top: 0;">
        <div class="pet_content_main pet_article_like_delete">
            <div data-am-widget="list_news" class="am-list-news am-list-news-default am-no-layout">
                <div class="am-list-news-bd">
                    <ul class="am-list">
                        @foreach($info as $list)
                        <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-right pet_hd_list">
                            <a href="javascript:void(0);" class="pet_hd_block">
                                <div class="pet_hd_block_title">{{ $list['info_name'] }} {{ $list['info_mobile'] }}</div>
                                <div class="pet_hd_block_map">贷款额度：{{ $list['info_quota'] }} 万元</div>
                                <div class="pet_hd_block_map">申请渠道：@if(substr($list['member_id'],0,2)==10) 来自扫码推客 @else 来自立即申请 @endif</div>
                                <div class="pet_hd_block_map">申请时间：{{ $list['created_at'] }}</div>
                                <div class="pet_hd_block_map">客户状态：@if($list['info_status']==0) <font color="red">申办中...</font> @else <font color="red">已办结...</font> @endif</div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection