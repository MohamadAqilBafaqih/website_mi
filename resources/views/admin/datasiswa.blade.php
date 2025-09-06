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
            <div class="card-header bg-white py-3" style="border-bottom: 1px solid #eaeaea;">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="color: #2e7d32; font-weight: 600;">
                        <i class="fas fa-list me-2"></i> Daftar Siswa
                    </h5>
                    <div class="d-flex">
                        <form method="GET" action="{{ route('admin.datasiswa.index') }}"
                            class="d-flex align-items-center me-2">
                            {{-- Input pencarian --}}
                            <input type="text" name="search" class="form-control form-control-sm me-2"
                                placeholder="Cari siswa..." style="border-radius: 8px; min-width: 200px;"
                                value="{{ request('search') }}">

                            {{-- Filter tahun ajaran --}}
                            <select name="tahun_ajaran" class="form-select form-select-sm me-2"
                                style="border-radius: 8px; min-width: 150px;">
                                <option value="">Semua Tahun</option>
                                @foreach ($tahunAjaranList as $tahun)
                                    <option value="{{ $tahun }}"
                                        {{ request('tahun_ajaran') == $tahun ? 'selected' : '' }}>
                                        {{ $tahun }}
                                    </option>
                                @endforeach
                            </select>

                            {{-- Tombol cari --}}
                            <button type="submit" class="btn btn-sm btn-success me-2">
                                <i class="fas fa-search me-1"></i> Tampilkan
                            </button>
                        </form>

                        {{-- Tombol Ekspor & Cetak --}}
                        <a href="{{ route('admin.datasiswa.export.all') }}" class="btn btn-sm btn-success me-2">
                            <i class="fas fa-file-pdf me-1"></i> Ekspor PDF
                        </a>
                        <a href="{{ route('admin.datasiswa.export.excel') }}" class="btn btn-sm btn-success me-2">
                            <i class="fas fa-file-excel me-1"></i> Ekspor Excel
                        </a>
                        <a href="{{ route('admin.datasiswa.cetak') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-print me-1"></i> Cetak
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
                                        {{ $item->nama_lengkap }}</td>
                                    <td style="padding: 12px 15px; vertical-align: middle;">{{ $item->nik }}</td>
                                    <td style="padding: 12px 15px; vertical-align: middle;">{{ $item->jenis_kelamin }}</td>
                                    <td style="padding: 12px 15px; vertical-align: middle;">{{ $item->tempat_lahir }},
                                        {{ \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d/m/Y') }}</td>
                                    <td style="padding: 12px 15px; vertical-align: middle;">
                                        {{ Str::limit($item->alamat, 20) }}...</td>
                                    <td style="padding: 12px 15px; vertical-align: middle;">{{ $item->no_hp }}</td>
                                    <td style="padding: 12px 15px; vertical-align: middle;">
                                        {{ Str::limit($item->asal_sekolah, 15) }}...</td>
                                    <td style="padding: 12px 15px; vertical-align: middle;">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#detailModal{{ $item->id }}"
                                                style="border-radius: 6px; padding: 5px 10px;">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <form action="{{ route('admin.datasiswa.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                    style="border-radius: 6px; padding: 5px 10px;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('admin.datasiswa.export', $item->id) }}"
                                                class="btn btn-sm btn-success"
                                                style="border-radius: 6px; padding: 5px 10px;">
                                                <i class="fas fa-file-pdf"></i>
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
            @if ($siswa->hasPages())
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Menampilkan {{ $siswa->firstItem() }} - {{ $siswa->lastItem() }} dari {{ $siswa->total() }}
                            hasil
                        </div>
                        <div>
                            {{ $siswa->appends(['search' => request('search')])->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Detail -->
    @foreach ($siswa as $item)
        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content" style="border-radius: 12px; overflow: hidden;">
                    <div class="modal-header"
                        style="background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%); color: white;">
                        <h5 class="modal-title" id="detailModalLabel{{ $item->id }}">
                            <i class="fas fa-user-graduate me-2"></i>Detail Data Siswa: {{ $item->nama_lengkap }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="padding: 20px;">
                        <div class="row">
                            <!-- Data Pribadi -->
                            <div class="col-md-6">
                                <div class="info-card mb-4"
                                    style="background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 4px solid #2e7d32;">
                                    <h6 class="fw-bold mb-3 text-success"><i class="fas fa-user me-2"></i>Data Pribadi
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">Nama Lengkap</label>
                                            <p class="mb-0">{{ $item->nama_lengkap }}</p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">NIK</label>
                                            <p class="mb-0">{{ $item->nik }}</p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">Jenis Kelamin</label>
                                            <p class="mb-0">{{ $item->jenis_kelamin }}</p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">Tempat Lahir</label>
                                            <p class="mb-0">{{ $item->tempat_lahir }}</p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">Tanggal Lahir</label>
                                            <p class="mb-0">
                                                {{ \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y') }}
                                            </p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">Status Pendaftaran</label>
                                            <p class="mb-0">
                                                <span
                                                    class="badge bg-{{ $item->status_pendaftaran == 'Diterima' ? 'success' : ($item->status_pendaftaran == 'Ditolak' ? 'danger' : 'warning') }}">
                                                    {{ $item->status_pendaftaran }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">Nomor KIP</label>
                                            @if ($item->no_kip)
                                                <p class="mb-0">{{ $item->no_kip }}</p>
                                            @else
                                                <p class="mb-0 text-muted">Tidak tersedia</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kontak & Alamat -->
                            <div class="col-md-6">
                                <div class="info-card mb-4"
                                    style="background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 4px solid #2e7d32;">
                                    <h6 class="fw-bold mb-3 text-success"><i class="fas fa-address-book me-2"></i>Kontak &
                                        Alamat</h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">No. HP</label>
                                            <p class="mb-0">{{ $item->no_hp }}</p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">Email</label>
                                            <p class="mb-0">{{ $item->email }}</p>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label fw-bold">Alamat Lengkap</label>
                                            <p class="mb-0">{{ $item->alamat }}</p>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label fw-bold">Kelurahan</label>
                                            <p class="mb-0">{{ $item->kelurahan }}</p>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label fw-bold">Kecamatan</label>
                                            <p class="mb-0">{{ $item->kecamatan }}</p>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label fw-bold">Kabupaten</label>
                                            <p class="mb-0">{{ $item->kabupaten }}</p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">Provinsi</label>
                                            <p class="mb-0">{{ $item->provinsi }}</p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">Kode Pos</label>
                                            <p class="mb-0">{{ $item->kode_pos }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Data Sekolah -->
                            <div class="col-md-6">
                                <div class="info-card mb-4"
                                    style="background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 4px solid #2e7d32;">
                                    <h6 class="fw-bold mb-3 text-success"><i class="fas fa-school me-2"></i>Data Sekolah
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-8 mb-2">
                                            <label class="form-label fw-bold">Asal Sekolah</label>
                                            <p class="mb-0">{{ $item->asal_sekolah }}</p>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label fw-bold">Tahun Lulus</label>
                                            <p class="mb-0">{{ $item->tahun_lulus }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Orang Tua -->
                            <div class="col-md-6">
                                <div class="info-card mb-4"
                                    style="background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 4px solid #2e7d32;">
                                    <h6 class="fw-bold mb-3 text-success"><i class="fas fa-users me-2"></i>Data Orang Tua
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">Nama Ayah</label>
                                            <p class="mb-0">{{ $item->nama_ayah }}</p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">Pekerjaan Ayah</label>
                                            <p class="mb-0">{{ $item->pekerjaan_ayah }}</p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">Pendidikan Ayah</label>
                                            <p class="mb-0">{{ $item->pendidikan_ayah }}</p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">Penghasilan Ayah</label>
                                            <p class="mb-0">{{ $item->penghasilan_ayah ?? '0' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">Nama Ibu</label>
                                            <p class="mb-0">{{ $item->nama_ibu }}</p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">Pekerjaan Ibu</label>
                                            <p class="mb-0">{{ $item->pekerjaan_ibu }}</p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">Pendidikan Ibu</label>
                                            <p class="mb-0">{{ $item->pendidikan_ibu }}</p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-bold">Penghasilan Ibu</label>
                                            <p class="mb-0">{{ $item->penghasilan_ibu ?? '0' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dokumen -->
                        <div class="info-card mb-4"
                            style="background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 4px solid #2e7d32;">
                            <h6 class="fw-bold mb-3 text-success"><i class="fas fa-file-alt me-2"></i>Dokumen</h6>
                            <div class="d-flex gap-2 flex-wrap">
                                {{-- Akta Kelahiran --}}
                                @if ($item->akta_kelahiran)
                                    <a href="{{ asset('storage/uploads/akta/' . $item->akta_kelahiran) }}"
                                        target="_blank" class="btn btn-sm btn-primary mb-2">
                                        <i class="fas fa-file-pdf me-1"></i> Lihat Akta Kelahiran
                                    </a>
                                @else
                                    <span class="text-muted mb-2">Akta Kelahiran tidak tersedia</span>
                                @endif

                                {{-- Kartu Keluarga --}}
                                @if ($item->kartu_keluarga)
                                    <a href="{{ asset('storage/uploads/kk/' . $item->kartu_keluarga) }}" target="_blank"
                                        class="btn btn-sm btn-secondary mb-2">
                                        <i class="fas fa-file-pdf me-1"></i> Lihat Kartu Keluarga
                                    </a>
                                @else
                                    <span class="text-muted mb-2">Kartu Keluarga tidak tersedia</span>
                                @endif

                                {{-- Foto Siswa --}}
                                @if ($item->foto_siswa)
                                    <a href="{{ asset('storage/uploads/foto_siswa/' . $item->foto_siswa) }}"
                                        target="_blank" class="btn btn-sm btn-success mb-2">
                                        <i class="fas fa-image me-1"></i> Lihat Foto Siswa
                                    </a>
                                @else
                                    <span class="text-muted mb-2">Foto siswa tidak tersedia</span>
                                @endif

                                {{-- Foto KIP --}}
                                @if ($item->foto_kip)
                                    <a href="{{ asset('storage/uploads/foto_kip/' . $item->foto_kip) }}" target="_blank"
                                        class="btn btn-sm btn-warning mb-2">
                                        <i class="fas fa-image me-1"></i> Lihat Foto KIP
                                    </a>
                                @else
                                    <span class="text-muted mb-2">Foto KIP tidak tersedia</span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <a href="{{ route('admin.datasiswa.export', $item->id) }}" class="btn btn-success">
                            <i class="fas fa-file-pdf me-1"></i> Ekspor PDF
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
