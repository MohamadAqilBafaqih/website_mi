@extends('pengguna.beranda-content')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Sejarah MI Diponegoro 03 Karangklesem</h2>

    @forelse($data as $item)
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <p class="text-justify">{{ $item->isi_sejarah }}</p>
            </div>
        </div>
    @empty
        <p class="text-center text-muted">Belum ada data sejarah yang tersedia.</p>
    @endforelse
</div>
@endsection
