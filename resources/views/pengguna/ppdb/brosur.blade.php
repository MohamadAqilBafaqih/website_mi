@extends('pengguna.beranda-content')

@section('title', 'Brosur PPDB')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Brosur PPDB</h1>

    @if($data && $data->brosur)
        <div class="d-flex justify-content-center">
            <a href="{{ asset('storage/' . $data->brosur) }}" class="btn btn-primary btn-lg" target="_blank">
                <i class="fas fa-download me-2"></i> Download Brosur
            </a>
        </div>
    @else
        <p class="text-center">Brosur belum tersedia.</p>
    @endif
</div>
@endsection
