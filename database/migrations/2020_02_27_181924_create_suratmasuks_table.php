<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratmasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suratmasuks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_kns')->index();
            $table->string('no_surat');
            $table->string('asal');
            $table->string('perihal');
            $table->date('tgl_surat');
            $table->date('tgl_diterima');
            $table->string('file');
            $table->string('keterangan');
            $table->string('status');
            $table->integer('notif');
            $table->boolean('read');
            $table->unsignedInteger('id_create')->index();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suratmasuks');
    }
}
