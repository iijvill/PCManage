<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyPcspecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pc_specs', function (Blueprint $table) {
            $table->foreign('os')->references('os_id')->on('os_infos')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('cpu')->references('cpu_id')->on('cpu_infos')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('storage_type')->references('storage_id')->on('storage_types')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('pc_type')->references('pctype_id')->on('pctype_infos')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('pc_maker')->references('pcmaker_id')->on('pcmaker_infos')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pc_specs', function (Blueprint $table) {
            $table->dropForeign('pc_specs_os_foreign');
            $table->dropForeign('pc_specs_cpu_foreign');
            $table->dropForeign('pc_specs_storage_type_foreign');
            $table->dropForeign('pc_specs_pc_type_foreign');
            $table->dropForeign('pc_specs_pc_maker_foreign');
        });
    }
}
