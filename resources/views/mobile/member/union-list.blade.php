@extends('layouts.mobile')
@section('content')

    <div class="am-list-news-hd am-cf" style="padding-left: 10px;">
        <h2>我的推客列表 <font color="red">{{ $total or '0' }}</font> 位</h2>
    </div>

    <div class="pet_article_like" style="margin-top: 0;">
        <div class="pet_content_main pet_article_like_delete">
            <div data-am-widget="list_news" class="am-list-news am-list-news-default am-no-layout">
                <div class="am-list-news-bd">
                    <ul class="am-list">

                        @foreach($union as $list)
                        <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-right pet_hd_list">
                            <a href="{{ url('/mobile/member/union-list-details',['member_id'=>$list['member_id']]) }}" class="pet_hd_block">
                            <div class="pet_hd_block_title">{{ $list['member_surname'] }}</div>
                            <div class="pet_hd_block_map">手机号码：{{ $list['member_mobile'] }}</div>
                            <div class="pet_hd_block_map">申请时间：{{ $list['created_at'] }} </div>
                            </a>
                            @if($list['member_status']==20)
                                <input type="hidden" id="member_status" name="member_status" value="{{ \App\Member::MEMBER_STATUS_THREE }}">
                                <input type="hidden" id="member_type" name="member_type" value="{{ \App\Member::MEMBER_TYPE_TWO }}">
                                <div class="pet_hd_block_tag"><span onclick="Check(this,{{ $list['member_id'] }})">未审核</span> <span class="hd_tag_jh" onclick="cancelCheck(this,{{ $list['member_id'] }})">取消审核</span></div>
                                <input type="hidden" id="cancel_status" name="cancel_status" value="{{ \App\Member::MEMBER_STATUS_ONE }}">
                                <input type="hidden" id="cancel_member_parent_id" name="cancel_member_parent_id" value="{{ \App\Member::MEMBER_PUBLIC }}">
                            @elseif($list['member_status']==30)
                                <div class="pet_hd_block_tag"><span class="hd_tag_js">已审核</span> <span style="background-color:#429842">查看客户</span></div>
                            @endif
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function Check(obj,id) {
            var member_status = $("#member_status").val();
            var member_type = $("#member_type").val();
            var member_id = $("#member_id").val();
            $.post("{{url('/mobile/member/member-check-status')}}",{'_token':'{{csrf_token()}}','member_status':member_status,'member_type':member_type,'member_id':id},function(){
                location.href = location.href;
            });
        }
        function cancelCheck(obj,id) {
            var member_status = $("#cancel_status").val();
            var member_parent_id = $("#cancel_member_parent_id").val();
            $.post("{{url('/mobile/member/member-check-status')}}",{'_token':'{{csrf_token()}}','member_status':member_status,'member_parent_id':member_parent_id,'member_id':id},function(){
                location.href = location.href;
            });
        }
    </script>
@endsection