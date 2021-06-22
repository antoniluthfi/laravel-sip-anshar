<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan');
            $table->foreignId('user_id');
            $table->foreignId('id_barang');
            $table->integer('kuantitas');
            $table->string('satuan');
            $table->string('diskon')->nullable();
            $table->double('total_harga', 15, 0);
            $table->foreignId('id_penjual');
            $table->foreignId('id_syarat_pembayaran');
            $table->string('stok_cabang');
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('pesanan_penjualan');
    }
}
