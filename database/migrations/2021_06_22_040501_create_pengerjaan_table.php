<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengerjaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengerjaan', function (Blueprint $table) {
            $table->id('no_pengerjaan');
            $table->datetime('waktu_mulai');
            $table->datetime('waktu_selesai');
            $table->integer('progress')->default(0);
            $table->boolean('status_pengerjaan')->default(false);
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengerjaan');
    }
}
