@extends('layout.master')

@section('content')
    <div class="container">
        <h4>Data Buku</h4>

        @include('_partial/flash_message')

        @if (Auth::check() && Auth::user()->level == 'admin')
        <p align="right"><a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku</a></p>
        @endif
        <form action="{{ route('peminjam.search') }}" method="GET">@csrf
            <input type="text" name="kata" placeholder="Cari..">
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Jumlah Halaman</th>
                    <th>ISBN</th>
                    <th>Pengarang</th>
                    <th>Tahun Terbit</th>
                    @if (Auth::check() && Auth::user()->level == 'admin')
                    <th>Edit</th>
                    <th>Hapus</th>
                    @endif
                </tr>
            <tbody>
                @foreach ($data_buku as $buku)
                <tr>
                    <td>{{ $buku->kode_buku}}</td>
                    <td>{{ $buku->judul_buku}}</td>
                    <td>{{ $buku->jmlh_halaman}}</td>
                    <td>{{ $buku->ISBNs}}</td>
                    <td>{{ $buku->pengarang}}</td>
                    <td>{{ $buku->tahun_terbit}}</td>
                    @if (Auth::check() && Auth::user()->level == 'admin')
                    <td><a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning btn-sm">Edit</a></td>
                    <td>
                        <form method="post" action="{{ route('buku.destroy', $buku->id) }}">
                        @csrf
                            <button class="btn btn-warning btn-sm" onClick="return confirm('Anda Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
            </thead>
        </table>
        <div class="pull-left">
            <strong>
                Jumlah Buku : {{ $jumlah_buku}}
                {{ $data_buku->links() }}
            </strong>
        </div>
    </div>
@endsection
