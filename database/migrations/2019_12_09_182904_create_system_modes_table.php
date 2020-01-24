<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_modes', function (Blueprint $table) {
            $table->smallIncrements('systemmode_id');
            $table->string('systemmode_name',50);
            $table->tinyInteger('run')->unsigned()->default(0);
            $table->date('start_date')->nullable();
            $table->date('stop_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_modes');
    }
}
