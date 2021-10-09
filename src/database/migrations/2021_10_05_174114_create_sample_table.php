<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 部署
        Schema::create('depts', function (Blueprint $table) {
            $table->increments('id')->comment('部署ID');
            $table->string('dept_name')->comment('部署名');
            $table->timestamps();
            $table->softDeletes();
        });

        // 従業員
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id')->comment('従業員ID');
            $table->integer('dept_id')->comment('部署ID');
            $table->string('name')->comment('名前');
            $table->string('address')->comment('住所');
            $table->string('email')->comment('メールアドレス');
            $table->integer('old')->comment('年齢');
            $table->string('tel')->comment('電話番号');
            $table->timestamps();
            $table->softDeletes();
        });

        // 年収
        Schema::create('salary', function (Blueprint $table) {
            $table->increments('id')->comment('とりあえずID');
            $table->integer('employee_id')->comment('従業員ID');
            $table->integer('year')->comment('年度');
            $table->string('amount')->comment('年収');
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
        Schema::dropIfExists('depts');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('salary');
    }
}
