@extends('layouts.mobile')
@section('content')

    <div class="am-list-news-hd am-cf" style="padding-left: 10px;">
        <h2>我的推客详情</h2>
    </div>

    <div class="pet_article_like" style="margin-top: 0;">
        <div class="pet_content_main pet_article_like_delete">
            <div data-am-widget="list_news" class="am-list-news am-list-news-default am-no-layout">
                <div class="am-list-news-bd">
                    <ul class="am-list">

                        <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-right pet_hd_list">
                            <div class="pet_hd_block_title">{{ $app['app_name'] }}</div>
                            <div class="pet_hd_block_map">申请人：{{ $union['member_surname'] }} </div>
                            <div class="pet_hd_block_map">申请类型：@if($app['app_type']==1) <font color="red">企业</font> @else <font color="red">个体</font> @endif </div>
                            <div class="pet_hd_block_map">证件号码：@if(empty($app['app_number'])) {{ $union['member_card'] }} @else {{ $app['app_number'] }} @endif</div>
                            <div class="pet_hd_block_map">手机号码：{{ $app['app_mobile'] }}</div>
                            <div class="pet_hd_block_map">申请时间：{{ $app['created_at'] }} </div>
                        </li>

                        <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-right pet_hd_list">
                            <div class="pet_hd_block_map">证件照片</div>
                            <div class="pet_hd_con_head"><img src="{{ url('/build/uploads/'.$app['app_pic_z']) }}" alt="" width="100%"></div>
                            @if($app['app_pic_z']=='')
                            <div class="pet_hd_con_head"><img src="{{ url('/build/uploads/'.$app['app_pic_b']) }}" alt="" width="100%"></div>
                            @endif
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection