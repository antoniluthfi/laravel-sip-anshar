<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('hak_akses');
            $table->string('nomorhp')->unique();
            $table->string('no_telp_bisnis')->unique()->nullable();
            $table->string('faximili')->nullable();
            $table->string('website')->nullable();
            $table->text('alamat');
            $table->foreignId('id_cabang');
            $table->string('password');
            $table->string('status')->default('aktif');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
