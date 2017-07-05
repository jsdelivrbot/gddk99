@extends('layouts.mobile')
@section('title','个人中心')
@section('content')

    <div class="pet_grzx">
        <div class="pet_grzx_nr">
            <div class="pet_grzx_ico">
                <img src="{{ $groupData['avatar']  }}" alt="">
            </div>
            <div class="pet_grzx_name">{{ $groupData['name'] }}</div>

            <div class="pet_grzx_num_font">
                <a href="{{ url('/mobile/member/poster-list') }}" class="am-btn am-btn-warning am-btn-block">个人专属二维码</a>
            </div>

            <div class="pet_grzx_num_font">
               您当前是：{{ $groupData['type'] }}
            </div>
            <div class="pet_grzx_num">
                <span>653<i>喜欢</i></span>
                <span>236<i>关注</i></span>
                <span>36<i>文章</i></span>
            </div>

            <div class="am-popup-bd" style="padding: 0 0 0 0;">
                <div class="am-list-news-bd">
                    <ul class="am-list">
                        <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                            <span class="widget-name">开启扫码自动审核功能
                                <span style="float: right;">
                                    <input type="hidden" id="member_id" name="member_id" value="{{ $member['member_id'] }}">
                                    @if($member['member_check']==0)
                                        <input type="hidden" id="member_check" name="member_check" value="1">
                                        <button type="button" class="am-btn am-btn-default am-round" onclick="Check(this)" >未开启</button>
                                    @else
                                        <input type="hidden" id="member_check" name="member_check" value="0">
                                        <button type="button" class="am-btn am-btn-success am-round" onclick="Check(this)" >已开启</button>
                                    @endif
                                </span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="am-list am-list-border">
                <li>
                    <a href="{{ url('/mobile/client/client-union-show',['member_id'=>$member['member_id']]) }}"><i class="am-icon-user-plus am-icon-fw"></i>
                        我的合伙人
                    </a>
                </li>
                <li>
                    <a href="{{ url('/mobile/member/union-list',['member_id'=>$member['member_id']]) }}"><i class="am-icon-user am-icon-fw"></i>
                        我的推客
                    </a>
                </li>
                <li>
                    <a href="#"><i class="am-icon-briefcase am-icon-fw"></i>
                        我的客户
                    </a>
                </li>
                <li>
                    <a href="#"> <i class="am-icon-book am-icon-fw"></i>
                        我的佣金
                    </a>
                </li>
                <li><a href="{{ url('/mobile/member/person-edit',['member_id'=>$member['member_id']]) }}"><i class="am-icon-pencil am-icon-fw"></i>完善个人信息</a></li>
            </ul>
        </div>
    </div>
    @include('include.mobile.guide')
@endsection

@section('script')
    @if(Session::has('message'))
        @if(Session::get('message')==1)
            <script>
                layer.open({
                    type: 1,
                    title: false,
                    skin:'layui-layer-demo',
                    area: ['78%', '18%'],
                    content: '<div class="am-panel am-panel-primary"><div class="am-panel-hd">恭喜，关联成功！</div><div class="am-panel-bd">我们一起共赢</div></div>'
                });
            </script>
        @elseif(Session::get('message')==0)
            <script>layer.msg('关联失败！', {icon: 5}); </script>
        @elseif(Session::get('message')==3)
            <script>layer.msg('信息完善成功！', {icon: 6}); </script>
        @elseif(Session::get('message')==2)
            <script>layer.msg('信息完善失败！', {icon: 5}); </script>
        @elseif(Session::get('message')==4)
            <script>
                layer.open({
                    type: 1,
                    title: false,
                    skin:'layui-layer-demo',
                    area: ['78%', '18%'],
                    content: '<div class="am-panel am-panel-primary"><div class="am-panel-hd">呵呵，关联失败！</div><div class="am-panel-bd">自己不能成为自己的经纪人，扫码失败！</div></div>'
                });
            </script>
        @elseif(Session::get('message')==5)
            <script>layer.msg('扫码错误！', {icon: 5}); </script>
        @endif
    @endif
    <script type="text/javascript">
        //发送请求
        function Check() {
            var member_check = $("#member_check").val();
            var member_id = $("#member_id").val();
            $.post("{{url('/mobile/member/member-check')}}",{'_token':'{{csrf_token()}}','member_check':member_check,'member_id':member_id},function(){
              location.href = location.href;
            });
        }
    </script>
@endsection