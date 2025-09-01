@extends('pengguna.beranda-content')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                @if($berita->foto)
                    <img src="{{ asset('uploads/berita/'.$berita->foto) }}" 
                         class="card-img-top" 
                         alt="{{ $berita->judul }}" 
                         style="max-height: 400px; object-fit: cover;">
                @endif

                <div class="card-body">
                    <h2 class="card-title fw-bold mb-3">{{ $berita->judul ?? 'Tanpa Judul' }}</h2>
                    <p class="text-muted small mb-3">
                        <i class="bi bi-person-circle"></i> {{ $berita->penulis ?? 'Admin' }} | 
                        <i class="bi bi-calendar-event"></i> {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') : $berita->created_at->format('d M Y') }}
                    </p>
                    <div class="card-text">
                        {!! nl2br(e($berita->isi)) !!}
                    </div>
                </div>

                <div class="card-footer text-end">
                    <a href="{{ route('pengguna.berita.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Berita
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
