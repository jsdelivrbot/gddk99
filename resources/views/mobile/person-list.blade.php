@extends('layouts.mobile')
@section('content')

    <div class="pet_grzx">
        <div class="pet_grzx_nr">
            <div class="pet_grzx_ico">
                <img src="{{ url('build/img/bb.jpg') }}" alt="">
            </div>
            <div class="pet_grzx_name">陈占译</div>

            <div class="pet_grzx_num_font">
                <button type="button" class="am-btn am-btn-success am-btn-block"data-am-modal="{target: '#my-alert'}">获取二维码名片</button>

                <div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
                    <div class="am-modal-dialog">
                        <div class="am-modal-bd">
                            <img src="{{ url('build/img/bb.jpg') }}" alt="">
                        </div>
                        <div class="am-modal-footer">
                            <span class="am-modal-btn">确定</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pet_grzx_num_font">
                我坐在水屋下边的平台看着大海，吹着海风，真的是太喜欢了。夜晚有好多小白鲨鱼，好多种鱼。
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
                <li><a href="#"><i class="am-icon-pencil am-icon-fw"></i>完善个人信息</a></li>
            </ul>

        </div>
    </div>

@endsection