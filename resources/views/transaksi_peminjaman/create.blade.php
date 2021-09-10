@extends('layout.master')

@section('content')
    <div class="container">
        <h4>Tambah Transaksi Peminjam</h4>
        <form method="post" action="{{ route('transaksi_peminjaman.store') }}">
        @csrf
            <div class="form-group">
                <label>Kode Transaksi Peminjam</label>
                <input type="text" name="kode_transaksi" class="form-control">
                <input type="hidden" name="tgl_peminjaman" class="form-control" value="<?php echo date("Y-m-d");?>">
                <?php
                $tanggal_pinjam = date("Y-m-d");
                $tanggal_pinjam = strtotime($tanggal_pinjam);
                $tanggal_kembali = strtotime("+15 day", $tanggal_pinjam);
                $tanggal_kembali = date("Y-m-d", $tanggal_kembali);
                ?>
                <input type="hidden" name="tgl_pengembalian" class="form-control" value="<?php echo $tanggal_kembali;?>">
            </div>
            <div class="form-group">
                <label>Peminjam</label>
                <select class="form-control" name="id_peminjam">
                    <option>Pilih Nama Peminjam</option>
                        @foreach ($list_peminjam as $key => $value)
                    <option value="{{ $key }}">
                        {{ $value }}
                    </option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Buku</label>
                <select class="form-control" name="id_buku">
                    <option>Pilih Judul Buku</option>
                        @foreach ($list_buku as $key => $value)
                    <option value="{{ $key }}">
                        {{ $value }}
                    </option>
                        @endforeach
                </select>
            </div>
            <div><button type="submit">Simpan</button></div>
        </form>
    </div>
@endsection
