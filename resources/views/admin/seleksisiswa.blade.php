@extends('Admin.dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-user-graduate"></i> Seleksi Calon Siswa
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Penerimaan Siswa</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Seleksi Calon Siswa</li>
                </ol>
            </nav>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Filter Section -->
        <div class="filter-section animate-fade-in">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label for="statusFilter" class="form-label">Filter Status</label>
                    <select class="form-select" id="statusFilter">
                        <option value="">Semua Status</option>
                        <option value="Baru">Baru</option>
                        <option value="Diterima">Diterima</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="searchInput" class="form-label">Cari Calon Siswa</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="searchInput"
                            placeholder="Cari berdasarkan nama atau NIK...">
                    </div>
                </div>
                <div class="col-md-2 mb-2 d-flex align-items-end">
                    <button class="btn btn-primary w-100" id="btnExport">
                        <i class="fas fa-file-export me-1"></i> Export
                    </button>
                </div>
            </div>
        </div>

        <!-- Tabel Data Siswa -->
        <div class="card animate-fade-in">
            <div class="card-header bg-white">
                <h5 class="card-title text-success mb-0">
                    <i class="fas fa-list me-2"></i> Daftar Calon Siswa
                </h5>
                <div class="d-flex">
                    <span class="badge bg-light text-dark border me-2">Baru:
                        {{ $data->where('status_pendaftaran', 'Baru')->count() }}</span>
                    <span class="badge bg-success me-2">Diterima:
                        {{ $data->where('status_pendaftaran', 'Diterima')->count() }}</span>
                    <span class="badge bg-danger">Ditolak:
                        {{ $data->where('status_pendaftaran', 'Ditolak')->count() }}</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="siswaTable">
                        <thead class="table-success">
                            <tr>
                                <th width="50" class="text-center">No</th>
                                <th>Nama Lengkap</th>
                                <th width="150">NIK</th>
                                <th width="120">Jenis Kelamin</th>
                                <th width="150">Tempat Lahir</th>
                                <th width="120">Tanggal Lahir</th>
                                <th width="150">Status</th>
                                <th width="180" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $key => $siswa)
                                <tr class="border-bottom" data-status="{{ strtolower($siswa->status_pendaftaran) }}" 
                                    data-nama="{{ strtolower($siswa->nama_lengkap) }}" 
                                    data-nik="{{ $siswa->nik }}">
                                    <td class="fw-bold text-center">{{ $key + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-semibold text-success">{{ $siswa->nama_lengkap }}</div>
                                        </div>
                                        <small class="text-muted">Terdaftar:
                                            {{ \Carbon\Carbon::parse($siswa->created_at)->format('d/m/Y') }}</small>
                                    </td>
                                    <td class="text-muted">{{ $siswa->nik }}</td>
                                    <td>
                                        @if ($siswa->jenis_kelamin == 'Laki-laki')
                                            <span class="badge bg-info">Laki-laki</span>
                                        @else
                                            <span class="badge bg-pink">Perempuan</span>
                                        @endif
                                    </td>
                                    <td>{{ $siswa->tempat_lahir }}</td>
                                    <td>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d-m-Y') }}</small>
                                    </td>
                                    <td>
                                        @if ($siswa->status_pendaftaran == 'Baru')
                                            <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i> Baru</span>
                                        @elseif($siswa->status_pendaftaran == 'Diterima')
                                            <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Diterima</span>
                                        @else
                                            <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i> Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                                            <!-- Button Detail -->
                                            <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" 
                                                data-bs-target="#detailModal{{ $siswa->id }}">
                                                <i class="fas fa-eye me-1"></i> Detail
                                            </button>

                                            <!-- Form Diterima -->
                                            <form action="{{ route('admin.seleksisiswa.update', $siswa->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status_pendaftaran" value="Diterima">
                                                <button class="btn btn-sm btn-success" type="submit"
                                                    {{ $siswa->status_pendaftaran == 'Diterima' ? 'disabled' : '' }}
                                                    title="Terima Siswa">
                                                    <i class="fas fa-check"></i> Terima
                                                </button>
                                            </form>

                                            <!-- Form Ditolak -->
                                            <form action="{{ route('admin.seleksisiswa.update', $siswa->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status_pendaftaran" value="Ditolak">
                                                <button class="btn btn-sm btn-outline-danger" type="submit"
                                                    {{ $siswa->status_pendaftaran == 'Ditolak' ? 'disabled' : '' }}
                                                    title="Tolak Siswa">
                                                    <i class="fas fa-times"></i> Tolak
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="empty-state">
                                            <i class="fas fa-user-graduate"></i>
                                            <h4>Belum ada data calon siswa</h4>
                                            <p class="text-muted">Tidak ada data calon siswa yang perlu diseleksi</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if (count($data) > 0)
                <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Menampilkan <span class="fw-bold" id="totalDisplay">0</span> dari 
                        <span class="fw-bold">{{ count($data) }}</span> data calon siswa
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Detail untuk setiap siswa -->
    @foreach($data as $siswa)
    <div class="modal fade" id="detailModal{{ $siswa->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-user-graduate me-2"></i>Detail Data Calon Siswa
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Data Pribadi -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-success">
                                        <i class="fas fa-user me-2"></i>Data Pribadi
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Nama Lengkap</label>
                                            <p class="mb-0">{{ $siswa->nama_lengkap }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">NIK</label>
                                            <p class="mb-0">{{ $siswa->nik }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Jenis Kelamin</label>
                                            <p class="mb-0">{{ $siswa->jenis_kelamin }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Tempat Lahir</label>
                                            <p class="mb-0">{{ $siswa->tempat_lahir }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Tanggal Lahir</label>
                                            <p class="mb-0">{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d F Y') }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">No. HP</label>
                                            <p class="mb-0">{{ $siswa->no_hp ?? '-' }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Email</label>
                                            <p class="mb-0">{{ $siswa->email ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Asal Sekolah -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-success">
                                        <i class="fas fa-school me-2"></i>Data Pendidikan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Asal Sekolah</label>
                                            <p class="mb-0">{{ $siswa->asal_sekolah ?? '-' }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Tahun Lulus</label>
                                            <p class="mb-0">{{ $siswa->tahun_lulus ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Alamat -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-success">
                                        <i class="fas fa-home me-2"></i>Data Alamat
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label class="fw-bold text-success small">Alamat Lengkap</label>
                                            <p class="mb-0">{{ $siswa->alamat }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Kelurahan</label>
                                            <p class="mb-0">{{ $siswa->kelurahan ?? '-' }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Kecamatan</label>
                                            <p class="mb-0">{{ $siswa->kecamatan ?? '-' }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Kabupaten</label>
                                            <p class="mb-0">{{ $siswa->kabupaten ?? '-' }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Provinsi</label>
                                            <p class="mb-0">{{ $siswa->provinsi ?? '-' }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Kode Pos</label>
                                            <p class="mb-0">{{ $siswa->kode_pos ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Orang Tua -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-success">
                                        <i class="fas fa-users me-2"></i>Data Orang Tua
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Nama Ayah</label>
                                            <p class="mb-0">{{ $siswa->nama_ayah ?? '-' }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Pekerjaan Ayah</label>
                                            <p class="mb-0">{{ $siswa->pekerjaan_ayah ?? '-' }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Pendidikan Ayah</label>
                                            <p class="mb-0">{{ $siswa->pendidikan_ayah ?? '-' }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Penghasilan Ayah</label>
                                            <p class="mb-0">{{ $siswa->penghasilan_ayah ?? '-' }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Nama Ibu</label>
                                            <p class="mb-0">{{ $siswa->nama_ibu ?? '-' }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Pekerjaan Ibu</label>
                                            <p class="mb-0">{{ $siswa->pekerjaan_ibu ?? '-' }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Pendidikan Ibu</label>
                                            <p class="mb-0">{{ $siswa->pendidikan_ibu ?? '-' }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Penghasilan Ibu</label>
                                            <p class="mb-0">{{ $siswa->penghasilan_ibu ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Dokumen dan Status -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-success">
                                        <i class="fas fa-file me-2"></i>Dokumen
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Akta Kelahiran</label>
                                            <p class="mb-0">
                                                @if($siswa->akta_kelahiran)
                                                    <span class="badge bg-success">Tersedia</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak Tersedia</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Kartu Keluarga</label>
                                            <p class="mb-0">
                                                @if($siswa->kartu_keluarga)
                                                    <span class="badge bg-success">Tersedia</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak Tersedia</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-success">
                                        <i class="fas fa-info-circle me-2"></i>Status Pendaftaran
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Status</label>
                                            <p class="mb-0">
                                                @if ($siswa->status_pendaftaran == 'Baru')
                                                    <span class="badge bg-warning text-dark">Baru</span>
                                                @elseif($siswa->status_pendaftaran == 'Diterima')
                                                    <span class="badge bg-success">Diterima</span>
                                                @else
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="fw-bold text-success small">Tanggal Pendaftaran</label>
                                            <p class="mb-0">{{ \Carbon\Carbon::parse($siswa->created_at)->format('d F Y H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Basic filtering functionality
        document.addEventListener('DOMContentLoaded', function() {
            const statusFilter = document.getElementById('statusFilter');
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('tbody tr');
            const totalDisplay = document.getElementById('totalDisplay');

            // Initialize total display
            updateTotalDisplay();

            function filterTable() {
                const statusValue = statusFilter.value.toLowerCase();
                const searchValue = searchInput.value.toLowerCase();
                let visibleCount = 0;

                tableRows.forEach(row => {
                    if (row.cells.length > 1) { // Skip empty state row
                        const status = row.getAttribute('data-status');
                        const nama = row.getAttribute('data-nama');
                        const nik = row.getAttribute('data-nik');

                        const statusMatch = statusValue === '' || status === statusValue.toLowerCase();
                        const searchMatch = searchValue === '' || 
                                          nama.includes(searchValue) || 
                                          nik.includes(searchValue);

                        if (statusMatch && searchMatch) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });

                updateTotalDisplay(visibleCount);
            }

            function updateTotalDisplay(count) {
                if (totalDisplay) {
                    totalDisplay.textContent = count !== undefined ? count : tableRows.length;
                }
            }

            statusFilter.addEventListener('change', filterTable);
            searchInput.addEventListener('input', filterTable);

            // Export button functionality
            document.getElementById('btnExport').addEventListener('click', function() {
                alert('Fitur export akan mengunduh data dalam format Excel.');
                // Implementasi export data ke Excel bisa ditambahkan di sini
            });

            // Add animation to form elements
            document.querySelectorAll('.form-control').forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
            });

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection

@section('styles')
    <style>
        :root {
            --primary-color: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
            --secondary-color: #6c757d;
            --light-bg: #f8f9fa;
        }
        
        body {
            background-color: #f5f7f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .page-header {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.1);
            margin-bottom: 2rem;
            border-left: 4px solid var(--primary-color);
        }

        .page-title {
            font-weight: 700;
            font-size: 1.8rem;
            margin: 0;
            color: var(--primary-color);
        }

        .breadcrumb {
            margin-bottom: 0;
            padding: 0.5rem 0;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.1);
            margin-bottom: 2rem;
            background: white;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .card-header {
            background: white;
            border-bottom: 2px solid rgba(46, 125, 50, 0.1);
            padding: 1.2rem 1.5rem;
            border-radius: 12px 12px 0 0 !important;
        }

        .table thead th {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            color: white;
            border: none;
            padding: 1rem;
            font-weight: 600;
            text-align: center;
            font-size: 0.9rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: rgba(46, 125, 50, 0.1);
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .table tbody tr:hover {
            background-color: rgba(46, 125, 50, 0.05);
            border-left-color: var(--primary-color);
        }

        .badge {
            padding: 0.5rem 0.75rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.8rem;
        }

        .btn-sm {
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-success {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-success:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-1px);
        }

        .btn-outline-success {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-success:hover {
            background: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-1px);
        }

        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }

        .btn-outline-danger:hover {
            background: #dc3545;
            border-color: #dc3545;
            transform: translateY(-1px);
        }

        .alert {
            border: none;
            border-radius: 10px;
            padding: 1rem 1.5rem;
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border-left: 4px solid var(--primary-color);
        }

        .empty-state {
            padding: 3rem 1rem;
            text-align: center;
            color: #6c757d;
            background: white;
            border-radius: 12px;
            margin: 2rem 0;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #dee2e6;
        }

        .filter-section {
            padding: 1.5rem;
            background: white;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.1);
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            border-bottom: 2px solid rgba(46, 125, 50, 0.2);
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        }

        .modal-footer {
            border-top: 2px solid rgba(46, 125, 50, 0.2);
        }

        /* Card styles inside modal */
        .modal .card {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 1rem;
        }

        .modal .card-header {
            padding: 0.75rem 1rem;
            background: #f8f9fa !important;
            border-bottom: 1px solid #e9ecef;
        }

        .modal .card-body {
            padding: 1rem;
        }

        .modal .card-title {
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .filter-section .row>div {
                margin-bottom: 1rem;
            }

            .table tbody td {
                padding: 0.75rem 0.5rem;
                font-size: 0.9rem;
            }

            .btn-sm {
                padding: 0.4rem 0.6rem;
                font-size: 0.8rem;
            }

            .modal-dialog {
                margin: 0.5rem;
            }
            
            .modal-xl {
                max-width: 95%;
            }
            
            .d-flex.gap-2 {
                gap: 0.5rem !important;
            }
            
            .btn-sm .me-1 {
                margin-right: 0.25rem !important;
            }

            .modal .card-body .row > div {
                margin-bottom: 0.5rem;
            }

            .modal .card-body .col-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .table thead th {
                font-size: 0.8rem;
                padding: 0.75rem 0.5rem;
            }
        }
    </style>
@endsection