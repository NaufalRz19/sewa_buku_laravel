<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPeminjaman extends Model
{
    use HasFactory;
    protected $table = 'transaksi_peminjaman';

    public function peminjam(){
        return $this->belongsTo('App\Models\Peminjam','id_peminjam');
    }

    public function buku(){
        return $this->belongsTo('App\Models\Buku','id_buku');
    }
}
