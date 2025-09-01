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

    {{-- Statistik singkat --}}
    <div class="row animate-fade-in">
        {{-- Card Siswa --}}
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card text-center">
                <div class="card-body">
                    <i class="fas fa-users icon text-white"></i>
                    <div class="count text-white">{{ $totalSiswa }}</div>
                    <div class="label text-white">Total Siswa</div>
                </div>
            </div>
        </div>

        {{-- Card Guru --}}
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card text-center">
                <div class="card-body">
                    <i class="fas fa-chalkboard-teacher icon text-white"></i>
                    <div class="count text-white">{{ $totalGuru }}</div>
                    <div class="label text-white">Total Guru</div>
                </div>
            </div>
        </div>

        {{-- Card Prestasi --}}
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card text-center">
                <div class="card-body">
                    <i class="fas fa-trophy icon text-white"></i>
                    <div class="count text-white">{{ $totalPrestasi }}</div>
                    <div class="label text-white">Prestasi</div>
                </div>
            </div>
        </div>

        {{-- Card Kegiatan --}}
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card text-center">
                <div class="card-body">
                    <i class="fas fa-calendar-check icon text-white"></i>
                    <div class="count text-white">5</div>
                    <div class="label text-white">Kegiatan Terbaru</div>
                </div>
            </div>
        </div>
    </div>
    {{-- Quick Links --}}
    <div class="row mt-4 animate-fade-in" style="animation-delay: 0.2s;">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-bolt"></i> Akses Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="quick-links d-flex flex-wrap gap-3">
                        <a href="{{ route('admin.calonsiswa.index') }}" class="quick-link text-center">
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
                        <a href="{{ route('admin.pengumuman.index') }}" class="quick-link text-center">
                            <div class="quick-link-icon"><i class="fas fa-bullhorn"></i></div>
                            <div class="quick-link-text">Pengumuman</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistik & Aktivitas --}}
    <div class="row mt-4">
        {{-- Statistik Pendaftaran --}}
        <div class="col-lg-6">
            <div class="card animate-fade-in" style="animation-delay: 0.3s;">
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-chart-line"></i> Statistik Pendaftaran</h5>
                </div>
                <div class="card-body">
                    {{-- Pendaftar Laki-laki --}}
                    <div class="progress-card mb-3">
                        <div class="progress-card-title"><i class="fas fa-male"></i> Pendaftar Laki-laki</div>
                        <div class="progress-info d-flex justify-content-between">
                            <span>{{ $jumlahLaki }} Siswa</span>
                            <span>{{ $persenLaki }}% dari total pendaftar</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: {{ $persenLaki }}%"></div>
                        </div>
                    </div>

                    {{-- Pendaftar Perempuan --}}
                    <div class="progress-card mb-3">
                        <div class="progress-card-title"><i class="fas fa-female"></i> Pendaftar Perempuan</div>
                        <div class="progress-info d-flex justify-content-between">
                            <span>{{ $jumlahPerempuan }} Siswa</span>
                            <span>{{ $persenPerempuan }}% dari total pendaftar</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: {{ $persenPerempuan }}%"></div>
                        </div>
                    </div>

                    {{-- Siswa Diterima --}}
                    <div class="progress-card">
                        <div class="progress-card-title"><i class="fas fa-check-circle"></i> Siswa Diterima</div>
                        <div class="progress-info d-flex justify-content-between">
                            <span>{{ $totalSiswa }} Siswa</span>
                            <span>{{ $persenDiterima }}% dari total pendaftar</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: {{ $persenDiterima }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Aktivitas Terkini --}}
        <div class="col-lg-6">
            <div class="card animate-fade-in" style="animation-delay: 0.4s;">
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-bell"></i> Aktivitas Terkini</h5>
                </div>
                <div class="card-body">
                    <div class="activity-list">
                        @forelse($aktivitas as $item)
                            <div class="activity-item">
                                <div
                                    class="activity-dot 
                                @if ($item['type'] == 'pendaftaran') bg-primary
                                @elseif($item['type'] == 'kritik') bg-warning
                                @elseif($item['type'] == 'testimoni') bg-success @endif">
                                </div>
                                <div class="activity-content">
                                    <h6 class="activity-title">{{ $item['judul'] }}</h6>
                                    <p class="activity-text">{{ $item['pesan'] }}</p>
                                    <small class="activity-time">{{ $item['waktu']->diffForHumans() }}</small>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted">
                                <p>Tidak ada aktivitas terbaru</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .stats-card {
            background-color: #28a745;
            /* hijau sama untuk semua */
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 20px;
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .stats-card .icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .stats-card .count {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .stats-card .label {
            font-size: 0.9rem;
            font-weight: 500;
        }
    </style>
@endsection
