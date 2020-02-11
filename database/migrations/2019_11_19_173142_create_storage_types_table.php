<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorageTypesTable extends Migration
{
    /**
     * Run the migrations.
     *　ストレージタイプ情報テーブル
     * @return void
     */
    public function up()
    {
        Schema::create('storage_types', function (Blueprint $table) {
            $table->tinyIncrements('storage_id');
            $table->string('storage_name',20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('storage_types');
    }
}
