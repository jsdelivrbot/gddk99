@extends('layouts.admin')
@section('content')

    <div class="tpl-content-wrapper">
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 推客列表
                </div>
                <div class="tpl-portlet-input tpl-fz-ml">
                    <div class="portlet-input input-small input-inline">
                        <div class="input-icon right">
                            <i class="am-icon-search"></i>
                            <input type="text" class="form-control form-control-solid" placeholder="搜索..."> </div>
                    </div>
                </div>
            </div>

            <div class="tpl-block">
                <div class="am-g">
                    <div class="am-u-sm-12 am-u-md-6">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                                <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-3">
                        <div class="am-form-group">
                            <select data-am-selected="{btnSize: 'sm'}">
                                <option value="option1">所有类别</option>
                                <option value="option2">IT业界</option>
                                <option value="option3">数码产品</option>
                                <option value="option3">笔记本电脑</option>
                                <option value="option3">平板电脑</option>
                                <option value="option3">只能手机</option>
                                <option value="option3">超极本</option>
                            </select>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-3">
                        <div class="am-input-group am-input-group-sm">
                            <input type="text" class="am-form-field">
                            <span class="am-input-group-btn">
            <button class="am-btn  am-btn-default am-btn-success tpl-am-btn-success am-icon-search" type="button"></button>
          </span>
                        </div>
                    </div>
                </div>
                <div class="am-g">
                    <div class="am-u-sm-12">
                        <form class="am-form">
                            <table class="am-table am-table-striped am-table-hover table-main">
                                <thead>
                                <tr>
                                    <th class="table-check"><input type="checkbox" class="tpl-table-fz-check"></th>
                                    <th class="table-id">ID</th>
                                    <th class="table-title">推客头像</th>
                                    <th class="table-title">推客姓名</th>
                                    <th class="table-title">推客手机号</th>
                                    <th class="table-type">合伙人姓名</th>
                                    <th class="table-type">合伙人手机</th>
                                    <th class="table-type">审核状态</th>
                                    <th class="table-date am-hide-sm-only">申请时间</th>
                                    <th class="table-set">操作</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach( $member as $list)
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>{{ $list['push_id'] }}</td>
                                    <td><img src="{{ $list['push_avatar'] }}" alt="" width="50" height="30"></td>
                                    <td>{{ $list['push_name'] }}</td>
                                    <td class="am-hide-sm-only">{{ $list['push_mobile'] }}</td>
                                    <td class="am-hide-sm-only">{{ $list['union_name'] }}</td>
                                    <td class="am-hide-sm-only">{{ $list['union_mobile'] }}</td>
                                    <td class="am-hide-sm-only">
                                        @if($list['push_status']==\App\Member::MEMBER_STATUS_TWO)
                                            <font color="red">尚未初审</font>
                                        @elseif($list['push_status']==\App\Member::MEMBER_STATUS_THREE)
                                            <input type="hidden" id="push_status" name="push_status" value="40">
                                            <input type="hidden" id="push_type" name="push_type" value="2">
                                            <span class="am-btn am-btn-warning am-btn-xs am-radius" onclick="Check(this,{{ $list['push_id'] }})"> 初审通过</span>
                                        @elseif($list['push_status']==\App\Member::MEMBER_STATUS_FOUR)
                                            审核完成
                                        @endif
                                    </td>
                                    <td>{{ $list['push_time'] }}</td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 详情</button>
                                                <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 删除</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="am-cf">

                                <div class="am-fr">
                                    <ul class="am-pagination tpl-pagination">
                                        <li class="am-disabled"><a href="#">«</a></li>
                                        <li class="am-active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#">»</a></li>
                                    </ul>
                                </div>
                            </div>
                            <hr>

                        </form>
                    </div>

                </div>
            </div>
            <div class="tpl-alert"></div>
        </div>

    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function Check(obj,id) {
            var member_status = $("#push_status").val();
            var member_type = $("#push_type").val();
            $.post("{{url('/admin/member/member-check-status')}}",{'_token':'{{csrf_token()}}','member_status':member_status,'member_type':member_type,'member_id':id},function(){
                location.href = location.href;
            });
        }
    </script>
@endsection
