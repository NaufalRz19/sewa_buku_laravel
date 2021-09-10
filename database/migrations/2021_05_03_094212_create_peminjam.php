<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjam', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjam')->unique();
            $table->string('nama_peminjam');
            $table->date('tgl_lahir');
            $table->string('alamat');
            $table->integer('id_jenis_peminjam')->unsigned();
            $table->foreign('id_jenis_peminjam')
            ->references('id')->on('jenis_peminjam')
            ->onDelete('cascade');
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
        Schema::dropIfExists('peminjam');
    }
}
