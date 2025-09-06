@extends('pengguna.beranda-content')

@section('content')
<div class="container py-4 mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">

            <!-- Header Section -->
            <div class="text-center mb-4 animate-fade">
                <div class="title-container position-relative d-inline-block mb-3">
                    <h2 class="fw-bold text-navy mb-2 section-title" style="font-size: 2rem;">
                        Daftar Guru
                    </h2>
                </div>
                <div class="subtitle-wrapper mb-3">
                    <span class="subtitle-badge bg-navy text-white px-3 py-1 rounded-pill d-inline-block"
                        style="font-size: 0.95rem; font-weight: 500;">
                        MI Diponegoro 03 Karangklesem
                    </span>
                </div>
            </div>

            <!-- Grid Guru -->
            <div class="row g-4">
                @forelse($data as $guru)
                    <div class="col-md-4 animate-fade" data-delay="{{ $loop->index * 50 }}">
                        <div class="card h-100 shadow-lg border-0">
                            <!-- Foto -->
                            <div class="text-center p-3">
                                @if ($guru->foto)
                                    <img src="{{ asset('uploads/guru/' . $guru->foto) }}" 
                                         alt="{{ $guru->nama_lengkap }}" 
                                         class="rounded-circle shadow-sm"
                                         style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #fff;">
                                @else
                                    <img src="{{ asset('gambar/no-image.png') }}" 
                                         alt="No Image" 
                                         class="rounded-circle shadow-sm"
                                         style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #fff;">
                                @endif
                            </div>

                            <!-- Detail -->
                            <div class="card-body d-flex flex-column text-center">
                                <h5 class="card-title mb-1">{{ $guru->nama_lengkap }}</h5>
                                <span class="badge bg-navy mb-3 px-3 py-2">{{ $guru->jabatan ?? '-' }}</span>

                                <ul class="list-unstyled small text-start mb-3">
                                    <li><i class="fas fa-book text-navy me-2"></i><strong>Mapel:</strong> {{ $guru->mata_pelajaran ?? '-' }}</li>
                                    <li><i class="fas fa-user-graduate text-navy me-2"></i><strong>Pendidikan:</strong> {{ $guru->pendidikan_terakhir ?? '-' }}</li>
                                    <li><i class="fas fa-envelope text-navy me-2"></i><strong>Email:</strong> {{ $guru->email ?? '-' }}</li>
                                    <li><i class="fas fa-phone text-navy me-2"></i><strong>No HP:</strong> {{ $guru->no_hp ?? '-' }}</li>
                                    <li><i class="fas fa-check-circle text-navy me-2"></i><strong>Status:</strong> {{ $guru->status ?? '-' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card shadow-lg border-0 p-5 text-center animate-fade">
                            <div class="empty-state-icon mb-3">
                                <i class="fas fa-info-circle text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="text-navy mb-2">Belum ada data guru</h5>
                            <p class="text-muted mb-0" style="font-size: 1rem;">
                                Informasi guru masih dalam proses penginputan
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>

<!-- Styling -->
<style>
:root {
    --navy-color: #1b5e20;
}
.bg-navy { background-color: var(--navy-color) !important; }
.text-navy { color: var(--navy-color) !important; }

.section-title { font-size: 2rem; font-weight: 700; }

.card {
    border-radius: 12px;
    overflow: hidden;
    transition: 0.3s;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15) !important;
}

.badge {
    font-size: 0.85rem;
    font-weight: 500;
}

.animate-fade {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.6s ease;
}
.animate-fade.visible {
    opacity: 1;
    transform: translateY(0);
}

.empty-state-icon { transition: all 0.5s ease; }
.card:hover .empty-state-icon { transform: scale(1.1); }
</style>

<!-- Animasi Scroll -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const animatedElements = document.querySelectorAll('.animate-fade');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const delay = entry.target.getAttribute('data-delay') || 0;
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, delay);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    animatedElements.forEach(element => {
        observer.observe(element);
    });
});
</script>
@endsection
