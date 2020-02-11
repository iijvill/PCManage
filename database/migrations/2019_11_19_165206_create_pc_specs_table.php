<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePcSpecsTable extends Migration
{
    /**
     * Run the migrations.
     * 各PCのスペック情報
     * @return void
     */
    public function up()
    {
        Schema::create('pc_specs', function (Blueprint $table) {
            $table->increments('spec_id');
            $table->unsignedTinyInteger('os')->nullable();
            $table->unsignedTinyInteger('cpu')->nullable();
            $table->unsignedInteger('memory')->nullable();
            $table->unsignedTinyInteger('storage_type')->nullable();
            $table->unsignedInteger('storage_capacity')->nullable();
            $table->unsignedTinyInteger('pc_type')->nullable();
            $table->unsignedTinyInteger('pc_maker')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pc_specs');
    }
}
