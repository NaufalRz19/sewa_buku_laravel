@extends('layout.master')

@section('content')
    <div class="container">
        <h4>Tambah Buku</h4>
        @if (count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form method="post" action="{{ route('buku.store') }}">
        @csrf
            <div class="form-group">
                <label>Kode Buku</label>
                <input type="text" name="kode_buku" class="form-control">
            </div>
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="judul_buku" class="form-control">
            </div>
            <div class="form-group">
                <label>Jumlah Halaman</label>
                <input type="text" name="jmlh_halaman" class="form-control">
            </div>
            <div class="form-group">
                <label>ISBN</label>
                <input type="text" name="ISBNs" class="form-control">
            </div>
            <div class="form-group">
                <label>Pengarang</label>
                <input type="text" name="pengarang" class="form-control">
            </div>
            <div class="form-group">
                <label>Tahun Terbit</label>
                <select id="year" name="tahun_terbit" class="form-control">
                <script>
                    var myDate = new Date();
                    var year = myDate.getFullYear();
                    for(var i = 2000; i < year+1; i++){
                        document.write('<option value="'+i+'">'+i+'</option>');
                    }
                </script>
                </select>
            </div>
            <div><button type="submit">Simpan</button></div>
        </form>
    </div>
@endsection
