@extends('layouts.mobile')
@section('content')
    <div><img src="{{ url('build/uploads/sc_poster'.session('wechat_user')[0]['member_id'].'.png') }}" alt="" style="width:100%"></div>
@endsection

@section('script')
    @if(Session::has('message'))
        @if(Session::get('message')==4)
            <script>
                layer.open({
                    type: 1,
                    title: false,
                    skin:'layui-layer-demo',
                    area: ['78%', '18%'],
                    content: '<div class="am-panel am-panel-primary"><div class="am-panel-hd">呵呵，扫码失败！</div><div class="am-panel-bd">自己不能扫码,分享二维码给您客户吧，同时会得到更多的优惠哦！</div></div>'
                });
            </script>
        @elseif(Session::get('message')==5)
            <script>layer.msg('扫码错误！', {icon: 5}); </script>
        @endif
    @endif
@endsection