<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('member_id')->comment('会员ID');
            $table->string('member_name')->nullable()->comment('会员名称');
            $table->string('member_avatar')->nullable()->comment('会员头像');
            $table->string('password')->nullable()->comment('会员密码');
            $table->string('member_surname')->nullable()->comment('姓名');
            $table->string('member_content')->nullable()->comment('个人介绍');
            $table->string('member_age')->nullable()->comment('年龄');
            $table->integer('member_sex')->default('0')->comment('性别');
            $table->string('member_card')->nullable()->comment('身份证');
            $table->string('member_tel')->nullable()->comment('电话');
            $table->string('member_bank_card')->nullable()->comment('银行卡号');
            $table->tinyInteger('member_card_type')->default('0')->comment('卡号类型');
            $table->string('member_mobile')->nullable()->comment('手机');
            $table->string('member_add')->nullable()->comment('地址');
            $table->string('member_province')->nullable()->comment('省');
            $table->string('member_city')->nullable()->comment('城市');
            $table->tinyInteger('member_type')->default('0')->comment('会员类型');
            $table->tinyInteger('member_status')->default('10')->comment('会员状态：10表示正常');
            $table->integer('member_parent_id')->default('0')->comment('会员父级ID');
            $table->tinyInteger('is_member')->default(0)->comment('是否是登录：1是登录，0是没有登录');

            //微信表
            $table->string('wechat_openid')->unique()->comment('微信ID');
            $table->string('wechat_nickname')->nullable()->comment('微信昵称');
            $table->text('wechat_headimgurl')->nullable()->comment('微信头像');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member');
    }
}
