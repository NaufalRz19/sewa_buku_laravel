<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $batas = 5;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id', 'asc')->paginate($batas);
        $no = 0;
        return view('buku.index', compact('data_buku','no','jumlah_buku'));
    }

    public function create(){
        $list_buku = Buku::pluck('judul_buku', 'id');
        return view('buku.create', compact('list_buku'));
    }

    public function store(Request $request){
        $buku = new Buku;
        $buku->kode_buku = $request->kode_buku;
        $buku->judul_buku = $request->judul_buku;
        $buku->jmlh_halaman = $request->jmlh_halaman;
        $buku->ISBNs = $request->ISBNs;
        $buku->pengarang= $request->pengarang;
        $buku->tahun_terbit=$request->tahun_terbit;
        $buku->save();

        return redirect('buku');
    }

    public function edit($id){
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id){
        $buku = Buku::find($id);

        $buku->kode_buku = $request->kode_buku;
        $buku->judul_buku = $request->judul_buku;
        $buku->jmlh_halaman = $request->jmlh_halaman;
        $buku->ISBNs = $request->ISBNs;
        $buku->pengarang= $request->pengarang;
        $buku->tahun_terbit=$request->tahun_terbit;
        $buku->update();

        return redirect('buku');
    }

    public function destroy($id){
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('buku');
    }
}
