@extends('pengguna.beranda-content')

@section('title', 'Kalender Akademik')

@section('content')
<div class="container py-4 mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <!-- Header Section -->
            <div class="text-center mb-4 animate-fade">
                <div class="title-container position-relative d-inline-block mb-3">
                    <h2 class="fw-bold text-navy mb-2 section-title" style="font-size: 2rem; position: relative; z-index: 2;">
                        Kalender Akademik
                    </h2>
                </div>
                <div class="subtitle-wrapper mb-3">
                    <span class="subtitle-badge bg-navy text-white px-3 py-1 rounded-pill d-inline-block" style="font-size: 0.95rem; font-weight: 500;">
                        MI Diponegoro 03 Karangklesem
                    </span>
                </div>
            </div>

            @if($data && ($data->kalender_akademik || $data->kalender))
                <div class="card mb-4 border-0 shadow-lg animate-fade" data-delay="100">
                    <div class="card-header bg-navy text-white py-3 d-flex align-items-center">
                        <div class="icon-container bg-white text-navy rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                            <i class="fas fa-calendar-days"></i>
                        </div>
                        <h5 class="mb-0 fw-semibold">Informasi Kalender Akademik</h5>
                    </div>
                    <div class="card-body p-4 text-center">

                        {{-- Gambar Kalender --}}
                        @if($data->kalender_akademik)
                            <div class="mb-4">
                                <img src="{{ asset('uploads/ppdb/' . $data->kalender_akademik) }}" 
                                     alt="Kalender Akademik" 
                                     class="img-fluid rounded shadow-sm" 
                                     style="max-height:500px; object-fit:contain;">
                            </div>

                            <div class="mb-4">
                                <a href="{{ asset('uploads/ppdb/' . $data->kalender_akademik) }}" 
                                   class="btn btn-success px-4 py-2" 
                                   download>
                                    <i class="fas fa-download me-2"></i> Download Kalender
                                </a>
                            </div>
                        @endif

                        {{-- Teks Kalender --}}
                        @if($data->kalender)
                            <ul class="list-group list-group-flush text-start">
                                @foreach(preg_split("/\r\n|\n|\r/", $data->kalender) as $item)
                                    @if(trim($item) !== '')
                                        <li class="list-group-item">{{ $item }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif

                        {{-- Empty State --}}
                        @if(!$data->kalender_akademik && !$data->kalender)
                            <div class="p-5">
                                <div class="empty-state-icon mb-3">
                                    <i class="fas fa-info-circle text-muted" style="font-size: 3rem;"></i>
                                </div>
                                <h5 class="text-navy mb-2">Belum ada informasi kalender akademik</h5>
                                <p class="text-muted mb-0" style="font-size: 1rem;">Informasi sedang dalam proses pengumpulan</p>
                            </div>
                        @endif

                    </div>
                    <div class="card-footer bg-light text-muted text-end">
                        <small>Terakhir diperbarui: {{ $data ? \Carbon\Carbon::parse($data->updated_at)->format('d F Y') : '-' }}</small>
                    </div>
                </div>
            @else
                <div class="card mb-4 border-0 shadow-lg animate-fade" data-delay="100">
                    <div class="card-header bg-navy text-white py-3 d-flex align-items-center">
                        <div class="icon-container bg-white text-navy rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                            <i class="fas fa-calendar-days"></i>
                        </div>
                        <h5 class="mb-0 fw-semibold">Kalender Akademik</h5>
                    </div>
                    <div class="card-body p-5 text-center">
                        <div class="empty-state-icon mb-3">
                            <i class="fas fa-info-circle text-muted" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="text-navy mb-2">Belum ada informasi kalender akademik</h5>
                        <p class="text-muted mb-0" style="font-size: 1rem;">Informasi sedang dalam proses pengumpulan</p>
                    </div>
                </div>
            @endif

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
