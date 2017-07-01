@extends('layouts.mobile')
@section('title','我的合伙人')
@section('content')
    <div class="pet_content_block pet_hd_con">
        <div data-am-widget="list_news" class="am-list-news am-list-news-default" style="padding: 10px;">
            <!--列表标题-->
            <div class="am-list-news-hd am-cf">
                <!--带更多链接-->
                    <h2>{{ $info[0]['info_name'] }}</h2>
                    <span class="am-list-news-more am-fr">{{ $info_member['updated_at'] }}</span>
            </div>

            <div class="am-list-news-bd">
                <ul class="am-list">
                    <li class="am-g am-list-item-desced">
                        <div style="font-size: 1.3rem">
                            <p style=" margin:0; padding:0 0 8px 0;">申 办 人 ：{{ empty($member['member_surname']) ? $member['wechat_nickname'] : $member['member_surname'] }}</p>
                            <p style=" margin:0; padding:0 0 8px 0;">客户姓名：{{ $info[0]['info_name'] }}</p>
                            <p style=" margin:0; padding:0 0 8px 0;">客户性别：{{ $info[0]['info_sex_text'] }}</p>
                            <p style=" margin:0; padding:0 0 8px 0;">贷款额度：{{ $info[0]['info_quota'] }} 元</p>
                            <p style=" margin:0; padding:0 0 8px 0;">手 机 号：{{ $info[0]['info_mobile'] }}</p>
                            <p style=" margin:0; padding:0 0 8px 0;">所属上级：{{ $info[0]['member_surname'] }}</p>
                            <p style=" margin:0; padding:0 0 8px 0;">录入时间：{{ $info_member['created_at'] }}</p>
                            <p style=" margin:0; padding:0 0 8px 0;">办理状态：<font color="red">申办中...</font></p>
                            <p style=" margin:0; padding:0 0 8px 0;"><a href="#">查看我的下级人员</a></p>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
        <div style="height: 5px;"></div>
    </div>
@endsection