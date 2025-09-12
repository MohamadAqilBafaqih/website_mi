@extends('pengguna.beranda-content')

@section('content')
<div class="container py-4 mt-3"> <!-- konsisten dengan Sejarah -->
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">

            <!-- Header Section -->
            <div class="text-center mb-4 animate-fade">
                <div class="title-container position-relative d-inline-block mb-3">
                    <h1 class="fw-bold text-navy mb-2 section-title"
                        style="font-size: 2rem; position: relative; z-index: 2;">
                        Visi & Misi
                    </h1>
                </div>

                <div class="subtitle-wrapper mb-3">
                    <span class="subtitle-badge bg-navy text-white px-3 py-1 rounded-pill d-inline-block"
                        style="font-size: 0.95rem; font-weight: 500;">
                        MI Diponegoro 03 Karangklesem
                    </span>
                </div>
            </div>

            @forelse($data as $item)
                <!-- Visi Card -->
                <div class="card mb-4 border-0 shadow-lg animate-fade" data-delay="100">
                    <div class="card-header bg-navy text-white py-3 d-flex align-items-center" style="font-size: 1rem;">
                        <div class="icon-container bg-white text-navy rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 36px; height: 36px;">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3 class="mb-0 fw-semibold" style="font-size: 1.2rem;">Visi</h3>
                    </div>
                    <div class="card-body p-4">
                        <blockquote class="blockquote text-dark fst-italic mb-0" style="font-size: 1rem; line-height: 1.7;">
                            “{{ $item->visi }}”
                        </blockquote>
                    </div>
                </div>

                <!-- Misi Card -->
                <div class="card mb-4 border-0 shadow-lg animate-fade" data-delay="200">
                    <div class="card-header bg-navy text-white py-3 d-flex align-items-center" style="font-size: 1rem;">
                        <div class="icon-container bg-white text-navy rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 36px; height: 36px;">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h3 class="mb-0 fw-semibold" style="font-size: 1.2rem;">Misi</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="history-content text-dark" style="font-size: 1rem; line-height: 1.7;">
                            @if(!empty($item->misi))
                                <ul class="misi-list ps-3 mb-0">
                                    @foreach(explode("\n", $item->misi) as $point)
                                        @if(!empty(trim($point)))
                                            <li class="mb-2">{{ $point }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted mb-0">Belum ada data misi.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="card mb-4 border-0 shadow-lg animate-fade" data-delay="100">
                    <div class="card-header bg-navy text-white py-3 d-flex align-items-center" style="font-size: 1rem;">
                        <div class="icon-container bg-white text-navy rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 36px; height: 36px;">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3 class="mb-0 fw-semibold" style="font-size: 1.2rem;">Visi & Misi</h3>
                    </div>
                    <div class="card-body p-5 text-center">
                        <div class="empty-state-icon mb-3">
                            <i class="fas fa-book-open text-muted" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="text-navy mb-2">Belum Ada Data Visi & Misi</h5>
                        <p class="text-muted mb-0" style="font-size: 1rem;">Data sedang dalam proses pengumpulan</p>
                    </div>
                </div>
            @endforelse

        </div>
    </div>
</div>

<style>
    :root {
        --navy-color: #1b5e20;
        --accent-color: #ffc107;
    }
    .bg-navy { background-color: var(--navy-color) !important; }
    .text-navy { color: var(--navy-color) !important; }

    .animate-fade {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    .animate-fade.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .card { border-radius: 12px; transition: all 0.3s ease;             height: auto;
            /* otomatis menyesuaikan isi */
            min-height: unset;}
    .card:hover { transform: translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.15) !important; }

    .card-header { border-bottom: none; position: relative; }
    .card-header::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0;
        width: 100%; height: 2px;
        background: linear-gradient(90deg, var(--accent-color), transparent);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const animatedElements = document.querySelectorAll('.animate-fade');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const delay = entry.target.getAttribute('data-delay') || 0;
                setTimeout(() => entry.target.classList.add('visible'), delay*50);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    animatedElements.forEach(element => observer.observe(element));
});
</script>
@endsection
