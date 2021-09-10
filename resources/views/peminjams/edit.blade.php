@extends('layout.master')

@section('content')
    <div class="container">
        <h4>Edit Peminjam</h4>
        <form method="post" action="{{ route('peminjam.update', $peminjam->id) }}" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label>Kode Peminjam</label>
                <input type="text" name="kode_peminjam" class="form-control" value="{{ $peminjam->kode_peminjam }}">
            </div>
            <div class="form-group">
                <label>Nama Peminjam</label>
                <input type="text" name="nama_peminjam" class="form-control" value="{{ $peminjam->nama_peminjam }}">
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="{{ $peminjam->tgl_lahir }}">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ $peminjam->alamat }}">
            </div>
            <div class="form-group">
                <label>Nomor Telepon</label>
                <input type="text" name="nomor_telepon" class="form-control" value="{{ $peminjam->nomor_telepon }}">
            </div>
            <div class="form-group">
                <label>Jenis Peminjam</label>
                <select class="form-control" name="id_jenis_peminjam">
                    <option>Pilih Jenis Peminjam</option>
                        @foreach ($list_jenis_peminjam as $key => $value)
                    <option value="{{ $key }}" {{$peminjam->id_jenis_peminjam == $key ? 'selected' : ''}}>
                        {{ $value }}
                    </option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto_peminjam" class="form-control">
                <label><b>*Jika foto tidak diganti kosongkan saja</b></label>
            </div>
            <div><button type="submit">Update</button></div>
        </form>
    </div>
@endsection
