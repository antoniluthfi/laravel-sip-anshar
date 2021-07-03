<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPesananPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pesanan_penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan');
            $table->foreignId('id_barang');
            $table->integer('kuantitas');
            $table->double('total_harga', 15, 0);
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
        Schema::dropIfExists('detail_pesanan_penjualan');
    }
}
