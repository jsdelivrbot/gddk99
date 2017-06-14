@extends('layouts.admin')
@section('content')

    <div class="tpl-content-wrapper">
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 方案编辑表单
                </div>
            </div>
            <div class="tpl-block ">

                <div class="am-g tpl-amazeui-form">


                    <div class="am-u-sm-12 am-u-md-9">
                        {!! Form::open(['url'=>'admin/plan-insert','files'=>'true','class'=>'am-form am-form-horizontal','data-am-validator']) !!}
                        <fieldset>

                            <div class="am-form-group">
                                <label for="plan_title" class="am-u-sm-3 am-form-label">标题</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="plan_title" name="plan_title" value="" placeholder="输入标题" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="plan_title_a" class="am-u-sm-3 am-form-label">贷款金额</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="plan_title_a" name="plan_title_a" value="" placeholder="输入贷款金额" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="plan_title_b" class="am-u-sm-3 am-form-label">月利率</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="plan_title_b" name="plan_title_b" value="" placeholder="输入月利率" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="plan_title_c" class="am-u-sm-3 am-form-label">还款方式</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="plan_title_c" name="plan_title_c" value="" placeholder="输入还款方式" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="plan_title_d" class="am-u-sm-3 am-form-label">贷款期限</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="plan_title_d" name="plan_title_d" value="" placeholder="输入贷款期限" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="plan_title_e" class="am-u-sm-3 am-form-label">其它1</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="plan_title_e" name="plan_title_e" value="" placeholder="输入其它" >
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="plan_title_f" class="am-u-sm-3 am-form-label">其它2</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="plan_title_f" name="plan_title_f" value="" placeholder="输入其它" >
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="plan_title_g" class="am-u-sm-3 am-form-label">其它3</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="plan_title_g" name="plan_title_g" value="" placeholder="输入其它" >
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="plan_title_h" class="am-u-sm-3 am-form-label">其它4</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="plan_title_h" name="plan_title_h" value="" placeholder="输入其它" >
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="plan_con_a" class="am-u-sm-3 am-form-label">申请条件</label>
                                <div class="am-u-sm-9">
                                    <textarea class="" rows="5" id="plan_con_a" name="plan_con_a" placeholder="输入申请条件" required></textarea>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="plan_con_b" class="am-u-sm-3 am-form-label">所需资料</label>
                                <div class="am-u-sm-9">
                                    <textarea class="" rows="5" id="plan_con_b" name="plan_con_b" placeholder="输入所需资料" required></textarea>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="plan_con_c" class="am-u-sm-3 am-form-label">其它介绍</label>
                                <div class="am-u-sm-9">
                                    <textarea class="" rows="5" id="plan_con_c" name="plan_con_c" placeholder="输入其它介绍"></textarea>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="plan_type_a" class="am-u-sm-3 am-form-label">方案类型</label>
                                <div class="am-u-sm-9">
                                    <select id="plan_type_a" name="plan_type_a" required>
                                        <option value="">请选择对应所属类型</option>
                                        @foreach($planType as $val)
                                        <option value="{{ $val['id'] }}">{{ $val['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <span class="am-form-caret"></span>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="submit" class="am-btn am-btn-primary">保存</button> <button type="button" class="am-btn am-btn-success" onclick="javascript:window.location='{{ url('admin/plan-list') }}'">返回列表</button>
                                </div>
                            </div>
                        </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
