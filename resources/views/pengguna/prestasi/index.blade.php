@extends('pengguna.beranda-content')

@section('content')
    <div class="container py-4 mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">

                <!-- Header Section -->
                <div class="text-center mb-4 animate-fade">
                    <div class="title-container position-relative d-inline-block mb-3">
                        <h2 class="fw-bold text-navy mb-2 section-title" style="font-size: 2rem;">
                            Prestasi Siswa
                        </h2>
                    </div>
                    <div class="subtitle-wrapper mb-3">
                        <span class="subtitle-badge bg-navy text-white px-3 py-1 rounded-pill d-inline-block"
                            style="font-size: 0.95rem; font-weight: 500;">
                            MI Diponegoro 03 Karangklesem
                        </span>
                    </div>

                    <!-- Tombol Filter -->
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="{{ route('pengguna.prestasi.index') }}"
                            class="btn btn-outline-navy {{ request('kategori') == null ? 'active' : '' }}">
                            Semua
                        </a>
                        <a href="{{ route('pengguna.prestasi.index', ['kategori' => 'akademik']) }}"
                            class="btn btn-outline-navy {{ request('kategori') == 'akademik' ? 'active' : '' }}">
                            Lomba Akademik
                        </a>
                        <a href="{{ route('pengguna.prestasi.index', ['kategori' => 'non-akademik']) }}"
                            class="btn btn-outline-navy {{ request('kategori') == 'non-akademik' ? 'active' : '' }}">
                            Lomba Non Akademik
                        </a>
                    </div>
                </div>

                <!-- Daftar Prestasi -->
                <div class="row g-4">
                    @forelse($data as $prestasi)
                        <div class="col-md-4 animate-fade" data-delay="{{ $loop->index * 50 }}">
                            <div class="card h-100 shadow-lg border-0">
                                <!-- Foto -->
                                @if ($prestasi->foto)
                                    <img src="{{ asset('uploads/prestasisiswa/' . $prestasi->foto) }}" class="card-img-top"
                                        alt="{{ $prestasi->nama_prestasi }}" style="height: 220px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top"
                                        alt="Tidak ada gambar" style="height: 220px; object-fit: cover;">
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $prestasi->nama_prestasi }}</h5>

                                    <!-- Jenis Prestasi + Juara -->
                                    <div class="d-flex flex-wrap gap-2 mb-2">
                                        @if ($prestasi->jenis_prestasi)
                                            <span class="badge bg-navy" style="font-size: 0.85rem;">
                                                <i class="fas fa-user-graduate me-1"></i>
                                                {{ ucfirst($prestasi->jenis_prestasi) }}
                                            </span>
                                        @endif

                                        @if ($prestasi->juara)
                                            <span class="badge bg-navy" style="font-size: 0.85rem;">
                                                <i class="fas fa-crown me-1"></i>
                                                {{ $prestasi->juara }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Tanggal -->
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $prestasi->tanggal ? \Carbon\Carbon::parse($prestasi->tanggal)->format('d M Y') : $prestasi->created_at->format('d M Y') }}
                                    </p>

                                    <!-- Keterangan Singkat -->
                                    <p class="card-text text-truncate" style="max-height: 60px;">
                                        {{ Str::limit(strip_tags($prestasi->keterangan), 100, '...') }}
                                    </p>

                                    <!-- Tombol Detail -->
                                    <a href="{{ route('pengguna.prestasi.show', $prestasi->id) }}"
                                        class="btn btn-navy mt-auto">
                                        Lihat Detail
                                    </a>
                                </div>

                            </div>
                        </div>
                    @empty
                        <!-- Jika Kosong -->
                        <div class="col-12">
                            <div class="card shadow-lg border-0 p-5 text-center animate-fade">
                                <div class="empty-state-icon mb-3">
                                    <i class="fas fa-info-circle text-muted" style="font-size: 3rem;"></i>
                                </div>
                                <h5 class="text-navy mb-2">Belum ada prestasi yang ditambahkan</h5>
                                <p class="text-muted mb-0" style="font-size: 1rem;">
                                    Informasi prestasi sedang dalam proses pengumpulan
                                </p>
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

    <!-- Styling -->
    <style>
        :root {
            --navy-color: #1b5e20;
        }

        .bg-navy {
            background-color: var(--navy-color) !important;
        }

        .text-navy {
            color: var(--navy-color) !important;
        }

        .btn-navy {
            background-color: var(--navy-color);
            color: #fff;
            border: none;
            transition: 0.3s;
        }

        .btn-navy:hover {
            background-color: #145214;
            color: #fff;
        }

        .btn-outline-navy {
            border: 2px solid var(--navy-color);
            color: var(--navy-color);
            background: transparent;
            transition: 0.3s;
        }

        .btn-outline-navy:hover,
        .btn-outline-navy.active {
            background: var(--navy-color);
            color: #fff;
        }

        .card {
            border-radius: 12px;
            overflow: hidden;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15) !important;
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

        .empty-state-icon {
            transition: all 0.5s ease;
        }

        .card:hover .empty-state-icon {
            transform: scale(1.1);
        }
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
            }, {
                threshold: 0.1
            });
            animatedElements.forEach(element => {
                observer.observe(element);
            });
        });
    </script>
@endsection
