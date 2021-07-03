<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimanPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman_pesanan', function (Blueprint $table) {
            $table->string('kode_pesanan');
            $table->string('kode_pengiriman');
            $table->foreignId('id_marketing');
            $table->foreignId('user_id');
            $table->date('tanggal_pengiriman')->nullable();
            $table->text('alamat')->nullable();
            $table->double('ongkir', 15, 0)->default(0);
            $table->foreignId('id_ekspedisi')->nullable();
            $table->foreignId('id_cabang');
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
        Schema::dropIfExists('pengiriman_pesanan');
    }
}
