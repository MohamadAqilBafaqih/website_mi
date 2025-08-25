@extends('Admin.dashboard')

@section('content')
<div class="page-header">
    <h1 class="page-title"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
</div>

<!-- Stats Cards -->
<div class="row animate-fade-in">
    {{-- Card Siswa --}}
    <div class="col-md-6 col-lg-3">
        <div class="card stats-card stats-card-1">
            <div class="card-body text-center">
                <i class="fas fa-users icon"></i>
                <div class="count">245</div>
                <div class="label">Total Siswa</div>
            </div>
        </div>
    </div>

    {{-- Card Guru --}}
    <div class="col-md-6 col-lg-3">
        <div class="card stats-card stats-card-2">
            <div class="card-body text-center">
                <i class="fas fa-chalkboard-teacher icon"></i>
                <div class="count">24</div>
                <div class="label">Total Guru</div>
            </div>
        </div>
    </div>

    {{-- Card Prestasi --}}
    <div class="col-md-6 col-lg-3">
        <div class="card stats-card stats-card-3">
            <div class="card-body text-center">
                <i class="fas fa-trophy icon"></i>
                <div class="count">18</div>
                <div class="label">Prestasi</div>
            </div>
        </div>
    </div>

    {{-- Card Kegiatan --}}
    <div class="col-md-6 col-lg-3">
        <div class="card stats-card stats-card-4">
            <div class="card-body text-center">
                <i class="fas fa-calendar-check icon"></i>
                <div class="count">5</div>
                <div class="label">Kegiatan Terbaru</div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Links -->
<div class="row mt-4 animate-fade-in" style="animation-delay: 0.2s;">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><i class="fas fa-bolt"></i> Akses Cepat</h5>
            </div>
            <div class="card-body">
                <div class="quick-links d-flex flex-wrap gap-3">
                    <a href="#" class="quick-link text-center">
                        <div class="quick-link-icon"><i class="fas fa-user-plus"></i></div>
                        <div class="quick-link-text">Tambah Siswa</div>
                    </a>
                    <a href="#" class="quick-link text-center">
                        <div class="quick-link-icon"><i class="fas fa-file-invoice"></i></div>
                        <div class="quick-link-text">Laporan Bulanan</div>
                    </a>
                    <a href="#" class="quick-link text-center">
                        <div class="quick-link-icon"><i class="fas fa-calendar-plus"></i></div>
                        <div class="quick-link-text">Jadwal Baru</div>
                    </a>
                    <a href="#" class="quick-link text-center">
                        <div class="quick-link-icon"><i class="fas fa-bullhorn"></i></div>
                        <div class="quick-link-text">Pengumuman</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Progress and Activities -->
<div class="row mt-4">
    {{-- Statistik --}}
    <div class="col-lg-6">
        <div class="card animate-fade-in" style="animation-delay: 0.3s;">
            <div class="card-header">
                <h5 class="card-title"><i class="fas fa-chart-line"></i> Statistik Pendaftaran</h5>
            </div>
            <div class="card-body">
                {{-- Progress Laki-laki --}}
                <div class="progress-card mb-3">
                    <div class="progress-card-title"><i class="fas fa-male"></i> Pendaftar Laki-laki</div>
                    <div class="progress-info d-flex justify-content-between">
                        <span>45 Siswa</span>
                        <span>75% dari target</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 75%"></div>
                    </div>
                </div>

                {{-- Progress Perempuan --}}
                <div class="progress-card mb-3">
                    <div class="progress-card-title"><i class="fas fa-female"></i> Pendaftar Perempuan</div>
                    <div class="progress-info d-flex justify-content-between">
                        <span>38 Siswa</span>
                        <span>63% dari target</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 63%"></div>
                    </div>
                </div>

                {{-- Progress Diterima --}}
                <div class="progress-card">
                    <div class="progress-card-title"><i class="fas fa-check-circle"></i> Siswa Diterima</div>
                    <div class="progress-info d-flex justify-content-between">
                        <span>62 Siswa</span>
                        <span>82% dari pendaftar</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 82%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Aktivitas --}}
    <div class="col-lg-6">
        <div class="card animate-fade-in" style="animation-delay: 0.4s;">
            <div class="card-header">
                <h5 class="card-title"><i class="fas fa-bell"></i> Aktivitas Terkini</h5>
            </div>
            <div class="card-body">
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-dot"></div>
                        <div class="activity-content">
                            <h6 class="activity-title">Pendaftaran Baru</h6>
                            <p class="activity-text">Ahmad Fauzi mendaftar sebagai siswa baru</p>
                            <small class="activity-time">10 menit yang lalu</small>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot"></div>
                        <div class="activity-content">
                            <h6 class="activity-title">Penerimaan Siswa</h6>
                            <p class="activity-text">Siti Aminah diterima di kelas 1</p>
                            <small class="activity-time">1 jam yang lalu</small>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot"></div>
                        <div class="activity-content">
                            <h6 class="activity-title">Prestasi</h6>
                            <p class="activity-text">Budi Santoso memenangkan lomba MTQ</p>
                            <small class="activity-time">3 jam yang lalu</small>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot"></div>
                        <div class="activity-content">
                            <h6 class="activity-title">Kritik & Saran</h6>
                            <p class="activity-text">Orang tua mengirim masukan baru</p>
                            <small class="activity-time">5 jam yang lalu</small>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot"></div>
                        <div class="activity-content">
                            <h6 class="activity-title">Kegiatan Baru</h6>
                            <p class="activity-text">Pembagian rapor semester ganjil</p>
                            <small class="activity-time">Kemarin, 15:30</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
