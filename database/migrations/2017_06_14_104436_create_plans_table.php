<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plan_title')->nullable()->comment('方案标题');

            $table->string('plan_title_a')->nullable()->comment('方案标题1');
            $table->string('plan_title_b')->nullable()->comment('方案标题2');
            $table->string('plan_title_c')->nullable()->comment('方案标题3');
            $table->string('plan_title_d')->nullable()->comment('方案标题4');
            $table->string('plan_title_e')->nullable()->comment('方案标题5');
            $table->string('plan_title_f')->nullable()->comment('方案标题6');
            $table->string('plan_title_g')->nullable()->comment('方案标题7');
            $table->string('plan_title_h')->nullable()->comment('方案标题8');

            $table->longText('plan_con_a')->nullable()->comment('方案内容1');
            $table->longText('plan_con_b')->nullable()->comment('方案内容2');
            $table->longText('plan_con_c')->nullable()->comment('方案内容3');

            $table->integer('plan_type_a')->default(0)->comment('方案类型1');
            $table->integer('plan_type_b')->default(0)->comment('方案类型2');
            $table->integer('plan_type_c')->default(0)->comment('方案类型3');
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
        Schema::dropIfExists('plans');
    }
}
