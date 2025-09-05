@extends('pengguna.beranda-content')

@section('content')
<div class="container py-4 mt-3">
    <div class="text-center mb-4 animate-fade">
        <div class="title-container position-relative d-inline-block mb-3">
            <h1 class="fw-bold text-navy mb-2 section-title" style="font-size: 2rem; position: relative; z-index: 2;">
                Sarana & Prasarana
            </h1>
        </div>
        <div class="subtitle-wrapper mb-3">
            <span class="subtitle-badge bg-navy text-white px-3 py-1 rounded-pill d-inline-block" style="font-size: 0.95rem; font-weight: 500;">
                MI Diponegoro 03 Karangklesem
            </span>
        </div>
    </div>

    <div class="row g-4">
        @foreach($data as $item)
            <div class="col-lg-4 col-md-6 mb-4 animate-fade">
                <div class="card shadow-lg border-0 h-100 position-relative card-hover">
                    @if($item->foto)
                        <img src="{{ asset('uploads/sarana_prasarana/' . $item->foto) }}" 
                             class="card-img-top" alt="{{ $item->nama_fasilitas }}" 
                             style="height: 250px; object-fit: cover;">
                    @else
                        <img src="{{ asset('gambar/no-image.png') }}" 
                             class="card-img-top" alt="No Image" 
                             style="height: 250px; object-fit: cover;">
                    @endif

                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">{{ $item->nama_fasilitas }}</h5>
                        <div class="mb-2">
                            <span class="badge bg-navy me-1"><i class="bi bi-tag me-1"></i>{{ $item->jenis_fasilitas ?? '-' }}</span>
                            <span class="badge bg-success me-1"><i class="bi bi-check-circle me-1"></i>{{ $item->kondisi ?? '-' }}</span>
                            <span class="badge bg-warning text-dark"><i class="bi bi-calendar me-1"></i>{{ $item->tahun_pengadaan ?? '-' }}</span>
                        </div>
                        <p class="card-text text-muted small">{!! nl2br(e($item->deskripsi)) !!}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
:root {
    --navy-color: #1b5e20;
}
.text-navy { color: var(--navy-color) !important; }
.bg-navy { background-color: var(--navy-color) !important; }

.card {
    border-radius: 12px;
    transition: all 0.4s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.2) !important;
}

.section-title { font-weight: 700; }
.subtitle-badge { font-weight: 500; }

.animate-fade { opacity: 0; transform: translateY(20px); transition: all 0.6s ease; }
.animate-fade.visible { opacity: 1; transform: translateY(0); }

.badge i { vertical-align: middle; }
.card-text { line-height: 1.4; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const animatedElements = document.querySelectorAll('.animate-fade');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    animatedElements.forEach(element => { observer.observe(element); });
});
</script>
@endsection
