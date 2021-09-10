<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $filable = ['judul_buku','jmlh_halaman','ISBNs','pengarang','tahun_terbit'];

    public function peminjam(){
        return $this->belongsToMany('App\Models\Peminjam', 'transaksi_peminjaman', 'id_buku', 'id_peminjam');
    }

    public function transaksi_peminjaman(){
        return $this->hasMany('App\Models\TransaksiPeminjaman','id_buku');
    }
}
