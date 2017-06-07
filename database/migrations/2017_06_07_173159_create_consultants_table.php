<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('con_name')->nullable()->comment('顾问姓名');
            $table->string('con_pic')->nullable()->comment('顾问照片');
            $table->string('con_person')->nullable()->comment('顾问咨询人数');
            $table->string('con_pf')->nullable()->comment('顾问评分');
            $table->string('con_tel')->nullable()->comment('顾问电话');
            $table->longText('con_content')->nullable()->comment('顾问内容');
            $table->longText('con_add')->nullable()->comment('顾问地址');
            $table->tinyInteger('con_type')->default('0')->comment('顾问类型：0表示无,1表示顾问列表，2表示店面列表');
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
        Schema::dropIfExists('consultants');
    }
}
