<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerimaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerimaan', function (Blueprint $table) {
            $table->id('no_service');
            $table->foreignId('no_pengerjaan');
            $table->string('jenis_penerimaan');
            $table->foreignId('id_customer');
            $table->foreignId('id_cabang');
            $table->foreignId('id_barang');
            $table->string('kondisi_barang');
            $table->string('problem');
            $table->string('request');
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
        Schema::dropIfExists('penerimaan');
    }
}
