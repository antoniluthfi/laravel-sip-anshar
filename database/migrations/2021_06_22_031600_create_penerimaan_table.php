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
            $table->string('no_service');
            $table->foreignId('no_pengerjaan');
            $table->string('jenis_penerimaan');
            $table->foreignId('id_admin');
            $table->foreignId('id_customer');
            $table->foreignId('id_cabang');
            $table->foreignId('id_barang_jasa');
            $table->foreignId('id_barang');
            $table->string('sn')->nullable();
            $table->string('kondisi_barang');
            $table->string('problem');
            $table->string('request');
            $table->boolean('data_penting')->default(0);
            $table->string('estimasi');
            $table->string('kelengkapan')->nullable();
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
