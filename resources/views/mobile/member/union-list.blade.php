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
                        @if(!empty($total))
                        @foreach($union as $list)
                        <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-right pet_hd_list">
                            <a href="{{ url('/mobile/member/union-list-details',['member_id'=>$list['member_id']]) }}" class="pet_hd_block">
                            <div class="pet_hd_block_title">{{ $list['app_name'] }}</div>
                            <div class="pet_hd_block_map">手机号码：{{ $list['app_mobile'] }}</div>
                            <div class="pet_hd_block_map">申请类型：@if($list['app_type']==1) <font color="red">企业</font> @else <font color="red">个体</font> @endif </div>
                            <div class="pet_hd_block_map">申请时间：{{ $list['created_at'] }} </div>
                            </a>
                            @if($list['member_status']==\App\Member::MEMBER_STATUS_TWO)
                                <input type="hidden" id="member_status" name="member_status" value="{{ \App\Member::MEMBER_STATUS_THREE }}">
                                <div class="pet_hd_block_tag"><span onclick="Check(this,{{ $list['member_id'] }})">未初审</span> <span class="hd_tag_jh" onclick="cancelCheck(this,{{ $list['member_id'] }})">取消初审</span></div>
                                <input type="hidden" id="cancel_status" name="cancel_status" value="{{ \App\Member::MEMBER_STATUS_ONE }}">
                                <input type="hidden" id="cancel_member_parent_id" name="cancel_member_parent_id" value="{{ \App\Member::MEMBER_PUBLIC }}">
                            @elseif($list['member_status']==\App\Member::MEMBER_STATUS_THREE)
                                <div class="pet_hd_block_map"><font color="red">请等待总部审核...</font></div>
                                <div class="pet_hd_block_tag"><span class="hd_tag_js">初审通过</span></div>
                            @elseif($list['member_status']==\App\Member::MEMBER_STATUS_FOUR)
                                <div class="pet_hd_block_tag"><span class="hd_tag_js">审核完成</span> <span style="background-color:#429842">查看客户</span></div>
                            @endif
                        </li>
                        @endforeach
                            @else
                            <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-right pet_hd_list">
                                <div class="pet_hd_block_map">没有推客数据哦</div>
                            </li>
                        @endif

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
            $.post("{{url('/mobile/member/member-check-status')}}",{'_token':'{{csrf_token()}}','member_status':member_status,'member_id':id},function(){
                location.href = location.href;
            });
        }
        function cancelCheck(obj,id) {
            var member_status = $("#cancel_status").val();
            var member_parent_id = $("#cancel_member_parent_id").val();
            $.post("{{url('/mobile/member/member-cancel-status')}}",{'_token':'{{csrf_token()}}','member_status':member_status,'member_parent_id':member_parent_id,'member_id':id},function(){
                location.href = location.href;
            });
        }
    </script>
@endsection