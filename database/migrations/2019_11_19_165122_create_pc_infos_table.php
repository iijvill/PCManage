<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePcInfosTable extends Migration
{
    /**
     * Run the migrations.
     * PC情報テーブル
     * @return void
     */
    public function up()
    {
        Schema::create('pc_infos', function (Blueprint $table) {
            // $table->engine = 'InnoDB';
            $table->increments('id')->unique();
            $table->string('pc_name', 50);
            $table->unsignedInteger('pc_userid')->nullable();
            $table->unsignedTinyInteger('department')->nullable();
            $table->string('serial_number', 50)->nullable();
            $table->string('pc_url',256);
            $table->string('office_license',50)->nullable();
            $table->text('memo')->nullable();
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
        Schema::dropIfExists('pc_infos');
    }
}
