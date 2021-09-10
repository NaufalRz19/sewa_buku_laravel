<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    use HasFactory;
    protected $table = 'peminjam';

    public function telepon(){
        return $this->hasOne('App\Models\Telepon', 'id_peminjam');
    }

    public function jenis_peminjam(){
        return $this->belongsTo('App\Models\JenisPeminjam','id_jenis_peminjam');
    }

    public function buku(){
        return $this->belongsToMany('App\Models\Buku','transaksi_peminjaman','id_peminjam','id_buku');
    }

    public function transaksi_peminjaman(){
        return $this->hasMany('App\Models\TransaksiPeminjaman','id_peminjam');
    }
}
