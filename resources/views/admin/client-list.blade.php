@extends('layouts.admin')
@section('content')

    <div class="tpl-content-wrapper">
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 客户列表
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
                                    <th class="table-title">客户姓名</th>
                                    <th class="table-title">性别</th>
                                    <th class="table-title">手机号</th>
                                    <th class="table-type">贷款额度</th>
                                    <th class="table-type">推客姓名</th>
                                    <th class="table-type">渠道</th>
                                    <th class="table-date am-hide-sm-only">申请时间</th>
                                    <th class="table-set">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($client_info as $list)
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>{{ $list['info_id'] }}</td>
                                    <td>{{ $list['info_name'] }}</td>
                                    <td class="am-hide-sm-only">{{ $list['info_sex_text'] }}</td>
                                    <td class="am-hide-sm-only">{{ $list['info_mobile'] }}</td>
                                    <td class="am-hide-sm-only">{{ $list['info_quota'] }} 万元</td>
                                    <td class="am-hide-sm-only">{{ $list['member_surname'] }}</td>
                                    <td class="am-hide-sm-only"> @if(substr($list['in_id'],0,2)==10) 来自扫码推客 @else 来自立即申请 @endif</td>
                                    <td class="am-hide-sm-only">{{ $list['created_at'] }}</td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="{{ url('admin/client/client-list-edit',['info_id'=>$list['info_id']]) }}" class="am-btn am-btn-default am-btn-xs am-text-secondary">
                                                    <span class="am-icon-pencil-square-o"></span> 编辑
                                                </a>
                                                <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only">
                                                    <span class="am-icon-copy"></span> 详情
                                                </button>
                                                <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only">
                                                    <span class="am-icon-trash-o"></span> 删除
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="am-cf">
                                <div class="am-fr">
                                    {{ $client_info->links() }}
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
    @if(Session::has('message'))
        @if(Session::get('message')==1)
            <script>layer.msg('数据处理成功！', {icon: 6}); </script>
        @elseif(Session::get('message')==0)
            <script>layer.msg('数据处理失败！', {icon: 5}); </script>
        @endif
    @endif
@endsection