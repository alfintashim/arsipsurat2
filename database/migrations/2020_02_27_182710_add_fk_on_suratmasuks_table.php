<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkOnSuratmasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suratmasuks', function (Blueprint $table) {
            $table->foreign('id_kns')
            ->references('id')
            ->on('kode_nomor_surats')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_create')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suratmasuks', function (Blueprint $table) {
            //
        });
    }
}
