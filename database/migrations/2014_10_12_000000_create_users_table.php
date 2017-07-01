<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name')->comment('用户名');
            $table->string('user_mobile')->unique()->comment('用户手机');
            $table->string('password');
            $table->tinyInteger('is_admin')->default(0)->comment('是否是管理员：1是管理员，0是不管理员');
            $table->tinyInteger('status')->default(1)->comment('状态：1有效，0无效');
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
        Schema::dropIfExists('users');
    }
}
