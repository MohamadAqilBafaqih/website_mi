@extends('pengguna.beranda-content')

@section('content')
    <div class="container py-4 mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">

                <!-- Header Section -->
                <div class="text-center mb-4 animate-fade">
                    <div class="title-container position-relative d-inline-block mb-3">
                        <h2 class="fw-bold text-navy mb-2 section-title"
                            style="font-size: 2rem; position: relative; z-index: 2;">
                            {{ $berita->judul ?? 'Tanpa Judul' }}
                        </h2>
                    </div>
                    <div class="subtitle-wrapper mb-3">
                        <span class="subtitle-badge bg-navy text-white px-3 py-1 rounded-pill d-inline-block"
                            style="font-size: 0.95rem; font-weight: 500;">
                            MI Diponegoro 03 Karangklesem
                        </span>
                    </div>
                </div>

                <div class="card shadow-lg border-0 animate-fade">
                    @if ($berita->foto)
                        <img src="{{ asset('uploads/berita/' . $berita->foto) }}" class="card-img-top rounded-top"
                            alt="{{ $berita->judul }}" style="max-height: 450px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        <p class="text-muted small mb-3">
                            <i class="bi bi-calendar-event"></i>
                            {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') : $berita->created_at->format('d M Y') }}
                            &nbsp;|&nbsp;
                            <i class="bi bi-person-circle"></i>
                            {{ $berita->penulis ?? 'Admin' }}
                        </p>

                        <div class="card-text fs-5 lh-base">
                            {!! nl2br(e($berita->isi)) !!}
                        </div>
                    </div>

                    <div class="card-footer text-end bg-white border-0">
                        <a href="{{ route('pengguna.berita.index') }}" class="btn btn-navy">
                            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Berita
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        :root {
            --navy-color: #1b5e20;
        }

        .text-navy {
            color: var(--navy-color) !important;
        }

        .bg-navy {
            background-color: var(--navy-color) !important;
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

        .section-title {
            font-weight: 700;
        }

        .subtitle-badge {
            font-weight: 500;
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
            }, {
                threshold: 0.1
            });
            animatedElements.forEach(element => {
                observer.observe(element);
            });
        });
    </script>
@endsection
