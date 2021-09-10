@extends('layout.master')

@section('content')

@if (count($data_peminjam))
<div class="container">
    <div>Ditemukan {{ count($data_peminjam) }} data dengan kata : {{ $cari }}</div>
    <h4>Data Peminjam</h4>

    @include('_partial/flash_message')

    <p align="right"><a href="{{ route('peminjam.create') }}" class="btn btn-primary">Tambah Peminjam</a></p>
    <form action="{{ route('peminjam.search') }}" method="GET">@csrf
        <input type="text" name="kata" placeholder="Cari..">
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Peminjam</th>
                <th>Nama Peminjam</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th>Jenis Peminjam</th>
                <th>Edit</th>
                <th>Hapus</th>
            </tr>
        <tbody>
            @foreach ($data_peminjam as $peminjam)
            <tr>
                <td>{{ $peminjam->id}}</td>
                <td>{{ $peminjam->kode_peminjam}}</td>
                <td>{{ $peminjam->nama_peminjam}}</td>
                <td>{{ $peminjam->tgl_lahir}}</td>
                <td>{{ $peminjam->alamat}}</td>
                <td>{{ !empty($peminjam->telepon['nomor_telepon'])?
                        $peminjam->telepon['nomor_telepon'] : '-'}}
                </td>
                <td>{{ $peminjam->jenis_peminjam['nama_jenis_peminjam']}}</td>
                <td><a href="{{ route('peminjam.edit', $peminjam->id) }}" class="btn btn-warning btn-sm">Edit</a></td>
                <td>
                    <form method="post" action="{{ route('peminjam.destroy', $peminjam->id) }}">
                    @csrf
                        <button class="btn btn-warning btn-sm" onClick="return confirm('Anda Yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </thead>
    </table>
    <div class="pull-left">
        <strong>
            {{ $data_peminjam->links() }}
        </strong>
    </div>
</div>
@else
    <div><h4>Data {{ $cari }} tidak ditemukan</h4>
    <a href="/peminjam">Kembali</a></div>
@endif
@endsection
