<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPeminjam extends Model
{
    use HasFactory;
    protected $table = 'jenis_peminjam';

    protected $fillable = ['nama_jenis_peminjam'];

    public function peminjam(){
        return $this->hasMany('App\Models\Peminjam','id_jenis_peminjam');
    }
}
