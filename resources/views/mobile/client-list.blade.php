@extends('layouts.mobile')
@section('content')

<div class="pet_mian"  style="background-color: white;">

    <div class="pet_content_block pet_hd_con">
        <div class="pet_hd_con_head"><img src="{{ url('build/img/client-list.jpg') }}" alt=""></div>
    </div>

    <form action="" class="am-form" data-am-validator>
        <fieldset>
            <legend>推荐贷款</legend>
            <div class="am-form-group">
                <label for="doc-vld-name-2">客户姓名：</label>
                <input type="text" id="doc-vld-name-2" minlength="3" placeholder="输入您的姓名" required/>
            </div>

            <div class="am-form-group">
                <label for="doc-select-1">姓名</label>
                <select id="doc-select-1" required>
                    <option value="">选择性别</option>
                    <option value="option1">男</option>
                    <option value="option2">女</option>
                    <option value="option3">保密</option>
                </select>
                <span class="am-form-caret"></span>
            </div>

            <div class="am-form-group">
                <label for="doc-vld-name-2">贷款额度：</label>
                <input type="text" id="doc-vld-name-2" minlength="3" placeholder="输入贷款额度" required/>
            </div>

            <div class="am-form-group">
                <label for="doc-vld-name-2">手机号：</label>
                <input type="text" id="doc-vld-name-2" minlength="3" placeholder="输入联系手机号" required/>
            </div>

            <button class="am-btn am-btn-primary am-btn-block" type="submit">提交申请</button>

        </fieldset>
    </form>

</div>

@endsection