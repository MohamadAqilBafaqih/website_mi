@extends('pengguna.beranda-content')

@section('content')
<div class="container py-4 mt-3"> <!-- Reduced padding -->
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <!-- Header Section - Improved -->
            <div class="text-center mb-4 animate-fade"> <!-- Reduced margin -->
                <div class="title-container position-relative d-inline-block mb-3">
                    <h1 class="fw-bold text-navy mb-2 section-title" style="font-size: 2rem; position: relative; z-index: 2;">
                        Sejarah
                    </h1>
                </div>
                
                <div class="subtitle-wrapper mb-3">
                    <span class="subtitle-badge bg-navy text-white px-3 py-1 rounded-pill d-inline-block" style="font-size: 0.95rem; font-weight: 500;">
                        MI Diponegoro 03 Karangklesem
                    </span>
                </div>
            </div>

            @forelse($data as $item)
            <!-- Sejarah Card -->
            <div class="card mb-4 border-0 shadow-lg animate-fade" data-delay="100">
                <div class="card-header bg-navy text-white py-3 d-flex align-items-center" style="font-size: 1rem;">
                    <div class="icon-container bg-white text-navy rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                        <i class="fas fa-history"></i>
                    </div>
                    <h3 class="mb-0 fw-semibold" style="font-size: 1.2rem;">Sejarah Kami</h3>
                </div>
                <div class="card-body p-4 position-relative">
                    <div class="history-icon position-absolute top-0 start-0 translate-middle">
                        <i class="fas fa-quote-left text-navy bg-white p-2 rounded-circle"></i>
                    </div>
                    <div class="history-content text-dark mb-0 ps-4" style="font-size: 1rem; line-height: 1.7;">
                        {!! nl2br(e($item->isi_sejarah)) !!}
                    </div>
                </div>
                
            </div>
            @empty
            <!-- Empty State -->
            <div class="card mb-4 border-0 shadow-lg animate-fade" data-delay="100">
                <div class="card-header bg-navy text-white py-3 d-flex align-items-center" style="font-size: 1rem;">
                    <div class="icon-container bg-white text-navy rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                        <i class="fas fa-history"></i>
                    </div>
                    <h3 class="mb-0 fw-semibold" style="font-size: 1.2rem;">Sejarah Kami</h3>
                </div>
                <div class="card-body p-5 text-center">
                    <div class="empty-state-icon mb-3">
                        <i class="fas fa-book-open text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="text-navy mb-2">Belum Ada Data Sejarah</h5>
                    <p class="text-muted mb-0" style="font-size: 1rem;">Data sejarah sedang dalam proses pengumpulan</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    :root {
        --navy-color: #1b5e20;
        --navy-hover: #0f4714;
        --accent-color: #ffc107;
        --light-accent: #fff8e1;
    }
    
    .bg-navy {
        background-color: var(--navy-color) !important;
    }
    
    .text-navy {
        color: var(--navy-color) !important;
    }
    
    .text-accent {
        color: var(--accent-color) !important;
    }
    
    .bg-accent {
        background-color: var(--accent-color) !important;
    }
    
    .animate-fade {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    
    .animate-fade.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Title Styling */
    .title-container {
        padding-bottom: 10px;
    }
    
    /* Subtitle Styling */
    .subtitle-badge {
        box-shadow: 0 4px 8px rgba(27, 94, 32, 0.2);
        transition: all 0.3s ease;
    }
    
    .subtitle-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(27, 94, 32, 0.3);
    }
    
    /* Icon Divider */
    .icon-divider i {
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }
    
    .icon-divider i:hover {
        transform: scale(1.2);
        color: var(--accent-color) !important;
    }
    
    /* Card Styles */
    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15) !important;
    }
    
    .card-header {
        border-bottom: none;
        font-weight: 600;
        position: relative;
    }
    
    .card-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, var(--accent-color), transparent);
    }
    
    .icon-container {
        transition: all 0.3s ease;
    }
    
    .card:hover .icon-container {
        transform: rotate(10deg) scale(1.1);
    }
    
    .history-icon {
        z-index: 1;
        font-size: 1.2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .card:hover .history-icon {
        transform: translate(-50%, -50%) rotate(10deg);
    }
    
    .history-content {
        text-align: justify;
    }
    
    /* Styling untuk teks sejarah */
    .history-content p {
        margin-bottom: 1.2rem;
    }
    
    /* History Badge */
    .history-badge .badge {
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    /* Empty State */
    .empty-state-icon {
        transition: all 0.5s ease;
    }
    
    .card:hover .empty-state-icon {
        transform: scale(1.1);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .section-title {
            font-size: 1.8rem !important;
        }
        
        .card-body {
            padding: 1.5rem !important;
        }
        
        .history-content {
            padding-left: 0 !important;
            font-size: 0.95rem;
        }
        
        .history-icon {
            display: none;
        }
        
        .icon-divider i {
            font-size: 1rem;
        }
        
        .card-footer {
            flex-direction: column;
            gap: 10px;
            text-align: center !important;
        }
        
        .history-badge {
            order: 2;
        }
        
        .card-footer small {
            order: 1;
        }
    }
    
    @media (max-width: 576px) {
        .container.py-4 {
            padding-top: 1.5rem !important;
            padding-bottom: 1.5rem !important;
        }
        
        .section-title {
            font-size: 1.6rem !important;
        }
        
        .subtitle-badge {
            font-size: 0.85rem !important;
        }
        
        .card-header {
            padding: 0.75rem !important;
        }
        
        .card-header h3 {
            font-size: 1.1rem !important;
        }
        
        .icon-container {
            width: 30px !important;
            height: 30px !important;
            font-size: 0.8rem;
        }
        
        .history-content {
            font-size: 0.9rem !important;
            line-height: 1.6;
        }
        
        .icon-divider i {
            margin: 0 4px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate elements on scroll
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
        
        animatedElements.forEach(element => {
            observer.observe(element);
        });
        
        // Add subtle animation to icon divider
        const dividerIcons = document.querySelectorAll('.icon-divider i');
        dividerIcons.forEach((icon, index) => {
            icon.style.animationDelay = `${index * 0.2}s`;
            icon.classList.add('animate__animated', 'animate__fadeIn');
        });
    });
</script>
@endsection