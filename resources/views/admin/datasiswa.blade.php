@extends('Admin.dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Header dengan desain lebih modern -->
        <div class="page-header mb-4"
            style="background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%); color: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title" style="color: #ffffff; font-weight: 700;">
                        <i class="fas fa-user-graduate me-2"></i> Data Siswa Diterima
                    </h1>
                    <p class="mb-0">Kelola data siswa yang telah diterima di sekolah</p>
                </div>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: transparent; padding: 0; margin-bottom: 0;">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: #e0e0e0;">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page" style="color: #ffffff;">Data Siswa Diterima</li>
                </ol>
            </nav>
        </div>

        <!-- Flash Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert"
                style="border-radius: 10px; border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2" style="font-size: 1.2rem;"></i>
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <!-- Card untuk Tabel Data Siswa -->
        <div class="card shadow-sm" style="border-radius: 12px; overflow: hidden; border: none; margin-bottom: 20px;">
           <div class="card-header bg-white shadow-sm rounded-top py-3 px-3" style="border-bottom: 1px solid #e0e0e0;">
            <div class="card-header bg-white shadow-sm rounded-top py-3 px-3" style="border-bottom: 1px solid #e0e0e0;">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">

        <!-- Judul -->
        <h5 class="mb-0" style="color: #2e7d32; font-weight: 600;">
            <i class="fas fa-users me-2"></i> Daftar Siswa
        </h5>

        <!-- Bagian kanan -->
        <div class="d-flex flex-wrap align-items-center gap-2">

            <!-- Form Pencarian dan Filter -->
            <form method="GET" action="{{ route('admin.datasiswa.index') }}" class="d-flex align-items-center gap-2 mb-0">

                <!-- Input cari -->
                <input type="text" name="search" class="form-control form-control-sm"
                    placeholder="🔍 Cari siswa..." 
                    style="border-radius: 20px; min-width: 200px; border: 1px solid #c8e6c9;"
                    value="{{ request('search') }}">

                <!-- Filter tahun ajaran -->
                <select name="tahun_ajaran" class="form-select form-select-sm"
                    style="border-radius: 20px; min-width: 150px; border: 1px solid #c8e6c9;">
                    <option value="">Semua Tahun</option>
                    @foreach ($tahunAjaranList as $tahun)
                        <option value="{{ $tahun }}" {{ request('tahun_ajaran') == $tahun ? 'selected' : '' }}>
                            {{ $tahun }}
                        </option>
                    @endforeach
                </select>

                <!-- Tombol Cari -->
                <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 py-1" title="Cari siswa">
                    <i class="fas fa-search me-1"></i> Cari
                </button>

                <!-- Tombol Reset -->
                <a href="{{ route('admin.datasiswa.index') }}" class="btn btn-sm btn-secondary rounded-pill px-3 py-1" title="Reset">
                    <i class="fas fa-sync-alt me-1"></i> Reset
                </a>
            </form>

            <!-- Garis pemisah kecil -->
            <div style="width: 1px; height: 30px; background-color: #e0e0e0;"></div>

            <!-- Tombol Ekspor -->
            <a href="{{ route('admin.datasiswa.export.all') }}" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1">
                <i class="fas fa-file-pdf me-1"></i> PDF
            </a>
            <a href="{{ route('admin.datasiswa.export.excel') }}" class="btn btn-sm btn-outline-success rounded-pill px-3 py-1">
                <i class="fas fa-file-excel me-1"></i> Excel
            </a>
        </div>

        <form id="deleteForm" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="siswaTable">
                        <thead class="table-success"
                            style="background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%); color: white;">
                            <tr>
                                <th style="padding: 12px 15px;">No</th>
                                <th style="padding: 12px 15px;">Nama Lengkap</th>
                                <th style="padding: 12px 15px;">NIK</th>
                                <th style="padding: 12px 15px;">Jenis Kelamin</th>
                                <th style="padding: 12px 15px;">TTL</th>
                                <th style="padding: 12px 15px;">Alamat</th>
                                <th style="padding: 12px 15px;">No HP</th>
                                <th style="padding: 12px 15px;">Asal Sekolah</th>
                                <th style="padding: 12px 15px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswa as $key => $item)
                                <tr style="transition: all 0.3s ease;">
                                    <td style="padding: 12px 15px; vertical-align: middle;">
                                        {{ $siswa->firstItem() + $key }}
                                    </td>
                                    <td style="padding: 12px 15px; vertical-align: middle; font-weight: 500;">
                                        {{ $item->nama_lengkap }}
                                    </td>
                                    <td style="padding: 12px 15px; vertical-align: middle;">{{ $item->nik }}</td>
                                    <td style="padding: 12px 15px; vertical-align: middle;">{{ $item->jenis_kelamin }}</td>
                                    <td style="padding: 12px 15px; vertical-align: middle;">{{ $item->tempat_lahir }},
                                        {{ \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d/m/Y') }}
                                    </td>
                                    <td style="padding: 12px 15px; vertical-align: middle;">
                                        {{ Str::limit($item->alamat, 20) }}...
                                    </td>
                                    <td style="padding: 12px 15px; vertical-align: middle;">{{ $item->no_hp }}</td>
                                    <td style="padding: 12px 15px; vertical-align: middle;">
                                        {{ Str::limit($item->asal_sekolah, 15) }}...
                                    </td>
                                    <td>
    <div class="d-flex flex-wrap gap-2 justify-content-center">
        <!-- Tombol Detail -->
        <button class="btn btn-sm btn-outline-info d-flex align-items-center"
            data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
            <i class="fas fa-eye me-1"></i> Detail
        </button>

        <!-- Tombol Hapus -->
        <form action="{{ route('admin.datasiswa.destroy', $item->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center"
                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                <i class="fas fa-trash me-1"></i> Hapus
            </button>
        </form>

        <!-- Tombol Export PDF -->
        <a href="{{ route('admin.datasiswa.export', $item->id) }}"
            class="btn btn-sm btn-outline-success d-flex align-items-center">
            <i class="fas fa-file-pdf me-1"></i> PDF
        </a>
    </div>
</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4" style="padding: 20px;">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-user-slash"
                                                style="font-size: 3rem; color: #6c757d; margin-bottom: 15px;"></i>
                                            <h5 class="text-muted">Tidak ada data siswa diterima</h5>
                                            <p class="text-muted">Silakan periksa kembali atau tambah data siswa</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Detail -->
    @foreach ($siswa as $item)
        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item->id }}"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="modal-header text-white" style="background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);">
                        <h5 class="modal-title fw-semibold" id="detailModalLabel{{ $item->id }}">
                            <i class="fas fa-user-graduate me-2"></i>Detail Siswa: {{ $item->nama_lengkap }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body bg-light" style="padding: 25px;">
                        <!-- ================= DATA PRIBADI & ALAMAT ================= -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <h6 class="fw-bold text-success mb-3 border-bottom pb-2">
                                            <i class="fas fa-user me-2"></i>Data Pribadi
                                        </h6>
                                        <div class="row">
                                            <div class="col-6 mb-2"><strong>Nama Lengkap:</strong> <br>{{ $item->nama_lengkap }}
                                            </div>
                                            <div class="col-6 mb-2"><strong>NIK:</strong> <br>{{ $item->nik }}</div>
                                            <div class="col-6 mb-2"><strong>Jenis Kelamin:</strong>
                                                <br>{{ $item->jenis_kelamin }}</div>
                                            <div class="col-6 mb-2"><strong>Tempat Lahir:</strong> <br>{{ $item->tempat_lahir }}
                                            </div>
                                            <div class="col-6 mb-2"><strong>Tanggal Lahir:</strong>
                                                <br>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y') }}
                                            </div>
                                            <div class="col-6 mb-2">
                                                <strong>Status:</strong><br>
                                                <span
                                                    class="badge bg-{{ $item->status_pendaftaran == 'Diterima' ? 'success' : ($item->status_pendaftaran == 'Ditolak' ? 'danger' : 'warning') }}">
                                                    {{ $item->status_pendaftaran }}
                                                </span>
                                            </div>
                                            <div class="col-6 mb-2"><strong>Nomor KIP:</strong>
                                                <br>{{ $item->no_kip ?? 'Tidak tersedia' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <h6 class="fw-bold text-success mb-3 border-bottom pb-2">
                                            <i class="fas fa-address-book me-2"></i>Kontak & Alamat
                                        </h6>
                                        <div class="row">
                                            <div class="col-6 mb-2"><strong>No. HP:</strong> <br>{{ $item->no_hp }}</div>
                                            <div class="col-6 mb-2"><strong>Email:</strong> <br>{{ $item->email }}</div>
                                            <div class="col-12 mb-2"><strong>Alamat:</strong> <br>{{ $item->alamat }}</div>
                                            <div class="col-4 mb-2"><strong>Kelurahan:</strong> <br>{{ $item->kelurahan }}</div>
                                            <div class="col-4 mb-2"><strong>Kecamatan:</strong> <br>{{ $item->kecamatan }}</div>
                                            <div class="col-4 mb-2"><strong>Kabupaten:</strong> <br>{{ $item->kabupaten }}</div>
                                            <div class="col-6 mb-2"><strong>Provinsi:</strong> <br>{{ $item->provinsi }}</div>
                                            <div class="col-6 mb-2"><strong>Kode Pos:</strong> <br>{{ $item->kode_pos }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ================= DATA SEKOLAH & ORANG TUA ================= -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <h6 class="fw-bold text-success mb-3 border-bottom pb-2">
                                            <i class="fas fa-school me-2"></i>Data Sekolah
                                        </h6>
                                        <p class="mb-1"><strong>Asal Sekolah:</strong> {{ $item->asal_sekolah }}</p>
                                        <p class="mb-0"><strong>Tahun Lulus:</strong> {{ $item->tahun_lulus }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <h6 class="fw-bold text-success mb-3 border-bottom pb-2">
                                            <i class="fas fa-users me-2"></i>Data Orang Tua
                                        </h6>
                                        <div class="row">
                                            <div class="col-6 mb-2"><strong>Nama Ayah:</strong> <br>{{ $item->nama_ayah }}</div>
                                            <div class="col-6 mb-2"><strong>Pekerjaan Ayah:</strong>
                                                <br>{{ $item->pekerjaan_ayah }}</div>
                                            <div class="col-6 mb-2"><strong>Pendidikan Ayah:</strong>
                                                <br>{{ $item->pendidikan_ayah }}</div>
                                            <div class="col-6 mb-2"><strong>Penghasilan Ayah:</strong> <br>Rp
                                                {{ is_numeric($item->penghasilan_ayah) ? number_format($item->penghasilan_ayah, 0, ',', '.') : $item->penghasilan_ayah }}
                                            </div>
                                            <div class="col-6 mb-2"><strong>Nama Ibu:</strong> <br>{{ $item->nama_ibu }}</div>
                                            <div class="col-6 mb-2"><strong>Pekerjaan Ibu:</strong>
                                                <br>{{ $item->pekerjaan_ibu }}</div>
                                            <div class="col-6 mb-2"><strong>Pendidikan Ibu:</strong>
                                                <br>{{ $item->pendidikan_ibu }}</div>
                                            <div class="col-6 mb-2"><strong>Penghasilan Ibu:</strong> <br>Rp
                                                {{ is_numeric($item->penghasilan_ibu) ? number_format($item->penghasilan_ibu, 0, ',', '.') : $item->penghasilan_ibu }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ================= DOKUMEN ================= -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold text-success mb-3 border-bottom pb-2">
                                    <i class="fas fa-file-alt me-2"></i>Dokumen Pendukung
                                </h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @if ($item->akta_kelahiran)
                                        <a href="{{ asset('uploads/akta/' . $item->akta_kelahiran) }}" target="_blank"
                                            class="btn btn-outline-primary btn-sm"><i class="fas fa-file-pdf me-1"></i>Akta
                                            Kelahiran</a>
                                    @endif
                                    @if ($item->kartu_keluarga)
                                        <a href="{{ asset('uploads/kk/' . $item->kartu_keluarga) }}" target="_blank"
                                            class="btn btn-outline-primary btn-sm"><i class="fas fa-file me-1"></i>Kartu
                                            Keluarga</a>
                                    @endif
                                    @if ($item->foto_siswa)
                                        <a href="{{ asset('uploads/foto_siswa/' . $item->foto_siswa) }}" target="_blank"
                                            class="btn btn-outline-success btn-sm"><i class="fas fa-image me-1"></i>Foto
                                            Siswa</a>
                                    @endif
                                    @if ($item->foto_kip)
                                        <a href="{{ asset('uploads/foto_kip/' . $item->foto_kip) }}" target="_blank"
                                            class="btn btn-outline-success btn-sm"><i class="fas fa-id-card me-1"></i>Foto
                                            KIP</a>
                                    @endif

                                    @if (!$item->akta_kelahiran && !$item->kartu_keluarga && !$item->foto_siswa && !$item->foto_kip)
                                        <span class="text-muted">Tidak ada dokumen yang diunggah</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-white">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Tutup
                        </button>
                        <a href="{{ route('admin.datasiswa.export', $item->id) }}" class="btn btn-success">
                            <i class="fas fa-file-pdf me-1"></i>Ekspor PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(46, 125, 50, 0.05);
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.875rem;
        }

        .info-card {
            transition: transform 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-3px);
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.35rem 0.65rem;
        }

        @media (max-width: 1200px) {
            .modal-xl {
                max-width: 95%;
            }
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 15px;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .card-header .d-flex {
                margin-top: 10px;
                width: 100%;
            }

            #searchInput {
                width: 100% !important;
                margin-bottom: 10px;
            }

            .table-responsive {
                overflow-x: auto;
            }

            .d-flex.gap-2 {
                flex-wrap: wrap;
            }

            .modal-dialog {
                margin: 10px;
            }

            .modal-content {
                border-radius: 10px;
            }
        }

        @media (max-width: 576px) {
            .modal-body .row {
                flex-direction: column;
            }

            .info-card {
                margin-bottom: 15px;
            }

            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }
        }
    </style>

    <!-- JavaScript untuk interaktivitas -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
@endsection