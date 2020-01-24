<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentInfosTable extends Migration
{
    /**
     * Run the migrations.
     * 部署情報テーブル
     * @return void
     */
    public function up()
    {
        Schema::create('department_infos', function (Blueprint $table) {
            $table->tinyIncrements('department_id')->unique();
            $table->string('department_name',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department_infos');
    }
}
