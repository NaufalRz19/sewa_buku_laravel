@extends('layout.master')

@section('content')
    <div class="container">
        <h4>Data Transaksi Peminjam</h4>
        <p align="right"><a href="{{ route('transaksi_peminjaman.create') }}" class="btn btn-primary">Tambah Transaksi Peminjaman</a></p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi Peminjaman</th>
                    <th>Nama Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                </tr>
            <tbody>
                @foreach ($data_transaksi_peminjaman as $transaksi_peminjaman)<?php //print_r($peminjam);?>
                <tr>
                    <td>{{ $transaksi_peminjaman->id}}</td>
                    <td>{{ $transaksi_peminjaman->kode_transaksi}}</td>
                    <td><a href="{{ route('transaksi_peminjaman.detail_peminjam',$transaksi_peminjaman->peminjam['id']) }}">
                                    {{ $transaksi_peminjaman->peminjam['nama_peminjam']}}</a></td>
                    <td><a href="{{ route('transaksi_peminjaman.detail_buku',$transaksi_peminjaman->buku['id']) }}">
                                    {{ $transaksi_peminjaman->buku['judul_buku']}}</a></td>
                    <td>{{ $transaksi_peminjaman->tgl_peminjaman}}</td>
                    <td>{{ $transaksi_peminjaman->tgl_pengembalian}}</td>
                </tr>
                @endforeach
            </tbody>
            </thead>
        </table>

        <div class="pull-left">
            <strong>
                Jumlah Transaksi Peminjaman : {{ $jumlah_transaksi_peminjaman}}
            </strong>
        </div>

    </div>
@endsection
