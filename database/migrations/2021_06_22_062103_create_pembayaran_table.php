<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('no_bukti');
            $table->foreignId('no_service');
            $table->foreignId('id_sandi_transaksi');
            $table->double('nominal', 12, 5);
            $table->double('total_biaya', 12, 5);
            $table->double('sisa_biaya', 12, 5);
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
        Schema::dropIfExists('pembayaran');
    }
}
