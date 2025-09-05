@extends('pengguna.beranda-content')

@section('content')
<section class="py-5 mt-3">
    <div class="container">
        <!-- Judul -->
        <div class="text-center mb-5 animate-fade">
            <h2 class="fw-bold text-navy mb-3 section-title">Daftar Guru</h2>
            <p class="text-muted fs-5">
                Tenaga pendidik terbaik yang berdedikasi di 
                <span class="fw-bold text-navy">MI Diponegoro 03 Karangklesem</span>
            </p>
            <div class="divider mx-auto my-3"></div>
        </div>

        <!-- Grid Guru -->
        <div class="row g-4">
            @foreach ($data as $guru)
                <div class="col-lg-4 col-md-6 col-sm-12 animate-fade">
                    <div class="card shadow-lg border-0 h-100 card-hover text-center p-4">
                        <div class="profile-img mb-3">
                            @if ($guru->foto)
                                <img src="{{ asset('uploads/guru/' . $guru->foto) }}" 
                                    class="rounded-circle img-fluid shadow" 
                                    alt="{{ $guru->nama_lengkap }}" 
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <img src="{{ asset('gambar/no-image.png') }}" 
                                    class="rounded-circle img-fluid shadow" 
                                    alt="No Image" 
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-1">{{ $guru->nama_lengkap }}</h5>
                            <span class="badge bg-navy mb-3 px-3 py-2">{{ $guru->jabatan ?? '-' }}</span>
                            
                            <ul class="list-unstyled text-start small mb-0">
                                <li><i class="fas fa-book text-navy me-2"></i><strong>Mapel:</strong> {{ $guru->mata_pelajaran ?? '-' }}</li>
                                <li><i class="fas fa-user-graduate text-navy me-2"></i><strong>Pendidikan:</strong> {{ $guru->pendidikan_terakhir ?? '-' }}</li>
                                <li><i class="fas fa-envelope text-navy me-2"></i><strong>Email:</strong> {{ $guru->email ?? '-' }}</li>
                                <li><i class="fas fa-phone text-navy me-2"></i><strong>No HP:</strong> {{ $guru->no_hp ?? '-' }}</li>
                                <li><i class="fas fa-check-circle text-navy me-2"></i><strong>Status:</strong> {{ $guru->status ?? '-' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
:root {
    --navy-color: #1b5e20;
}

.text-navy { color: var(--navy-color) !important; }
.bg-navy { background-color: var(--navy-color) !important; }

.section-title { font-size: 2rem; font-weight: 700; }

.divider {
    width: 60px;
    height: 4px;
    border-radius: 2px;
    background-color: var(--navy-color);
}

.card {
    border-radius: 15px;
    transition: all 0.4s ease;
}
.card-hover:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15) !important;
}

.profile-img img {
    border: 4px solid #fff;
    transition: transform 0.3s ease;
}
.profile-img img:hover {
    transform: scale(1.05);
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
    animatedElements.forEach(el => observer.observe(el));
});
</script>
@endsection
