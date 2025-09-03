@extends('pengguna.beranda-content')

@section('content')
    <!-- Hero Banner -->
    <section class="hero-section text-center text-white" id="home">
        <!-- Carousel Hero Banner -->
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" style="min-height: 80vh;">
            <div class="carousel-inner">
                @for ($i = 1; $i <= 3; $i++)
                    @if ($pengumuman && $pengumuman->{'foto_slide' . $i})
                        <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                            <div class="d-flex align-items-center justify-content-center text-center w-100 h-100"
                                style="background: url('{{ asset('uploads/pengumuman/' . $pengumuman->{'foto_slide' . $i}) }}') center/cover no-repeat; min-height: 80vh;">
                                <div class="container animate-fade">
                                    <h1 class="display-4 fw-bold mb-3">Selamat Datang di <br> MI Diponegoro 03 Karangklesem
                                    </h1>
                                    <p class="lead mb-4">Madrasah Unggul dalam Iman, Ilmu, dan Akhlak Mulia</p>
                                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                                        <a href="{{ route('pendaftaran.create') }}" class="btn btn-success btn-lg pulse">
                                            <i class="fas fa-user-plus me-2"></i> Daftar PPDB
                                        </a>
                                        <a href="#info" class="btn btn-outline-light btn-lg">
                                            <i class="fas fa-arrow-down me-2"></i> Jelajahi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Running Teks -->
        @if ($pengumuman && $pengumuman->running_teks)
            <div class="running-text mt-3 p-2 bg-success text-white text-center">
                <marquee behavior="scroll" direction="left">{{ $pengumuman->running_teks }}</marquee>
            </div>
        @endif
    </section>

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

    <!-- Akreditasi -->
    <section class="py-5 bg-success text-white" id="akreditasi">
        <div class="container text-center">
            <div class="card shadow-lg border-0 rounded-4 bg-white text-success p-5 position-relative overflow-hidden">

                <!-- Gambar Sertifikat -->
                <img src="{{ asset('gambar/akreditasia.png') }}" alt="Akreditasi A"
                    class="position-absolute top-50 end-0 translate-middle-y me-4" style="width:120px; opacity:0.8;">

                <h2 class="fw-bold mb-3">
                    <i class="fas fa-certificate text-warning me-2"></i> Akreditasi Madrasah
                </h2>
                <p class="lead mb-0">
                    MI Diponegoro 03 Karangklesem telah resmi terakreditasi dengan predikat
                    <span class="fw-bold text-uppercase text-success">A (Unggul)</span>.
                </p>
            </div>
        </div>
    </section>

    <!-- Sekilas Info -->
    <section class="py-5 bg-light" id="info">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="info-card shadow-sm rounded p-4 bg-white h-100">
                        <i class="fas fa-users fa-3x mb-3 text-success"></i>
                        <h3 class="counter fw-bold" data-target="350">0</h3>
                        <p class="text-muted">Siswa Aktif</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card shadow-sm rounded p-4 bg-white h-100">
                        <i class="fas fa-chalkboard-teacher fa-3x mb-3 text-success"></i>
                        <h3 class="counter fw-bold" data-target="25">0</h3>
                        <p class="text-muted">Guru Profesional</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card shadow-sm rounded p-4 bg-white h-100">
                        <i class="fas fa-trophy fa-3x mb-3 text-success"></i>
                        <h3 class="counter fw-bold" data-target="120">0</h3>
                        <p class="text-muted">Prestasi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light" id="prestasi">
        <div class="container">
            <h2 class="section-title text-center mb-5">Prestasi Siswa</h2>
            <div class="row g-4">
                @foreach ($prestasiTerbaru as $prestasi)
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0">
                            @if ($prestasi->foto)
                                <img src="{{ asset('uploads/prestasisiswa/' . $prestasi->foto) }}" class="card-img-top"
                                    alt="{{ $prestasi->nama_prestasi }}">
                            @endif
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2 small text-muted">
                                    <span><i class="far fa-calendar-alt me-1"></i>
                                        {{ $prestasi->created_at->format('d M Y') }}</span>
                                    <span><i class="fas fa-trophy me-1 text-warning"></i>
                                        {{ $prestasi->tingkat ?? 'Prestasi' }}</span>
                                </div>
                                <h5 class="card-title">{{ $prestasi->nama_prestasi }}</h5>
                                <p class="card-text text-muted">
                                    {{ Str::limit($prestasi->keterangan ?? '-', 100) }}
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0 text-end">
                                <a href="{{ route('pengguna.prestasi.show', $prestasi->id) }}"
                                    class="btn btn-outline-success btn-sm">
                                    Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('pengguna.prestasi.index') }}" class="btn btn-success">
                    Lihat Semua Prestasi <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Berita Terbaru -->
    <section class="py-5" id="news">
        <div class="container">
            <h2 class="section-title text-center mb-5">Berita Terbaru</h2>
            <div class="row g-4">
                @foreach ($beritaTerbaru as $berita)
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0">
                            @if ($berita->foto)
                                <img src="{{ asset('uploads/berita/' . $berita->foto) }}" class="card-img-top"
                                    alt="{{ $berita->judul }}">
                            @endif
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2 small text-muted">
                                    <span><i class="far fa-calendar-alt me-1"></i>
                                        {{ $berita->created_at->format('d M Y') }}</span>
                                    <span><i class="far fa-eye me-1"></i> 245</span>
                                </div>
                                <h5 class="card-title">{{ $berita->judul }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($berita->isi, 100) }}</p>
                            </div>
                            <div class="card-footer bg-white border-0 text-end">
                                <a href="{{ route('pengguna.berita.show', $berita->id) }}"
                                    class="btn btn-outline-success btn-sm">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('pengguna.berita.index') }}" class="btn btn-success">
                    Lihat Semua Berita <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Galeri Foto -->
    <section class="py-5 bg-light" id="gallery">
        <div class="container">
            <h2 class="section-title text-center mb-5">Galeri Foto</h2>
            <div class="row g-3">
                @foreach ($galeriFoto as $foto)
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="gallery-card overflow-hidden rounded shadow-sm">
                            <img src="{{ asset('uploads/galeri_kegiatan/' . $foto->foto) }}"
                                class="gallery-img w-100 h-100" alt="{{ $foto->judul_kegiatan }}" data-bs-toggle="modal"
                                data-bs-target="#galleryModal"
                                data-bs-img="{{ asset('uploads/galeri_kegiatan/' . $foto->foto) }}"
                                data-bs-caption="{{ $foto->judul_kegiatan }}">
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('pengguna.galeri.index') }}" class="btn btn-success">
                    Lihat Galeri Lengkap <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimoni -->
    <section class="py-5 bg-light" id="testimoni">
        <div class="container">
            <h2 class="section-title text-center mb-5">Apa Kata Mereka</h2>

            @if ($testimoni->count() > 0)
                <div id="testimoniCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        @foreach ($testimoni as $index => $item)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <div class="d-flex justify-content-center">
                                    <div class="card shadow-sm border-0 text-center p-4" style="max-width: 500px;">
                                        <!-- Foto -->
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}"
                                                class="rounded-circle mx-auto mb-3 shadow"
                                                style="width: 100px; height: 100px; object-fit: cover;"
                                                alt="{{ $item->nama }}">
                                        @else
                                            <img src="{{ asset('gambar/default-user.png') }}"
                                                class="rounded-circle mx-auto mb-3 shadow"
                                                style="width: 100px; height: 100px; object-fit: cover;" alt="User">
                                        @endif

                                        <!-- Nama & Sebagai -->
                                        <h5 class="fw-bold mb-1">{{ $item->nama }}</h5>
                                        <small class="text-muted">{{ ucfirst($item->sebagai) }}</small>

                                        <!-- Isi Testimoni -->
                                        <p class="mt-3 text-muted">“{{ Str::limit($item->testimoni, 200) }}”</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <!-- Tombol kontrol -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#testimoniCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimoniCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            @else
                <p class="text-center text-muted">Belum ada testimoni yang diterima.</p>
            @endif

            <div class="text-center mt-4">
                <a href="{{ route('pengguna.kontak.testimoni.index') }}" class="btn btn-success">
                    Lihat Semua Testimoni <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </section>

@endsection
