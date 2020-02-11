<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyPcinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pc_infos', function (Blueprint $table) {
            $table->foreign('department')->references('department_id')->on('department_infos')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('pc_userid')->references('employee_id')->on('employee_infos')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pc_infos', function (Blueprint $table) {
            $table->dropForeign('pc_infos_pc_userid_foreign');
            $table->dropForeign('pc_infos_department_foreign');
        });
    }
}
