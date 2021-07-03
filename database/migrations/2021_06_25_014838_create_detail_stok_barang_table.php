<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailStokBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_stok_barang', function (Blueprint $table) {
            $table->foreignId('id_barang');
            $table->foreignId('id_cabang');
            $table->integer('stok_tersedia');
            $table->integer('stok_dapat_dijual');
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
        Schema::dropIfExists('detail_stok_barang');
    }
}
