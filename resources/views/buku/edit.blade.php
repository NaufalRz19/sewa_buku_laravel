@extends('layout.master')

@section('content')
    <div class="container">
        <h4>Edit Buku</h4>
        @if (count($errors) > 0)
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form method="post" action="{{ route('buku.update', $buku->id) }}">
    @csrf
        <div class="form-group">
            <label>Kode Buku</label>
            <input type="text" name="kode_buku" class="form-control" value="{{ $buku->kode_buku }}">
        </div>
        <div class="form-group">
            <label>Judul Buku</label>
            <input type="text" name="judul_buku" class="form-control" value="{{ $buku->judul_buku }}">
        </div>
        <div class="form-group">
            <label>Jumlah Halaman</label>
            <input type="text" name="jmlh_halaman" class="form-control" value="{{ $buku->jmlh_halaman }}">
        </div>
        <div class="form-group">
            <label>ISBN</label>
            <input type="text" name="ISBNs" class="form-control" value="{{ $buku->ISBNs }}">
        </div>
        <div class="form-group">
            <label>Pengarang</label>
            <input type="text" name="pengarang" class="form-control" value="{{ $buku->pengarang }}">
        </div>
        <div class="form-group">
            <label>Tahun Terbit</label>
        <?php
            $x = $buku['tahun_terbit'];
            $y = intval($x);
            $already_selected_value = $y;
            $earliest_year = 2000;
            print '<select name="tahun_terbit" class="form-control">';
            foreach (range(date('Y',strtotime(date('Y', time()) . ' + 625 day')), $earliest_year) as $x){
                print '<option value="'.$x.'" '.($x === $already_selected_value ?  'selected ' : ''.')>'.$x.'</option>';
            }
            print '</select>';
        ?>
        </div>
        <div><button type="submit">Simpan</button></div>
    </form>
</div>
@endsection
