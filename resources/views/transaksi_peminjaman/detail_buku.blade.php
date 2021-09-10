@extends('layout.master')

@section('content')
    <div class="container">
        <h4>Detail Peminjam yang meminjam Buku</h4>
        <h4>Kode Buku : {{ $buku->kode_buku }}</h4>
        <h4>Judul Buku : {{ $buku->judul_buku }}</h4>
        <table class="table table-striped">
        <thead>
            <th>Nama Peminjam</th>
        </thead>
        @foreach ($buku->peminjam as $item)
        <tbody>
        <tr>
            <td>{{$item->nama_peminjam}}</td>
        </tr>
        </tbody>
        @endforeach

        </table>
    </div>
@endsection
