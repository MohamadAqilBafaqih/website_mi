@extends('pengguna.beranda-content')

@section('content')
<div class="container py-4 mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <!-- Header Section -->
            <div class="text-center mb-4 animate-fade">
                <div class="title-container position-relative d-inline-block mb-3">
                    <h2 class="fw-bold text-navy mb-2 section-title" style="font-size: 2rem; position: relative; z-index: 2;">
                        Berita Terbaru
                    </h2>
                </div>
                <div class="subtitle-wrapper mb-3">
                    <span class="subtitle-badge bg-navy text-white px-3 py-1 rounded-pill d-inline-block" style="font-size: 0.95rem; font-weight: 500;">
                        Informasi terkini seputar kegiatan dan perkembangan madrasah
                    </span>
                </div>
            </div>

            <div class="row g-4">
                @forelse($data as $item)
                    <div class="col-md-6 col-lg-4 animate-fade" data-delay="{{ $loop->index * 50 }}">
                        <div class="card h-100 shadow-lg border-0">
                            @if($item->foto)
                                <img src="{{ asset('uploads/berita/'.$item->foto) }}" 
                                     class="card-img-top" 
                                     alt="{{ $item->judul }}" 
                                     style="height: 220px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/no-image.jpg') }}" 
                                     class="card-img-top" 
                                     alt="Tidak ada gambar" 
                                     style="height: 220px; object-fit: cover;">
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $item->judul ?? 'Tanpa Judul' }}</h5>
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-calendar-event"></i> 
                                    {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : $item->created_at->format('d M Y') }}
                                </p>
                                <p class="card-text text-truncate" style="max-height: 60px;">
                                    {{ Str::limit(strip_tags($item->isi), 100, '...') }}
                                </p>
                                <a href="{{ route('pengguna.berita.show', $item->id) }}" class="btn btn-navy mt-auto">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card shadow-lg border-0 p-5 text-center animate-fade">
                            <div class="empty-state-icon mb-3">
                                <i class="fas fa-info-circle text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="text-navy mb-2">Belum ada berita yang ditambahkan</h5>
                            <p class="text-muted mb-0" style="font-size: 1rem;">Informasi sedang dalam proses pengumpulan</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $data->links('pagination::bootstrap-5') }}
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
.btn-navy { background-color: var(--navy-color); color: #fff; border: none; transition: 0.3s; }
.btn-navy:hover { background-color: #145214; color: #fff; }

.card { border-radius: 12px; overflow: hidden; transition: 0.3s; }
.card:hover { transform: translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.15) !important; }

.animate-fade { opacity: 0; transform: translateY(20px); transition: all 0.6s ease; }
.animate-fade.visible { opacity: 1; transform: translateY(0); }

.card-body h5 { font-weight: 600; }
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
                }, delay);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    animatedElements.forEach(element => { observer.observe(element); });
});
</script>
@endsection
