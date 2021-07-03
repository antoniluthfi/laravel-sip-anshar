<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakturPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faktur_penjualan', function (Blueprint $table) {
            $table->string('no_faktur');
            $table->string('kode_pesanan');
            $table->foreignId('id_marketing');
            $table->foreignId('user_id');
            $table->foreignId('id_bank')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->integer('nominal')->nullable();
            $table->integer('terhutang')->nullable();
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
        Schema::dropIfExists('faktur_penjualan');
    }
}