<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->increments('info_id')->comment('信息ID');
            $table->string('info_name')->nullable()->comment('姓名');
            $table->string('info_sex')->nullable()->comment('性别');
            $table->string('info_mobile')->nullable()->comment('手机');
            $table->string('info_quota')->nullable()->comment('信息额度');
            $table->integer('info_unit')->default('0')->comment('单位');
            $table->string('info_remark')->nullable()->comment('备注');
            $table->integer('member_id')->default('0')->comment('会员ID');
            $table->integer('info_invite')->default('0')->comment('合伙人邀请ID');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infos');
    }
}
