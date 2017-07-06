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
                            <div class="pet_hd_block_title">{{ $union['member_surname'] }}</div>
                            <div class="pet_hd_block_map">证件号码：362330198406391708</div>
                            <div class="pet_hd_block_map">手机号码：{{ $union['member_mobile'] }}</div>
                            <div class="pet_hd_block_map">申请时间：{{ $union['created_at'] }} </div>
                        </li>

                        <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-right pet_hd_list">
                            <div class="pet_hd_block_map">证件照片</div>
                            <div class="pet_hd_con_head"><img src="http://img0.imgtn.bdimg.com/it/u=880594281,3535686199&fm=26&gp=0.jpg" alt="" width="100%"></div>
                            <div class="pet_hd_con_head"><img src="http://img0.imgtn.bdimg.com/it/u=880594281,3535686199&fm=26&gp=0.jpg" alt="" width="100%"></div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection