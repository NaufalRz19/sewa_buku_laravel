<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TransaksiPeminjaman;
use App\Models\Peminjam;
use App\Models\Buku;

class TransaksiPeminjamanController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $data_transaksi_peminjaman = TransaksiPeminjaman::all()->sortBy('id');
        $jumlah_transaksi_peminjaman = $data_transaksi_peminjaman->count();
        return view('transaksi_peminjaman.index', compact('data_transaksi_peminjaman','jumlah_transaksi_peminjaman'));
    }

    public function create(){
        $list_peminjam = Peminjam::pluck('nama_peminjam','id');
        $list_buku = Buku::pluck('judul_buku','id');
        return view('transaksi_peminjaman.create', compact('list_peminjam','list_buku'));
    }

    public function store(Request $request){
        $transaksi_peminjaman = new TransaksiPeminjaman;
        $transaksi_peminjaman->kode_transaksi = $request->kode_transaksi;
        $transaksi_peminjaman->id_peminjam = $request->id_peminjam;
        $transaksi_peminjaman->id_buku = $request->id_buku;
        $transaksi_peminjaman->tgl_peminjaman = $request->tgl_peminjaman;
        $transaksi_peminjaman->tgl_pengembalian = $request->tgl_pengembalian;
        $transaksi_peminjaman->save();

        return redirect('transaksi_peminjaman');
    }

    public function detail_peminjam($id){
        $halaman = 'peminjam';
        $peminjam = Peminjam::findOrFail($id);
        return view('transaksi_peminjaman.detail_peminjam', compact('halaman','peminjam'));
    }

    public function detail_buku($id){
        $halaman = 'buku';
        $buku = Buku::findOrFail($id);
        return view('transaksi_peminjaman.detail_buku', compact('halaman', 'buku'));
    }
}
