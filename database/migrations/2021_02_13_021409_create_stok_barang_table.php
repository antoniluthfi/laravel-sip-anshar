<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok_barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kategori');
            $table->double('harga_user', 15, 0);
            $table->double('harga_reseller', 15, 0);
            $table->integer('bjb');
            $table->integer('bjm');
            $table->integer('lnu');
            $table->integer('tdc');
            $table->integer('total_pack')->default(0);
            $table->boolean('paket')->default(false);
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
        Schema::dropIfExists('stok_barang');
    }
}
