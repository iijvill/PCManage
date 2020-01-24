<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAntivirusInfosTable extends Migration
{
    /**
     * Run the migrations.
     *　ウイルス対策情報
     * @return void
     */
    public function up()
    {
        Schema::create('antivirus_infos', function (Blueprint $table) {
            $table->tinyIncrements('antivirus_id');
            $table->string('antivirus_name',50);
            $table->date('limit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('antivirus_infos');
    }
}
