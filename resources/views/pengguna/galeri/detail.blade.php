@extends('pengguna.beranda-content')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                @if($galeri->foto)
                    <img src="{{ asset('uploads/galeri_kegiatan/'.$galeri->foto) }}" 
                         class="card-img-top" 
                         alt="{{ $galeri->judul_kegiatan }}" 
                         style="max-height: 450px; object-fit: cover;">
                @endif

                <div class="card-body">
                    <h2 class="fw-bold mb-3">{{ $galeri->judul_kegiatan }}</h2>
                    <p class="text-muted small mb-3">
                        <i class="bi bi-calendar-event"></i> 
                        {{ $galeri->tanggal ? \Carbon\Carbon::parse($galeri->tanggal)->format('d M Y') : $galeri->created_at->format('d M Y') }}
                    </p>
                    <div class="card-text">
                        {!! nl2br(e($galeri->deskripsi)) !!}
                    </div>
                </div>

                <div class="card-footer text-end">
                    <a href="{{ route('pengguna.galeri.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Galeri
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
