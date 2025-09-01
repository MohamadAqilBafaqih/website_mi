@extends('pengguna.beranda-content')

@section('title', 'Biaya PPDB')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Biaya Pendaftaran PPDB</h1>

    @if($data && $data->biaya)
        <div class="card shadow-sm">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach(explode("\n", $data->biaya) as $item)
                        <li class="list-group-item">{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @else
        <p class="text-center">Belum ada informasi biaya pendaftaran.</p>
    @endif
</div>
@endsection
