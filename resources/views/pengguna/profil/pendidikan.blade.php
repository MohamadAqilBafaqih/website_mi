@extends('pengguna.beranda-content')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Pendidikan di MI Diponegoro 03 Karangklesem</h2>
    <ul class="list-group">
        @foreach ($data as $item)
            <li class="list-group-item">
                {{ $item->isi_pendidikan }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
