<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArusKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arus_kas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sandi_transaksi');
            $table->foreignId('id_admin');
            $table->foreignId('id_cabang');
            $table->integer('nominal');
            $table->integer('total_biaya');
            $table->integer('sisa_biaya');
            $table->boolean('masuk');
            $table->boolean('status_pembayaran')->default(false);
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
        Schema::dropIfExists('arus_kas');
    }
}
