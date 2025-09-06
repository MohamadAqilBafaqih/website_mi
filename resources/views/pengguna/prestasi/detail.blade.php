@extends('pengguna.beranda-content')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <!-- Judul Halaman -->
            <div class="text-center mb-5 position-relative animate-fade">
                <h2 class="fw-bold text-success mb-2 section-title">Detail Prestasi Siswa</h2>
                <p class="text-muted fs-5 mb-3">
                    Informasi lengkap mengenai prestasi siswa terbaik MI Diponegoro 03 Karangklesem
                </p>
                <div class="divider mx-auto"></div>
            </div>

            <!-- Konten Utama -->
            <div class="card shadow-lg border-0 animate-fade">
                <div class="row g-0">
                    <!-- Gambar Prestasi -->
                    <div class="col-md-5">
                        <div class="prestasi-img-wrapper">
                            @if ($prestasi->foto)
                                <img src="{{ asset('uploads/prestasisiswa/' . $prestasi->foto) }}"
                                    class="img-fluid rounded-start prestasi-img" alt="{{ $prestasi->nama_prestasi }}"
                                    data-bs-toggle="modal" data-bs-target="#prestasiModal">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" class="img-fluid rounded-start"
                                    alt="No Image">
                            @endif
                        </div>
                    </div>

                    <!-- Detail Prestasi -->
                    <div class="col-md-7">
                        <div class="card-body p-4">
                            <h3 class="fw-bold mb-3 text-success">{{ $prestasi->nama_prestasi }}</h3>

                            @if ($prestasi->jenis_prestasi)
                                <span class="badge bg-success mb-3 px-3 py-2">{{ $prestasi->jenis_prestasi }}</span>
                            @endif

                            <ul class="list-unstyled mb-3">
                                <li><i class="fas fa-user me-2 text-success"></i>
                                    <strong>Nama Siswa:</strong> {{ $prestasi->nama_siswa }}
                                </li>
                                <li><i class="fas fa-school me-2 text-success"></i>
                                    <strong>Kelas:</strong> {{ $prestasi->kelas }}
                                </li>
                                <li><i class="fas fa-trophy me-2 text-success"></i>
                                    <strong>Tingkat:</strong> {{ $prestasi->tingkat ?? '-' }}
                                </li>
                                <li><i class="fas fa-crown me-2 text-success"></i>
                                    <strong>Juara:</strong> {{ $prestasi->juara ?? '-' }}
                                </li>
                                <li><i class="fas fa-calendar-alt me-2 text-success"></i>
                                    <strong>Tanggal:</strong>
                                    {{ $prestasi->tanggal ? \Carbon\Carbon::parse($prestasi->tanggal)->format('d M Y') : '-' }}
                                </li>
                                <li><i class="fas fa-building me-2 text-success"></i>
                                    <strong>Penyelenggara:</strong> {{ $prestasi->penyelenggara ?? '-' }}
                                </li>
                            </ul>


                            <p class="card-text">
                                {!! nl2br(e($prestasi->keterangan)) !!}
                            </p>

                            <a href="{{ route('pengguna.prestasi.index') }}" class="btn btn-outline-success mt-3">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Prestasi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Zoom Gambar -->
        <div class="modal fade" id="prestasiModal" tabindex="-1" aria-labelledby="prestasiModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0">
                    <div class="modal-body p-0">
                        <img src="{{ asset('uploads/prestasisiswa/' . $prestasi->foto) }}" class="img-fluid w-100"
                            alt="{{ $prestasi->nama_prestasi }}">
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .section-title {
            position: relative;
            display: inline-block;
        }

        .divider {
            width: 80px;
            height: 4px;
            background: #28a745;
            border-radius: 2px;
            margin-top: 10px;
        }

        /* Animasi fade in */
        .animate-fade {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }

        .animate-fade.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Card style */
        .card {
            border-radius: 12px;
            overflow: hidden;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15) !important;
        }

        /* Gambar */
        .prestasi-img-wrapper {
            overflow: hidden;
            height: 100%;
        }

        .prestasi-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.4s ease;
        }

        .prestasi-img:hover {
            transform: scale(1.05);
        }

        /* List */
        ul.list-unstyled li {
            padding: 6px 0;
            border-bottom: 1px solid #f1f1f1;
        }

        ul.list-unstyled li:last-child {
            border-bottom: none;
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
