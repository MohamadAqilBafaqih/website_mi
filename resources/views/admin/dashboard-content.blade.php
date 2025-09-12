@extends('Admin.dashboard')

@section('content')
    {{-- Statistik Utama --}}
    <div class="row animate-fade-in g-3">
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card text-center text-white gradient-card">
                <div class="card-body">
                    <div class="icon-circle bg-white text-success mb-3">
                        <i class="fas fa-male"></i>
                    </div>
                    <h3 class="count">{{ $jumlahLaki }}</h3>
                    <p class="label">Siswa Laki-laki</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card stats-card text-center text-white gradient-card">
                <div class="card-body">
                    <div class="icon-circle bg-white text-success mb-3">
                        <i class="fas fa-female"></i>
                    </div>
                    <h3 class="count">{{ $jumlahPerempuan }}</h3>
                    <p class="label">Siswa Perempuan</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card stats-card text-center text-white gradient-card">
                <div class="card-body">
                    <div class="icon-circle bg-white text-success mb-3">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="count">{{ $totalGuru }}</h3>
                    <p class="label">Total Guru</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card stats-card text-center text-white gradient-card">
                <div class="card-body">
                    <div class="icon-circle bg-white text-success mb-3">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3 class="count">{{ $totalPrestasi }}</h3>
                    <p class="label">Prestasi</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Akses Cepat --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card animate-fade-in shadow-sm" style="animation-delay: 0.2s; background-color: #ffffff;">
                <div class="card-header text-dark" style="background-color: #ffffff; border-bottom: 1px solid #e0e0e0;">
                    <h5 class="card-title mb-0"><i class="fas fa-bolt me-2"></i> Akses Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3 text-center">
                        <div class="col-6 col-md-3">
                            <a href="{{ route('admin.calonsiswa.index') }}" class="quick-link-card gradient-card-link">
                                <i class="fas fa-user-plus fs-2 mb-2"></i>
                                <span>Tambah Siswa</span>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('admin.seleksisiswa.index') }}" class="quick-link-card gradient-card-link">
                                <i class="fas fa-user-check fs-2 mb-2"></i>
                                <span>Seleksi Siswa</span>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('admin.sesipendaftaran.index') }}" class="quick-link-card gradient-card-link">
                                <i class="fas fa-calendar-alt fs-2 mb-2"></i>
                                <span>Sesi Pendaftaran</span>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('admin.pengumuman.index') }}" class="quick-link-card gradient-card-link">
                                <i class="fas fa-bullhorn fs-2 mb-2"></i>
                                <span>Pengumuman</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Statistik & Aktivitas --}}
    <div class="row mt-4 g-3">
        <div class="col-lg-6">
            <div class="card animate-fade-in shadow-sm" style="animation-delay: 0.3s;">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0"><i class="fas fa-chart-line"></i> Statistik Pendaftaran</h5>
                </div>
                <div class="card-body">
                    {{-- Progress Laki-laki --}}
                    <div class="progress-card mb-3">
                        <span class="progress-card-title"><i class="fas fa-male"></i> Laki-laki</span>
                        <div class="progress-info d-flex justify-content-between small">
                            <span>{{ $jumlahLaki }} siswa</span>
                            <span>{{ $persenLaki }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar gradient-bar" style="width: {{ $persenLaki }}%"></div>
                        </div>
                    </div>

                    {{-- Progress Perempuan --}}
                    <div class="progress-card mb-3">
                        <span class="progress-card-title"><i class="fas fa-female"></i> Perempuan</span>
                        <div class="progress-info d-flex justify-content-between small">
                            <span>{{ $jumlahPerempuan }} siswa</span>
                            <span>{{ $persenPerempuan }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar gradient-bar" style="width: {{ $persenPerempuan }}%"></div>
                        </div>
                    </div>

                    {{-- Progress Diterima --}}
                    <div class="progress-card">
                        <span class="progress-card-title"><i class="fas fa-check-circle"></i> Diterima</span>
                        <div class="progress-info d-flex justify-content-between small">
                            <span>{{ $totalSiswa }} siswa</span>
                            <span>{{ $persenDiterima }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar gradient-bar" style="width: {{ $persenDiterima }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Aktivitas Terkini --}}
        <div class="col-lg-6">
            <div class="card animate-fade-in shadow-sm" style="animation-delay: 0.4s;">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0"><i class="fas fa-bell"></i> Aktivitas Terkini</h5>
                </div>
                <div class="card-body activity-list">
                    @forelse($aktivitas as $item)
                        <div class="activity-item d-flex mb-3">
                            <div class="activity-dot me-3 gradient-bar"></div>
                            <div>
                                <h6 class="mb-1">{{ $item['judul'] }}</h6>
                                <p class="mb-1 small text-muted">{{ $item['pesan'] }}</p>
                                <small class="text-secondary">{{ $item['waktu']->diffForHumans() }}</small>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted">Tidak ada aktivitas terbaru</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Gradient Cards */
        .gradient-card {
            background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .gradient-card-link {
            background: linear-gradient(135deg, #43a047 0%, #2e7d32 100%);
            color: white !important;
        }

        .gradient-card-link:hover {
            background: linear-gradient(135deg, #66bb6a 0%, #43a047 100%);
            color: white !important;
        }

        /* Gradient Progress Bar */
        .gradient-bar {
            background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);
        }

        /* Page Header */
        .page-header {
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .page-header .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 0;
        }

        .page-header .breadcrumb a {
            color: #e0e0e0;
        }

        /* Stats Card */
        .stats-card .count {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .stats-card .label {
            font-size: 0.95rem;
            font-weight: 500;
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        /* Quick Link */
        .quick-link-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        /* Activity Dot */
        .activity-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-top: 6px;
        }
    </style>
@endsection
