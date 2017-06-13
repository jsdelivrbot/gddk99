@extends('layouts.mobile')
@section('content')

    <div class="pet_grzx">
        <div class="pet_grzx_nr">
            <div class="pet_grzx_ico">
                <img src="{{ url('build/uploads/'.$member[0]['member_avatar']) ? $member[0]['wechat_headimgurl'] : url('build/uploads/'.$member[0]['member_avatar'])}}" alt="">
            </div>
            <div class="pet_grzx_name">{{ $member[0]['member_name'] ? $member[0]['member_name']:$member[0]['wechat_nickname'] }}</div>

            <div class="pet_grzx_num_font">
                <a href="{{ url('/mobile/poster-list') }}" class="am-btn am-btn-success am-btn-block"data-am-modal="{target: '#my-alert'}">获取二维码名片</a>
                {{--<button type="button" class="am-btn am-btn-success am-btn-block"data-am-modal="{target: '#my-alert'}">获取二维码名片</button>--}}

                {{--<div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
                    <div class="am-modal-dialog">
                        <div class="am-modal-bd">
                            <img src="{{ asset('build/uploads/qrcode'.$member[0]['member_id'] .'.png') }}" alt="" style="width: 170px; height:170px;">
                        </div>
                        <div class="am-modal-footer">
                            <span class="am-modal-btn">确定</span>
                        </div>
                    </div>
                </div>--}}
            </div>

            <div class="pet_grzx_num_font">
                {{ $member[0]['member_content'] or '这个家伙很懒，什么都没有留下' }}
            </div>
            <div class="pet_grzx_num">
                <span>653<i>喜欢</i></span>
                <span>236<i>关注</i></span>
                <span>36<i>文章</i></span>
            </div>

            <ul class="am-list am-list-border">
                <li>
                    <a href="#"><i class="am-icon-home am-icon-fw"></i>
                        客户列表
                    </a>
                </li>
                <li>
                    <a href="#"> <i class="am-icon-book am-icon-fw"></i>
                        我的佣金
                    </a>
                </li>
                <li><a href="{{ url('/mobile/person-edit',['member_id'=>$member[0]['member_id']]) }}"><i class="am-icon-pencil am-icon-fw"></i>完善个人信息</a></li>
            </ul>

        </div>
    </div>

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
        @endif
    @endif
@endsection