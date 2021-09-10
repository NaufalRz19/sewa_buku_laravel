<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->integer('id_peminjam');
            $table->integer('id_buku');
            $table->date('tgl_peminjaman');
            $table->date('tgl_pengembalian');
            $table->timestamps();

            $table->primary('id_peminjam', 'id_buku');

            $table->foreign('id_peminjam')
            ->references('id')->on('peminjam')
            ->onDelete('cascade');

            $table->foreign('id_buku')
            ->references('id')->on('buku')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_peminjaman');
    }
}
