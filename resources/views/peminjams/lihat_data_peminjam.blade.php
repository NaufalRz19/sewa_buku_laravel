@extends('layout.master')

@section('content')
<div id=peminjam>
    <h2>Data Peminjam</h2>
        @if(!empty($peminjam))
        <ul>
            <?php foreach($peminjam as $data):?>
                <li><?=$data ?></li>
            <?php endforeach ?>
        </ul>
        @else:
    <p>Data peminjam kosong.</p>
    @endif
</div>
@endsection