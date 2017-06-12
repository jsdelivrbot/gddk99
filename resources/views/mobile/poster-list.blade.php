@extends('layouts.mobile')
@section('content')
    <div><img src="{{ url('build/uploads/sc'.session('wechat_user')[0]['member_id'].'.png') }}" alt="" style="width:100%"></div>
@endsection