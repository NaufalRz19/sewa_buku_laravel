<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peminjam;

use App\Models\Telepon;

use App\Models\JenisPeminjam;

use App\Models\User;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Storage;

class PeminjamController extends Controller
{
    public function lihat_data_peminjam(){
        $peminjam = ['Budiman',
                        'Maryono',
                        'Dina',
                        'Rusli'
                    ];
        return view('peminjams/lihat_data_peminjam', compact('peminjam'));
    }

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $batas = 5;
        $jumlah_peminjam = Peminjam::count();
        $data_peminjam = Peminjam::orderBy('id', 'asc')->paginate($batas);
        $no = 0;
        return view('peminjams.index', compact('data_peminjam','no','jumlah_peminjam'));
    }

    public function create(){
        $user = User::find(DB::table('users')->max('id'));
        $name = $user['name'];
        $user_id = $user['id'];
        $list_jenis_peminjam = JenisPeminjam::pluck('nama_jenis_peminjam', 'id_jenis_peminjam');
        return view('peminjams.create', compact('list_jenis_peminjam', 'user_id', 'name'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'kode_peminjam' => 'required|string',
            'nama_peminjam' => 'required|string|max:40',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string'
        ]);

        $this->validate($request,[
            'foto_peminjam' =>'required|image|mimes:jpeg,jpg,png',
        ]);
        $foto_peminjam = $request->foto_peminjam;
        $nama_file = time().'.'.$foto_peminjam->getClientOriginalExtension();
        $foto_peminjam->move('foto_peminjam/', $nama_file);

        $peminjam = new Peminjam;
        $peminjam->kode_peminjam = $request->kode_peminjam;
        $peminjam->nama_peminjam = $request->nama_peminjam;
        $peminjam->tgl_lahir = $request->tgl_lahir;
        $peminjam->alamat = $request->alamat;
        $peminjam->id_jenis_peminjam= $request->id_jenis_peminjam;
        $peminjam->user_id=$request->user_id;
        $peminjam->foto_peminjam= $nama_file;
        $peminjam->save();

        $telepon = new Telepon;
        $telepon->nomor_telepon = $request->telepon;
        $peminjam->telepon()->save($telepon);

        Session::flash('flash_message', 'Data peminjam berhasil disimpan');

        return redirect('peminjam');
    }

    public function edit($id){
        $peminjam = Peminjam::find($id);
        if(!empty($peminjam->telepon->nomor_telepon)){
            $peminjam->nomor_telepon = $peminjam->telepon->nomor_telepon;
        }
        $list_jenis_peminjam = JenisPeminjam::pluck('nama_jenis_peminjam','id_jenis_peminjam');
        return view('peminjams.edit', compact('peminjam','list_jenis_peminjam'));
    }

    public function update(Request $request, $id){
        $peminjam = Peminjam::find($id);

        if($request->has('foto_peminjam')){
            $foto_peminjam = $request->foto_peminjam;
            $nama_file = time().'.'.$foto_peminjam->getClientOriginalExtension();
            $foto_peminjam->move('foto_peminjam/', $nama_file);
            $peminjam->kode_peminjam = $request->kode_peminjam;
            $peminjam->nama_peminjam = $request->nama_peminjam;
            $peminjam->tgl_lahir = $request->tgl_lahir;
            $peminjam->alamat = $request->alamat;
            $peminjam->id_jenis_peminjam= $request->id_jenis_peminjam;
            $peminjam->foto_peminjam= $nama_file;
            $peminjam->update();
        }
        else{
            $peminjam->kode_peminjam = $request->kode_peminjam;
            $peminjam->nama_peminjam = $request->nama_peminjam;
            $peminjam->tgl_lahir = $request->tgl_lahir;
            $peminjam->alamat = $request->alamat;
            $peminjam->id_jenis_peminjam= $request->id_jenis_peminjam;
            $peminjam->update();
        }
        //update nomor telepon, jika sebelumnya sudah ada nomor telepon
        if($peminjam->telepon){
            //jika telepon diisi, maka update
            if($request->filled('nomor_telepon')){
                $telepon = $peminjam->telepon;
                $telepon->nomor_telepon = $request->input('nomor_telepon');
                $peminjam->telepon()->save($telepon);
            }
            else{
                $peminjam->telepon()->delete();
            }
        }
        //buat entry baru, jika sebelumnya tidak ada nomor telepon
        else{
            if($request->filled('nomor_telepon')){
                $telepon = new Telepon;
                $telepon->nomor_telepon = $request->nomor_telepon;
                $peminjam->telepon()->save($telepon);
            }
        }

        Session::flash('flash_message', 'Data peminjam berhasil disimpan');

        return redirect('peminjam')->with('pesan','Data Peminjam berhasil diupdate');
    }

    public function destroy($id){
        $peminjam = Peminjam::find($id);
        //$telepon = Telepon::find($id);
        $peminjam->delete();
        //$telepon->delete();

        Session::flash('flash_message', 'Data peminjam berhasil dihapus');
        Session::flash('penting', true);

        return redirect('peminjam')->with('pesan','Data Peminjam berhasil dihapus');
    }

    public function search(Request $request){
        $batas = 5;
        $cari = $request->kata;
        $data_peminjam = Peminjam::where('nama_peminjam','like','%'.$cari.'%')->paginate($batas);
        $no = $batas * ($data_peminjam->currentPage() - 1);
        return view('peminjams.search', compact('data_peminjam','no','cari'));
    }

    public function CobaCollection(){
        $daftar = ['Budi Pranoto',
                    'Amy Delia',
                    'Cakra Lukman',
                    'Dewi Nova',
                    'Kartini Indah'
                ];
        $collection = collect($daftar)->map(function($nama){
            return ucwords($nama);
        });
        return $collection;
    }

    public function collection_first(){
        $collection = Peminjam::all()->first();
        return $collection;
    }

    public function collection_last(){
        $collection = Peminjam::all()->last();
        return $collection;
    }

    public function collection_count(){
        $collection = Peminjam::all();
        $jumlah = $collection->count();
        return 'Jumlah peminjam : '.$jumlah;
    }

    public function collection_take(){
        $collection = Peminjam::all()->take(4);
        return $collection;
    }

    public function collection_pluck(){
        $collection = Peminjam::all()->pluck('nama_peminjam');
        return $collection;
    }

    public function collection_where(){
        $collection = Peminjam::all()->where('kode_peminjam', 'P0004');
        return $collection;
    }

    public function collection_wherein(){
        $collection = Peminjam::all()->whereIn('kode_peminjam', ['P0004', 'P0002', 'P0003']);
        return $collection;
    }

    public function collection_toarray(){
        $collection = Peminjam::select('kode_peminjam', 'nama_peminjam')->take(4)->get();
        $koleksi = $collection->toArray();
        foreach($koleksi as $peminjam){
            echo $peminjam['kode_peminjam'].' - '.$peminjam['nama_peminjam'].'<br>';
        }
    }

    public function collection_tojson(){
        $data = [
            ['kode_peminjam'=> 'P0001', 'nama_peminjam' => 'Karina'],
            ['kode_peminjam'=> 'P0002', 'nama_peminjam' => 'Joko'],
            ['kode_peminjam'=> 'P0003', 'nama_peminjam' => 'Zainal'],
            ['kode_peminjam'=> 'P0004', 'nama_peminjam' => 'Lupita'],
        ];
        $collection = collect($data)->toJson();
        return $collection;
    }
}
