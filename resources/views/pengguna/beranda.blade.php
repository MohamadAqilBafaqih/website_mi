@extends('pengguna.beranda-content')

@section('content')
    <section class="hero-banner">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" style="min-height: 85vh;">
            <div class="carousel-inner">
                @for ($i = 1; $i <= 3; $i++)
                    @php $fotoField = 'foto_slide' . $i; @endphp
                    @if ($pengumuman && $pengumuman->$fotoField)
                        <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                            <img src="{{ asset('uploads/pengumuman/' . $pengumuman->$fotoField) }}" class="d-block w-100"
                                alt="Slide {{ $i }}"
                                style="object-fit: cover; height: 85vh; filter: brightness(70%);">
                            <div class="carousel-caption d-flex flex-column justify-content-center h-100">
                                <div class="container animate-fade">
                                    <h1 class="hero-title">Selamat Datang di <br>
                                        <span class="highlight">MI Diponegoro 03 Karangklesem</span>
                                    </h1>
                                    <p class="hero-subtitle">Madrasah Unggul dalam Iman, Ilmu, dan Akhlak Mulia</p>
                                    <div class="hero-buttons">
                                        <a href="{{ route('pendaftaran.create') }}"
                                            class="btn btn-navy rounded-pill px-4 pulse">
                                            <i class="fas fa-user-plus me-2"></i> Daftar PPDB
                                        </a>
                                        <a href="#akreditasi" class="btn btn-outline-navy rounded-pill px-4">
                                            <i class="fas fa-compass me-2"></i> Jelajahi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>

            <!-- Kontrol carousel -->
            <button class="carousel-control-prev custom-control" type="button" data-bs-target="#heroCarousel"
                data-bs-slide="prev">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="carousel-control-next custom-control" type="button" data-bs-target="#heroCarousel"
                data-bs-slide="next">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Indikator -->
            <div class="carousel-indicators-custom">
                @for ($i = 1; $i <= 3; $i++)
                    @php $fotoField = 'foto_slide' . $i; @endphp
                    @if ($pengumuman && $pengumuman->$fotoField)
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i - 1 }}"
                            class="{{ $i == 1 ? 'active' : '' }}"></button>
                    @endif
                @endfor
            </div>
        </div>

        <!-- Running teks -->
        @if ($pengumuman && !empty($pengumuman->running_teks))
            <div class="running-text">
                <i class="fas fa-bullhorn me-2"></i>
                <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                    {{ $pengumuman->running_teks }}
                </marquee>
            </div>
        @endif
    </section>

    <style>
        :root {
            --navy-color: #1b5e20;
            --light-navy: rgba(27, 94, 32, 0.1);
        }

        .hero-banner {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: 0 0 20px 20px;
        }

        .hero-title {
            font-size: 3.2rem;
            font-weight: 800;
            line-height: 1.3;
            color: #fff;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);
            margin-bottom: 1rem;
        }

        .hero-title .highlight {
            color: #FFD700;
        }

        .hero-subtitle {
            font-size: 1.4rem;
            color: rgba(255, 255, 255, 0.9);
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 2rem;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: center;
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
            transform: translateY(-2px);
        }

        .btn-outline-navy {
            border: 2px solid #fff;
            color: #fff;
            transition: 0.3s;
        }

        .btn-outline-navy:hover {
            background-color: #fff;
            color: var(--navy-color);
        }

        .custom-control {
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            background: var(--navy-color);
            border-radius: 50%;
            border: none;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.8;
            transition: 0.3s;
        }

        .custom-control:hover {
            opacity: 1;
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-indicators-custom {
            position: absolute;
            bottom: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
            width: 100%;
        }

        .carousel-indicators-custom button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.6);
            transition: all 0.3s ease;
        }

        .carousel-indicators-custom button.active {
            width: 28px;
            border-radius: 8px;
            background: #fff;
        }

        .running-text {
            background: var(--navy-color);
            color: #fff;
            padding: 12px;
            font-size: 1rem;
            display: flex;
            align-items: center;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(27, 94, 32, 0.7);
            }

            70% {
                box-shadow: 0 0 0 12px rgba(27, 94, 32, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(27, 94, 32, 0);
            }
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
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll('.animate-fade');
            animatedElements.forEach(el => {
                el.classList.add('visible');
            });
        });
    </script>

    <!-- Sambutan Kepala Sekolah -->
    @if ($kepalaSekolah)
        <section class="py-5 bg-light" id="sambutan">
            <div class="container">
                <h2 class="section-title text-center mb-5">Sambutan Kepala Sekolah</h2>
                <div class="row align-items-center">
                    <!-- Foto Kepala Sekolah -->
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        @if ($kepalaSekolah->foto)
                            <img src="{{ asset('uploads/sambutan/' . $kepalaSekolah->foto) }}"
                                class="img-fluid rounded shadow-sm" alt="{{ $kepalaSekolah->nama }}">
                        @else
                            <img src="{{ asset('gambar/default-user.png') }}" class="img-fluid rounded shadow-sm"
                                alt="Foto Kepala Sekolah">
                        @endif
                    </div>

                    <!-- Nama & Sambutan -->
                    <div class="col-md-8">
                        <h3 class="fw-bold text-success mb-3">{{ $kepalaSekolah->nama }}</h3>
                        <p class="text-muted">{{ $kepalaSekolah->sambutan }}</p>
                    </div>
                </div>
            </div>
        </section>
    @endif


    <section class="py-5 bg-light" id="akreditasi">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title display-5 fw-bold text-navy mb-3">
                    <i class="fas fa-certificate text-warning me-2"></i> Akreditasi Madrasah
                </h2>
                <p class="lead text-muted animate-fade" style="animation-delay: 0.2s;">
                    Bukti komitmen kami terhadap kualitas pendidikan yang unggul
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10 animate-fade" style="animation-delay: 0.3s;">
                    <div
                        class="card shadow-lg border-0 rounded-4 bg-gradient-navy text-white position-relative overflow-hidden card-hover">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-8 p-5">
                                <div class="card-body p-0">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="bg-warning p-3 rounded-circle me-3">
                                            <i class="fas fa-certificate fa-2x text-navy"></i>
                                        </div>
                                        <h3 class="fw-bold mb-0">Akreditasi A (Unggul)</h3>
                                    </div>
                                    <p class="lead mb-4">
                                        MI Diponegoro 03 Karangklesem telah resmi terakreditasi dengan predikat
                                        <span class="fw-bold text-uppercase text-warning">A (Unggul)</span>
                                        dari Badan Akreditasi Nasional, sebagai bukti komitmen kami dalam
                                        menyelenggarakan pendidikan berkualitas tinggi.
                                    </p>
                                    <div class="d-flex flex-wrap gap-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-check-circle text-warning me-2"></i>
                                            <span>Standar Nasional Pendidikan</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-check-circle text-warning me-2"></i>
                                            <span>Fasilitas Lengkap</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-check-circle text-warning me-2"></i>
                                            <span>Pengajar Berkualitas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center p-4">
                                <div class="position-relative">
                                    <img src="{{ asset('gambar/akreditasia.png') }}" alt="Akreditasi A"
                                        class="img-fluid rounded-4 img-hover shadow"
                                        style="max-width: 220px; border: 4px solid rgba(255,255,255,0.3);">
                                    <div class="mt-4">
                                        <a href="{{ asset('gambar/akreditasia.png') }}"
                                            class="btn btn-light btn-sm rounded-pill px-3 py-2" data-fancybox="gallery"
                                            data-caption="Sertifikat Akreditasi A (Unggul)">
                                            <i class="fas fa-expand me-2 text-navy"></i> Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Decorative elements -->
                        <div class="position-absolute top-0 end-0 mt-4 me-4 opacity-25">
                            <i class="fas fa-star fa-3x text-warning"></i>
                        </div>
                        <div class="position-absolute bottom-0 start-0 mb-4 ms-4 opacity-25">
                            <i class="fas fa-award fa-3x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-4 animate-fade" style="animation-delay: 0.4s;">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="card-body text-center p-4">
                            <div class="bg-navy-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px;">
                                <i class="fas fa-graduation-cap fa-2x text-navy"></i>
                            </div>
                            <h5 class="fw-bold text-navy">Kurikulum Unggul</h5>
                            <p class="text-muted mb-0">Kurikulum terstandar nasional dengan pengembangan karakter Islami
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 animate-fade" style="animation-delay: 0.5s;">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="card-body text-center p-4">
                            <div class="bg-navy-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px;">
                                <i class="fas fa-users fa-2x text-navy"></i>
                            </div>
                            <h5 class="fw-bold text-navy">Guru Berkompeten</h5>
                            <p class="text-muted mb-0">Didukung oleh tenaga pendidik profesional dan berpengalaman</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 animate-fade" style="animation-delay: 0.6s;">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="card-body text-center p-4">
                            <div class="bg-navy-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px;">
                                <i class="fas fa-book-open fa-2x text-navy"></i>
                            </div>
                            <h5 class="fw-bold text-navy">Fasilitas Lengkap</h5>
                            <p class="text-muted mb-0">Ruang belajar nyaman dan sarana prasarana yang memadai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            :root {
                --navy-color: #1b5e20;
                --navy-light: rgba(27, 94, 32, 0.1);
                --gradient-start: #1b5e20;
                --gradient-end: #2e7d32;
            }

            .text-navy {
                color: var(--navy-color) !important;
            }

            .bg-navy-light {
                background-color: var(--navy-light) !important;
            }

            .bg-gradient-navy {
                background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end)) !important;
            }

            .card {
                border-radius: 16px;
                transition: all 0.4s ease;
                overflow: hidden;
            }

            .card-hover:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
            }

            .img-hover {
                transition: transform 0.6s ease;
            }

            .card-hover:hover .img-hover {
                transform: scale(1.05);
            }

            .section-title {
                position: relative;
                display: inline-block;
                padding-bottom: 15px;
            }

            .section-title::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 80px;
                height: 4px;
                background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
                border-radius: 2px;
            }

            .animate-fade {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.8s ease;
            }

            .animate-fade.visible {
                opacity: 1;
                transform: translateY(0);
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const animatedElements = document.querySelectorAll('.animate-fade');
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            setTimeout(() => {
                                entry.target.classList.add('visible');
                            }, parseInt(entry.target.style.animationDelay || '0') * 1000);
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1
                });
                animatedElements.forEach(element => {
                    observer.observe(element);
                });

                // Inisialisasi fancybox jika diperlukan
                if (typeof Fancybox !== 'undefined') {
                    Fancybox.bind("[data-fancybox]", {
                        // Options here
                    });
                }
            });
        </script>
    </section>



    <section class="py-5 bg-light" id="brosur">
        <div class="container">

            <!-- Konten Brosur -->
            <div class="row justify-content-center">
                <div class="col-md-8 animate-fade">
                    <div class="info-card shadow-lg rounded-4 p-4 bg-white h-100 card-hover text-center">
                        <div class="brosur-img mb-4">
                            @if ($data->isNotEmpty() && $data->first()->brosur)
                                <img src="{{ asset('uploads/ppdb/' . $data->first()->brosur) }}" alt="Brosur PPDB"
                                    class="img-fluid rounded shadow-sm" style="max-height:250px;">
                            @endif

                        </div>

                        <h4 class="fw-bold text-dark">Brosur PPDB MI Diponegoro 03</h4>
                        <p class="text-muted mt-2 px-3">
                            Brosur resmi yang dirilis oleh MI Diponegoro 03 Karangklesem ini memuat seluruh informasi
                            penting
                            mengenai Pendaftaran Peserta Didik Baru.
                        </p>

                        @if (isset($data) && $data->isNotEmpty() && $data->first()->brosur)
                            <a href="{{ asset('uploads/ppdb/' . $data->first()->brosur) }}"
                                class="btn btn-success mt-4 px-4 py-2" download>
                                <i class="fas fa-download me-2"></i> Download Brosur
                            </a>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <style>
            /* Section Title */
            .section-title {
                font-size: 2rem;
            }

            .title-underline {
                display: block;
                width: 80px;
                height: 4px;
                background: #28a745;
                margin: 10px auto 0;
                border-radius: 50px;
            }

            /* Card hover & animasi */
            .info-card {
                transition: all 0.4s ease;
                min-height: 520px;
            }

            .card-hover:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            }

            /* Gambar brosur */
            .brosur-img img {
                max-height: 350px;
                object-fit: cover;
                width: 100%;
                border-radius: 12px;
                transition: transform 0.4s ease;
            }

            .info-card:hover .brosur-img img {
                transform: scale(1.05);
            }

            /* Tombol download */
            .btn-success {
                background: linear-gradient(135deg, #28a745 0%, #218838 100%);
                border: none;
                border-radius: 50px;
                padding: 12px 30px;
                font-weight: 600;
                color: #fff;
                transition: all 0.3s ease;
            }

            .btn-success:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(40, 167, 69, 0.6);
            }

            /* Animasi fade-in */
            .animate-fade {
                opacity: 0;
                transform: translateY(20px);
                transition: all 0.6s ease;
            }

            .animate-fade.visible {
                opacity: 1;
                transform: translateY(0);
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
                animatedElements.forEach(el => observer.observe(el));
            });
        </script>
    </section>


    <section class="py-5 bg-light" id="prestasi">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title display-5 fw-bold text-navy mb-3 animate-fade">Prestasi Siswa</h2>
                <p class="lead text-muted animate-fade" style="animation-delay: 0.2s;">Menghargai setiap usaha dan
                    pencapaian luar biasa siswa kami</p>
            </div>

            <div class="row g-4">
                @foreach ($prestasiTerbaru as $prestasi)
                    <div class="col-md-4 animate-fade" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                        <div class="card h-100 shadow-sm border-0 position-relative card-hover">
                            @if ($prestasi->foto)
                                <div class="overflow-hidden position-relative">
                                    <img src="{{ asset('uploads/prestasisiswa/' . $prestasi->foto) }}"
                                        class="card-img-top img-hover" alt="{{ $prestasi->nama_prestasi }}"
                                        style="height: 250px; object-fit: cover;">
                                    <div class="position-absolute top-0 start-0 m-3">
                                        <span class="badge bg-warning text-dark px-3 py-2">
                                            <i class="fas fa-trophy me-1"></i>{{ $prestasi->tingkat ?? 'Prestasi' }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3 small text-muted">
                                    <span><i
                                            class="far fa-calendar-alt me-1"></i>{{ $prestasi->created_at->format('d M Y') }}</span>
                                    <span><i class="fas fa-user-graduate me-1"></i> Siswa</span>
                                </div>
                                <h5 class="card-title fw-bold text-navy mb-3">{{ $prestasi->nama_prestasi }}</h5>
                                <p class="card-text text-muted mb-4">
                                    {{ Str::limit($prestasi->keterangan ?? '-', 120) }}
                                </p>
                            </div>
                            <div class="card-footer bg-transparent border-0 pt-0 pb-4 px-4">
                                <a href="{{ route('pengguna.prestasi.show', $prestasi->id) }}"
                                    class="btn btn-navy btn-sm rounded-pill px-4 py-2 d-inline-flex align-items-center">
                                    Lihat Detail <i class="fas fa-arrow-right ms-2 small"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5 animate-fade" style="animation-delay: 0.4s;">
                <a href="{{ route('pengguna.prestasi.index') }}"
                    class="btn btn-navy btn-lg rounded-pill px-5 py-3 d-inline-flex align-items-center">
                    Lihat Semua Prestasi <i class="fas fa-arrow-right ms-3"></i>
                </a>
            </div>
        </div>

        <style>
            :root {
                --navy-color: #1b5e20;
                --navy-light: rgba(27, 94, 32, 0.1);
                --gradient-start: #1b5e20;
                --gradient-end: #2e7d32;
            }

            .text-navy {
                color: var(--navy-color) !important;
            }

            .btn-navy {
                background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
                color: #fff;
                border: none;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(27, 94, 32, 0.2);
                font-weight: 600;
            }

            .btn-navy:hover {
                background: linear-gradient(135deg, var(--gradient-end), var(--gradient-start));
                color: #fff;
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(27, 94, 32, 0.3);
            }

            .card {
                border-radius: 16px;
                transition: all 0.4s ease;
                overflow: hidden;
                background: #fff;
            }

            .card-hover:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
            }

            .img-hover {
                transition: transform 0.6s ease;
            }

            .card-hover:hover .img-hover {
                transform: scale(1.08);
            }

            .section-title {
                position: relative;
                display: inline-block;
                padding-bottom: 15px;
            }

            .section-title::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 80px;
                height: 4px;
                background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
                border-radius: 2px;
            }

            .animate-fade {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.8s ease;
            }

            .animate-fade.visible {
                opacity: 1;
                transform: translateY(0);
            }

            .badge {
                font-weight: 500;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const animatedElements = document.querySelectorAll('.animate-fade');
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            setTimeout(() => {
                                entry.target.classList.add('visible');
                            }, parseInt(entry.target.style.animationDelay || '0') * 1000);
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
    </section>

    <section class="py-5 bg-light" id="news">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title display-5 fw-bold text-navy mb-3 animate-fade">Berita Terbaru</h2>
                <p class="lead text-muted animate-fade" style="animation-delay: 0.2s;">Ikuti informasi terbaru dan
                    kegiatan terkini dari sekolah kami</p>
            </div>

            <div class="row g-4">
                @foreach ($beritaTerbaru as $berita)
                    <div class="col-md-4 animate-fade" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                        <div class="card h-100 shadow-sm border-0 position-relative card-hover">
                            @if ($berita->foto)
                                <div class="overflow-hidden position-relative">
                                    <img src="{{ asset('uploads/berita/' . $berita->foto) }}"
                                        class="card-img-top img-hover" alt="{{ $berita->judul }}"
                                        style="height: 250px; object-fit: cover;">
                                    <div class="position-absolute top-0 start-0 m-3">
                                        <span class="badge bg-info text-dark px-3 py-2">
                                            <i class="far fa-newspaper me-1"></i> Berita
                                        </span>
                                    </div>
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3 small text-muted">
                                    <span><i
                                            class="far fa-calendar-alt me-1"></i>{{ $berita->created_at->format('d M Y') }}</span>
                                    <span><i class="far fa-eye me-1"></i> {{ $berita->views ?? 245 }}</span>
                                </div>
                                <h5 class="card-title fw-bold text-navy mb-3">{{ $berita->judul }}</h5>
                                <p class="card-text text-muted mb-4">
                                    {{ Str::limit(strip_tags($berita->isi), 120) }}
                                </p>
                            </div>
                            <div class="card-footer bg-transparent border-0 pt-0 pb-4 px-4">
                                <a href="{{ route('pengguna.berita.show', $berita->id) }}"
                                    class="btn btn-navy btn-sm rounded-pill px-4 py-2 d-inline-flex align-items-center">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ms-2 small"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5 animate-fade" style="animation-delay: 0.4s;">
                <a href="{{ route('pengguna.berita.index') }}"
                    class="btn btn-navy btn-lg rounded-pill px-5 py-3 d-inline-flex align-items-center">
                    Lihat Semua Berita <i class="fas fa-arrow-right ms-3"></i>
                </a>
            </div>
        </div>

        <style>
            :root {
                --navy-color: #1b5e20;
                --navy-light: rgba(27, 94, 32, 0.1);
                --gradient-start: #1b5e20;
                --gradient-end: #2e7d32;
            }

            .text-navy {
                color: var(--navy-color) !important;
            }

            .btn-navy {
                background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
                color: #fff;
                border: none;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(27, 94, 32, 0.2);
                font-weight: 600;
            }

            .btn-navy:hover {
                background: linear-gradient(135deg, var(--gradient-end), var(--gradient-start));
                color: #fff;
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(27, 94, 32, 0.3);
            }

            .card {
                border-radius: 16px;
                transition: all 0.4s ease;
                overflow: hidden;
                background: #fff;
            }

            .card-hover:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
            }

            .img-hover {
                transition: transform 0.6s ease;
            }

            .card-hover:hover .img-hover {
                transform: scale(1.08);
            }

            .section-title {
                position: relative;
                display: inline-block;
                padding-bottom: 15px;
            }

            .section-title::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 80px;
                height: 4px;
                background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
                border-radius: 2px;
            }

            .animate-fade {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.8s ease;
            }

            .animate-fade.visible {
                opacity: 1;
                transform: translateY(0);
            }

            .badge {
                font-weight: 500;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .badge.bg-info {
                background: linear-gradient(135deg, #17a2b8, #138496) !important;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const animatedElements = document.querySelectorAll('.animate-fade');
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            setTimeout(() => {
                                entry.target.classList.add('visible');
                            }, parseInt(entry.target.style.animationDelay || '0') * 1000);
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
    </section>

    <!-- Galeri Foto -->
    <section class="py-5 bg-light" id="gallery">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title display-5 fw-bold text-navy mb-3 animate-fade">Galeri Foto</h2>
                <p class="lead text-muted animate-fade" style="animation-delay: 0.2s;">Momen berharga dan kegiatan seru di
                    sekolah kami</p>
            </div>

            <div class="row g-4">
                @foreach ($galeriFoto as $foto)
                    <div class="col-6 col-md-4 col-lg-3 animate-fade"
                        style="animation-delay: {{ $loop->index * 0.1 }}s;">
                        <div class="gallery-card overflow-hidden rounded-4 shadow-sm position-relative card-hover">
                            <img src="{{ asset('uploads/galeri_kegiatan/' . $foto->foto) }}" class="gallery-img w-100"
                                alt="{{ $foto->judul_kegiatan }}" style="height: 220px; object-fit: cover;"
                                data-bs-toggle="modal" data-bs-target="#galleryModal"
                                data-bs-img="{{ asset('uploads/galeri_kegiatan/' . $foto->foto) }}"
                                data-bs-caption="{{ $foto->judul_kegiatan }}">
                            <div
                                class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-3">
                                <h6 class="text-white mb-0 fw-bold">{{ Str::limit($foto->judul_kegiatan, 30) }}</h6>
                                <small class="text-light opacity-75">{{ $foto->created_at->format('d M Y') }}</small>
                            </div>
                            <div class="zoom-icon position-absolute top-50 start-50 translate-middle">
                                <i class="fas fa-search-plus fa-2x text-white bg-navy rounded-circle p-3"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5 animate-fade" style="animation-delay: 0.4s;">
                <a href="{{ route('pengguna.galeri.index') }}"
                    class="btn btn-navy btn-lg rounded-pill px-5 py-3 d-inline-flex align-items-center">
                    Lihat Galeri Lengkap <i class="fas fa-arrow-right ms-3"></i>
                </a>
            </div>
        </div>

        <!-- Modal Preview -->
        <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content border-0 rounded-4 overflow-hidden">
                    <div class="modal-body p-0 position-relative">
                        <button type="button"
                            class="btn-close position-absolute top-0 end-0 m-3 bg-light rounded-circle p-2"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                        <img src="" id="galleryModalImg" class="w-100"
                            style="max-height: 80vh; object-fit: contain;" alt="">
                        <div class="caption p-4 text-center bg-dark text-white">
                            <h5 class="mb-0" id="galleryModalCaption"></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            :root {
                --navy-color: #1b5e20;
                --navy-light: rgba(27, 94, 32, 0.1);
                --gradient-start: #1b5e20;
                --gradient-end: #2e7d32;
            }

            .text-navy {
                color: var(--navy-color) !important;
            }

            .bg-navy {
                background-color: var(--navy-color) !important;
            }

            .btn-navy {
                background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
                color: #fff;
                border: none;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(27, 94, 32, 0.2);
                font-weight: 600;
            }

            .btn-navy:hover {
                background: linear-gradient(135deg, var(--gradient-end), var(--gradient-start));
                color: #fff;
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(27, 94, 32, 0.3);
            }

            .gallery-card {
                cursor: pointer;
                transition: all 0.4s ease;
                border-radius: 16px;
                overflow: hidden;
            }

            .gallery-card:hover {
                transform: translateY(-8px) scale(1.03);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2) !important;
            }

            .gallery-card .overlay {
                background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0) 100%);
                opacity: 0;
                transition: opacity 0.4s ease;
            }

            .gallery-card:hover .overlay {
                opacity: 1;
            }

            .gallery-card .zoom-icon {
                opacity: 0;
                transform: scale(0.8);
                transition: all 0.4s ease;
                z-index: 2;
            }

            .gallery-card:hover .zoom-icon {
                opacity: 1;
                transform: scale(1) translate(-50%, -50%);
            }

            .section-title {
                position: relative;
                display: inline-block;
                padding-bottom: 15px;
            }

            .section-title::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 80px;
                height: 4px;
                background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
                border-radius: 2px;
            }

            .animate-fade {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.8s ease;
            }

            .animate-fade.visible {
                opacity: 1;
                transform: translateY(0);
            }

            .modal-content {
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            }

            .btn-close {
                opacity: 0.8;
                transition: all 0.3s ease;
                z-index: 10;
            }

            .btn-close:hover {
                opacity: 1;
                transform: rotate(90deg);
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Animate fade-in
                const animateElems = document.querySelectorAll('.animate-fade');
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            setTimeout(() => {
                                entry.target.classList.add('visible');
                            }, parseInt(entry.target.style.animationDelay || '0') * 1000);
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1
                });
                animateElems.forEach(el => observer.observe(el));

                // Modal image preview
                const modal = document.getElementById('galleryModal');
                const modalImg = document.getElementById('galleryModalImg');
                const modalCaption = document.getElementById('galleryModalCaption');
                const imgs = document.querySelectorAll('.gallery-img');

                imgs.forEach(img => {
                    img.addEventListener('click', function() {
                        modalImg.src = this.dataset.bsImg;
                        modalCaption.textContent = this.dataset.bsCaption;
                    });
                });

                // Enhanced modal functionality
                modal.addEventListener('shown.bs.modal', function() {
                    modalImg.style.opacity = '0';
                    setTimeout(() => {
                        modalImg.style.transition = 'opacity 0.5s ease';
                        modalImg.style.opacity = '1';
                    }, 10);
                });
            });
        </script>
    </section>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <section class="py-5 bg-light" id="testimoni">
        <div class="container">
            <!-- Judul -->
            <div class="text-center mb-5 animate-fade">
                <h2 class="fw-bold text-navy mb-3 section-title">Apa Kata Mereka</h2>
                <p class="text-muted fs-5">Testimoni dari orang tua, siswa, dan alumni tentang pengalaman mereka di
                    <span class="fw-bold text-navy">MI Diponegoro 03 Karangklesem</span>
                </p>
                <div class="divider mx-auto my-3"></div>
            </div>

            @if ($testimoni->count() > 0)
                <div class="swiper mySwiper animate-fade" style="animation-delay: 0.2s;">
                    <div class="swiper-wrapper">
                        @foreach ($testimoni as $item)
                            <div class="swiper-slide">
                                <div class="card shadow-lg border-0 text-center p-4 h-100 testimonial-card">
                                    <!-- Rating Stars -->
                                    <div class="rating mb-3">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i
                                                class="fas fa-star {{ $i < ($item->rating ?? 5) ? 'text-warning' : 'text-light' }}"></i>
                                        @endfor
                                    </div>

                                    <!-- Foto -->
                                    <div class="position-relative mb-3">
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}"
                                                class="rounded-circle mx-auto shadow testimonial-img"
                                                alt="{{ $item->nama }}">
                                        @else
                                            <img src="{{ asset('gambar/default-user.png') }}"
                                                class="rounded-circle mx-auto shadow testimonial-img" alt="User">
                                        @endif
                                        <div class="quote-icon bg-navy text-white">
                                            <i class="fas fa-quote-left small"></i>
                                        </div>
                                    </div>

                                    <!-- Nama & Sebagai -->
                                    <h5 class="fw-bold mb-1 text-navy">{{ $item->nama }}</h5>
                                    <small class="text-muted d-block mb-3">{{ ucfirst($item->sebagai) }}</small>

                                    <!-- Isi Testimoni -->
                                    <p class="mt-3 text-muted testimonial-text">"{{ Str::limit($item->testimoni, 150) }}"
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="swiper-pagination mt-4"></div>

                    <!-- Custom Navigation -->
                    <button class="swiper-btn swiper-btn-prev"><i class="fas fa-chevron-left"></i></button>
                    <button class="swiper-btn swiper-btn-next"><i class="fas fa-chevron-right"></i></button>
                </div>
            @else
                <div class="text-center py-5 animate-fade">
                    <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada testimoni yang diterima.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- SWIPER JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.mySwiper', {
                slidesPerView: 1,
                centeredSlides: true,
                spaceBetween: 30,
                loop: true,
                grabCursor: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                },
                navigation: {
                    nextEl: '.swiper-btn-next',
                    prevEl: '.swiper-btn-prev'
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2
                    },
                    1200: {
                        slidesPerView: 3
                    }
                }
            });

            const animatedElements = document.querySelectorAll('.animate-fade');
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });
            animatedElements.forEach(el => observer.observe(el));
        });
    </script>

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

        .section-title {
            font-size: 2rem;
            font-weight: 700;
        }

        .divider {
            width: 70px;
            height: 4px;
            border-radius: 2px;
            background: var(--navy-color);
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

        .testimonial-card {
            border-radius: 15px;
            transition: all 0.4s ease;
            background: #fff;
        }

        .testimonial-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .testimonial-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .testimonial-card:hover .testimonial-img {
            transform: scale(1.05);
        }

        .quote-icon {
            position: absolute;
            top: 0;
            right: 35%;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .testimonial-text {
            font-style: italic;
            line-height: 1.6;
            min-height: 60px;
        }

        .swiper-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--navy-color);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .swiper-btn:hover {
            background: var(--navy-color);
            color: #fff;
            transform: translateY(-50%) scale(1.05);
        }

        .swiper-btn-prev {
            left: -20px;
        }

        .swiper-btn-next {
            right: -20px;
        }

        .swiper-pagination-bullet {
            background: rgba(0, 0, 0, 0.2);
            opacity: 1;
        }

        .swiper-pagination-bullet-active {
            background: var(--navy-color);
            width: 30px;
            border-radius: 10px;
        }

        @media (max-width: 768px) {
            .swiper-btn {
                width: 40px;
                height: 40px;
            }

            .swiper-btn-prev {
                left: 5px;
            }

            .swiper-btn-next {
                right: 5px;
            }
        }
    </style>


@endsection
