@extends('pengguna.beranda-content')

@section('content')
<div class="container py-5 mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <!-- Header Section -->
            <div class="text-center mb-5 animate-fade">
                <h1 class="fw-bold text-navy mb-3 section-title" style="font-size: 2rem;">Visi & Misi</h1>
                <p class="text-muted" style="font-size: 1.1rem;">MI Diponegoro 03 Karangklesem</p>
                <div class="divider mx-auto" style="height: 4px; width: 80px; background: var(--accent-color); border-radius: 2px;"></div>
            </div>

            @foreach($data as $item)
            <!-- Visi Card -->
            <div class="card mb-4 border-0 shadow-lg animate-fade" data-delay="100">
                <div class="card-header bg-navy text-white py-3 d-flex align-items-center" style="font-size: 1rem;">
                    <i class="fas fa-bullseye me-3 fa-lg"></i>
                    <h3 class="mb-0 fw-semibold" style="font-size: 1.2rem;">Visi</h3>
                </div>
                <div class="card-body p-4 position-relative">
                    <div class="vision-icon position-absolute top-0 start-0 translate-middle">
                        <i class="fas fa-quote-left text-navy bg-white p-2 rounded-circle"></i>
                    </div>
                    <p class="fst-italic text-dark mb-0 ps-4" style="font-size: 1rem; line-height: 1.7;">"{{ $item->visi }}"</p>
                </div>
            </div>

            <!-- Misi Card -->
            <div class="card border-0 shadow-lg animate-fade" data-delay="200">
                <div class="card-header bg-navy text-white py-3 d-flex align-items-center" style="font-size: 1rem;">
                    <i class="fas fa-tasks me-3 fa-lg"></i>
                    <h3 class="mb-0 fw-semibold" style="font-size: 1.2rem;">Misi</h3>
                </div>
                <div class="card-body p-4">
                    <div class="misi-content" style="font-size: 1rem; line-height: 1.7;">
                        {!! nl2br(e($item->misi)) !!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    :root {
        --navy-color: #1b5e20; /* Warna navy dari navbar */
        --navy-hover: #0f4714; /* Warna navy hover */
        --accent-color: #ffc107; /* Warna aksen */
    }
    
    .bg-navy {
        background-color: var(--navy-color) !important;
    }
    
    .text-navy {
        color: var(--navy-color) !important;
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
    }
    
    .vision-icon {
        z-index: 1;
        font-size: 1.2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    /* Styling untuk poin-poin bernomor */
    .misi-content span.text-success {
        color: var(--navy-color) !important;
        font-weight: 600;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .section-title {
            font-size: 1.8rem !important;
        }
        
        .card-body {
            padding: 1.5rem !important;
        }
        
        .vision-icon {
            display: none;
        }
        
        .ps-4 {
            padding-left: 0 !important;
        }
    }
    
    @media (max-width: 576px) {
        .container.py-5 {
            padding-top: 2rem !important;
            padding-bottom: 2rem !important;
        }
        
        .section-title {
            font-size: 1.6rem !important;
        }
        
        .card-header {
            padding: 1rem !important;
        }
        
        .card-header h3 {
            font-size: 1.1rem !important;
        }
        
        .misi-content, .fst-italic {
            font-size: 0.9rem !important;
            line-height: 1.6 !important;
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
                    // Add delay based on data-delay attribute
                    const delay = entry.target.getAttribute('data-delay') || 0;
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, delay * 50);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        
        animatedElements.forEach(element => {
            observer.observe(element);
        });
        
        // Format misi text with better styling
        const misiContents = document.querySelectorAll('.misi-content');
        misiContents.forEach(content => {
            let text = content.innerHTML;
            // Add styling to numbered items
            text = text.replace(/(\d+\.)\s/g, '<span class="text-navy fw-bold">$1</span> ');
            content.innerHTML = text;
        });
    });
</script>
@endsection