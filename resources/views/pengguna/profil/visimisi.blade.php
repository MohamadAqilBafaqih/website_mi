@extends('pengguna.beranda-content')

@section('content')
<div class="container py-4 mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <!-- Header Section -->
            <div class="text-center mb-4 animate-fade">
                <div class="title-container position-relative d-inline-block mb-3">
                    <h1 class="fw-bold text-navy mb-2 section-title" style="font-size: 2rem; position: relative; z-index: 2;">
                        Visi & Misi
                    </h1>
                </div>
                <div class="subtitle-wrapper mb-3">
                    <span class="subtitle-badge bg-navy text-white px-3 py-1 rounded-pill d-inline-block" style="font-size: 0.95rem; font-weight: 500;">
                        MI Diponegoro 03 Karangklesem
                    </span>
                </div>
            </div>

            @forelse($data as $item)
            <!-- Visi Card -->
            <div class="card mb-4 border-0 shadow-lg animate-fade" data-delay="100">
                <div class="card-header bg-navy text-white py-3 d-flex align-items-center">
                    <div class="icon-container bg-white text-navy rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="mb-0 fw-semibold" style="font-size: 1.2rem;">Visi</h3>
                </div>
                <div class="card-body p-4 position-relative">
                    <div class="history-icon position-absolute top-0 start-0 translate-middle">
                        <i class="fas fa-quote-left text-navy bg-white p-2 rounded-circle"></i>
                    </div>
                    <p class="fst-italic text-dark mb-0 ps-4" style="font-size: 1rem; line-height: 1.7;">"{{ $item->visi }}"</p>
                </div>
                
            </div>

            <!-- Misi Card -->
            <div class="card mb-4 border-0 shadow-lg animate-fade" data-delay="200">
                <div class="card-header bg-navy text-white py-3 d-flex align-items-center">
                    <div class="icon-container bg-white text-navy rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h3 class="mb-0 fw-semibold" style="font-size: 1.2rem;">Misi</h3>
                </div>
                <div class="card-body p-4">
                    <div class="history-content" style="font-size: 1rem; line-height: 1.7;">
                        {!! nl2br(e($item->misi)) !!}
                    </div>
                </div>
                
            </div>
            @empty
            <!-- Empty State -->
            <div class="card mb-4 border-0 shadow-lg animate-fade" data-delay="100">
                <div class="card-header bg-navy text-white py-3 d-flex align-items-center">
                    <div class="icon-container bg-white text-navy rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
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
    .bg-accent { background-color: var(--accent-color) !important; }
    .card { border-radius: 12px; overflow: hidden; transition: 0.3s; }
    .card:hover { transform: translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.15) !important; }
    .icon-container { transition: all 0.3s ease; }
    .card:hover .icon-container { transform: rotate(10deg) scale(1.1); }
    .history-icon { z-index: 1; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    .card:hover .history-icon { transform: translate(-50%, -50%) rotate(10deg); }
    .history-content { text-align: justify; }
    .empty-state-icon { transition: all 0.5s ease; }
    .card:hover .empty-state-icon { transform: scale(1.1); }
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
