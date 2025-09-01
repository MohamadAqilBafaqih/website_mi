@extends('pengguna.beranda-content')

@section('title', 'Kalender Akademik')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Kalender Akademik</h1>

    @if($data && $data->kalender)
        <div class="card shadow-sm">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach(explode("\n", $data->kalender) as $item)
                        <li class="list-group-item">{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @else
        <p class="text-center">Belum ada informasi kalender akademik.</p>
    @endif
</div>
@endsection
