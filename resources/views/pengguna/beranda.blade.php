@extends('pengguna.beranda-content')

@section('content')
    <!-- Hero Banner -->
    <section class="hero-section d-flex align-items-center text-center text-white" id="home"
        style="min-height: 80vh; 
               background: url('{{ asset('gambar/profil.jpeg') }}') center/cover no-repeat;">
        <div class="container animate-fade">
            <h1 class="display-4 fw-bold mb-3">Selamat Datang di <br> MI Diponegoro 03 Karangklesem</h1>
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
    <!-- Prestasi Siswa -->
    <!-- Prestasi Siswa -->
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
@endsection
