<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\TransaksiPeminjamanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Author;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return view('auth/login');
});

Route::get('home', function(){
    return view('home');
});

Route::get('user', [UserController::class, 'index'])->name('user.index');

Route::get('user/create', [UserController::class, 'create'])->name('user.create');

Route::post('user', [UserController::class, 'store'])->name('user.store');

Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');

Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');

Route::post('user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('data_peminjam', function(){
    return view('peminjams/data_peminjam');
});

Route::get('peminjam', [PeminjamController::class, 'index'])->name('peminjam.index');

Route::get('peminjam/create', [PeminjamController::class, 'create'])->name('peminjam.create');

Route::post('peminjam', [PeminjamController::class, 'store'])->name('peminjam.store');

Route::get('peminjam/edit/{id}', [PeminjamController::class, 'edit'])->name('peminjam.edit');

Route::post('peminjam/update/{id}', [PeminjamController::class, 'update'])->name('peminjam.update');

Route::post('peminjam/delete/{id}', [PeminjamController::class, 'destroy'])->name('peminjam.destroy');

Route::get('/peminjam/search', [PeminjamController::class, 'search'])->name('peminjam.search');

Route::get('coba_collection', [PeminjamController::class, 'CobaCOllection']);

Route::get('collection_first', [PeminjamController::class, 'collection_first']);

Route::get('collection_last', [PeminjamController::class, 'collection_last']);

Route::get('collection_count', [PeminjamController::class, 'collection_count']);

Route::get('collection_take', [PeminjamController::class, 'collection_take']);

Route::get('collection_pluck', [PeminjamController::class, 'collection_pluck']);

Route::get('collection_where', [PeminjamController::class, 'collection_where']);

Route::get('collection_wherein', [PeminjamController::class, 'collection_wherein']);

Route::get('collection_toarray', [PeminjamController::class, 'collection_toarray']);

Route::get('collection_tojson', [PeminjamController::class, 'collection_tojson']);

Route::get('lihat_data_peminjam', [PeminjamController::class, 'lihat_data_peminjam']);

Route::get('transaksi_peminjaman', [TransaksiPeminjamanController::class, 'index'])->name('transaksi_peminjaman.index');

Route::get('transaksi_peminjaman/create', [TransaksiPeminjamanController::class, 'create'])->name('transaksi_peminjaman.create');

Route::post('transaksi_peminjaman', [TransaksiPeminjamanController::class, 'store'])->name('transaksi_peminjaman.store');

Route::get('transaksi_peminjaman/detail_peminjam/{id}', [TransaksiPeminjamanController::class, 'detail_peminjam'])->name('transaksi_peminjaman.detail_peminjam');

Route::get('transaksi_peminjaman/detail_buku/{id}', [TransaksiPeminjamanController::class, 'detail_buku'])->name('transaksi_peminjaman.detail_buku');

Route::get('buku', [BukuController::class, 'index'])->name('buku.index');

Route::get('buku/create', [BukuController::class, 'create'])->name('buku.create');

Route::post('buku', [BukuController::class, 'store'])->name('buku.store');

Route::get('buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');

Route::post('buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');

Route::post('buku/delete/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

Route::get('biodata', function () {
    return 'Nama : Naufal <br> Nim : 3.34.19.1.14 <br> Alamat : Kudus <br> Hobi : Badminton';
});

Route::get('mahasiswa/{prodi}', function($prodi) {
    return 'Mahasiswa Program Studi : '.$prodi;
});

Route::get('mahasiswa2/{prodi?}', function($prodi=null){
    if($prodi == null)
        return "Data Program Studi kosong";
    return "Mahasiswa Program Studi : ".$prodi;
});

Route::get('mahasiswa3/{prodi?}', function($prodi="Teknik Informatika"){
    return "Mahasiswa prodi : ".$prodi;
});

Route::get('biodata2', function(){
    return view('biodata2');
});

Route::group([], function(){
    Route::get('/pertama', function(){
        echo "route pertama";
    });
    Route::get('/kedua', function(){
        echo "route kedua";
    });
    Route::get('/ketiga', function(){
        echo "route ketiga";
    });
});

Route::group(['prefix' => 'latihan'], function(){
    Route::get('/satu', function(){
        echo "Latihan 1";
    });
    Route::get('/dua', function(){
        echo "Latihan 2";
    });
    Route::get('/tiga', function(){
        echo "Latihan 3";
    });
});

Route::group(array('prefix' => 'admin'), function(){
    //url ke halaman home
    Route::get('/', function(){
        return 'Halaman Home Admin';
    });
    //Route ke halaman input data buku
    Route::get('posts', function(){
        return "Halaman input data buku";
    });
    //Route ke halaman yang menyimpan data
    Route::get('posts/simpan', function(){
        return "Data berhasil disimpan";
    });
});

Route::name('kuliah')->group(function(){
    Route::get('teknik_informatika', function(){
        return "Kuliah di Program Studi Teknik Informatika";
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
