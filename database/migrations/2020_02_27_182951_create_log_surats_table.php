<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_surats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_sm')->index();
            $table->unsignedInteger('id_create')->index();
            $table->string('status')->nullable();
            $table->string('read')->nullable();
            $table->unsignedInteger('disp_ke')->index()->nullable();
            $table->string('disp_note')->nullable();
            $table->dateTime('tgl_disp')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        Schema::table('log_surats', function (Blueprint $table) {
            $table->foreign('id_sm')
            ->references('id')
            ->on('suratmasuks')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_create')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('disp_ke')
            ->references('id')
            ->on('roles')
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
        Schema::dropIfExists('log_surats');
    }
}
