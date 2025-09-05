@extends('pengguna.beranda-content')

@section('title', 'Kontak Sekolah')

@section('content')
<div class="container py-4 mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <!-- Header Section -->
            <div class="text-center mb-4 animate-fade">
                <div class="title-container position-relative d-inline-block mb-3">
                    <h1 class="fw-bold text-navy mb-2 section-title" style="font-size: 2rem; position: relative; z-index: 2;">
                        Kontak Sekolah
                    </h1>
                </div>
                <div class="subtitle-wrapper mb-3">
                    <span class="subtitle-badge bg-navy text-white px-3 py-1 rounded-pill d-inline-block" style="font-size: 0.95rem; font-weight: 500;">
                        MI Diponegoro 03 Karangklesem
                    </span>
                </div>
            </div>

            <div class="row g-4">
                <!-- Profil & Kontak -->
                <div class="col-lg-6">
                    <div class="card mb-4 border-0 shadow-lg animate-fade" data-delay="100">
                        <div class="card-header bg-navy text-white py-3 d-flex align-items-center">
                            <div class="icon-container bg-white text-navy rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                                <i class="fas fa-school"></i>
                            </div>
                            <h3 class="mb-0 fw-semibold" style="font-size: 1.2rem;">Profil Sekolah</h3>
                        </div>
                        <div class="card-body p-4">
                            <p>
                                MI Diponegoro 03 Karangklesem adalah madrasah ibtidaiyah unggulan yang berfokus pada
                                pengembangan iman, ilmu, dan akhlak siswa.
                                Berlokasi di Karangklesem, Purwokerto Timur, Banyumas, Jawa Tengah.
                            </p>
                            <h5 class="mt-3">Alamat</h5>
                            <p><i class="fas fa-map-marker-alt me-2"></i>Jl. Karangklesem No.12, Purwokerto Timur, Banyumas, Jawa Tengah</p>
                            <h5>NPSN</h5>
                            <p><i class="fas fa-id-card me-2"></i>60710449</p>
                            <h5>Kontak</h5>
                            <p><i class="fas fa-phone me-2"></i>(0281) 641382</p>
                            <p><i class="fas fa-envelope me-2"></i>info@midiponegoro03.sch.id</p>
                            <p><i class="fas fa-clock me-2"></i>Senin – Kamis 07.00 – 14.30 WIB, Jumat 07.00 - 11.00, Sabtu 07.00 – 14.30 WIB</p>
                        </div>
                    </div>
                </div>

                <!-- Peta Lokasi -->
                <div class="col-lg-6">
                    <div class="card mb-4 border-0 shadow-lg animate-fade" data-delay="200">
                        <div class="card-header bg-navy text-white py-3 d-flex align-items-center">
                            <div class="icon-container bg-white text-navy rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <h3 class="mb-0 fw-semibold" style="font-size: 1.2rem;">Lokasi Sekolah</h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="ratio ratio-16x9">
                                <iframe src="{{ $googleMapsLink }}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<style>
:root {
    --navy-color: #1b5e20;
}
.bg-navy { background-color: var(--navy-color) !important; }
.text-navy { color: var(--navy-color) !important; }

.card { border-radius: 12px; overflow: hidden; transition: 0.3s; }
.card:hover { transform: translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.15) !important; }

.icon-container { transition: all 0.3s ease; }
.card:hover .icon-container { transform: rotate(10deg) scale(1.1); }

.animate-fade { opacity: 0; transform: translateY(20px); transition: all 0.6s ease; }
.animate-fade.visible { opacity: 1; transform: translateY(0); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const animatedElements = document.querySelectorAll('.animate-fade');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const delay = entry.target.getAttribute('data-delay') || 0;
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, delay * 50);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    animatedElements.forEach(element => { observer.observe(element); });
});
</script>
@endsection
