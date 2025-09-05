@extends('pengguna.beranda-content')

@section('title', 'Brosur PPDB')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 text-center">Brosur PPDB</h1>

        @if ($data->isNotEmpty() && $data->first()->brosur)
            <img src="{{ asset('uploads/ppdb/' . $data->first()->brosur) }}" alt="Brosur PPDB"
                class="img-fluid rounded shadow-sm" style="max-height:400px;">
        @else
            <p class="text-center">Brosur belum tersedia.</p>
        @endif
    </div>
@endsection
