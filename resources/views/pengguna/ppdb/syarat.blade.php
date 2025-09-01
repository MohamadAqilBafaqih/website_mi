@extends('pengguna.beranda-content')

@section('title', 'Syarat PPDB')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Syarat Pendaftaran PPDB</h1>

    @if($data && $data->syarat)
        <div class="card shadow-sm">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach(explode("\n", $data->syarat) as $syarat)
                        <li class="list-group-item">{{ $syarat }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @else
        <p class="text-center">Belum ada informasi syarat pendaftaran.</p>
    @endif
</div>
@endsection
