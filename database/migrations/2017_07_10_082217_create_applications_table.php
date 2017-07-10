<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('app_id');
            $table->string('app_name')->nullable()->comment('申请名称');
            $table->string('app_nature')->nullable()->comment('申请性质');
            $table->string('app_username')->nullable()->comment('申请法定代表人');
            $table->string('app_number')->nullable()->comment('申请机构代码');
            $table->text('app_pic_z')->nullable()->comment('申请正面图片');
            $table->text('app_pic_b')->nullable()->comment('申请背面图片');
            $table->string('app_mobile')->nullable()->comment('申请电话');
            $table->tinyInteger('app_type')->default(0)->comment('申请类型');
            $table->tinyInteger('app_status')->default(0)->comment('申请状态');
            $table->integer('member_id')->default(0)->comment('用户会员ID');
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
        Schema::dropIfExists('applications');
    }
}
