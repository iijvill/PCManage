<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeInfosTable extends Migration
{
    /**
     * Run the migrations.
     * 社員テーブル
     * @return void
     */
    public function up()
    {
        Schema::create('employee_infos', function (Blueprint $table) {
            $table->increments('employee_id')->unique();
            $table->string('employee_name', 100);
            $table->string('email', 200)->nullable();
            $table->unsignedTinyInteger('authority')->default(0);
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
        Schema::dropIfExists('employee_infos');
    }
}
