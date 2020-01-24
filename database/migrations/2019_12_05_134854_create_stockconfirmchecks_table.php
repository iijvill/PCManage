<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockconfirmchecksTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('stockconfirmchecks', function (Blueprint $table) {
            $table->increments('stockconfirm_id');
            $table->tinyInteger('is_checked')->unsigned()->default(0);
            $table->date('access_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stockconfirmchecks');
    }
}
