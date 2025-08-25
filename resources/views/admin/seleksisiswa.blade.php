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
        <div class="filter-section animate-fade-in mb-3">
            <div class="row g-2 align-items-end">
                <!-- Filter Status -->
                <div class="col-md-4 col-lg-3">
                    <label for="statusFilter" class="form-label">Filter Status</label>
                    <select class="form-select" id="statusFilter">
                        <option value="">Semua Status</option>
                        <option value="Baru">Baru</option>
                        <option value="Diterima">Diterima</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>

                <!-- Filter Tahun Ajaran -->
                <div class="col-md-4 col-lg-3">
                    <label for="tahunAjaranFilter" class="form-label">Filter Tahun Ajaran</label>
                    <select class="form-select" id="tahunAjaranFilter">
                        <option value="">Semua Tahun</option>
                    </select>
                </div>
                <!-- Search Input -->
                <div class="col-md-5 col-lg-5">
                    <label for="searchInput" class="form-label">Cari Calon Siswa</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="searchInput"
                            placeholder="Cari berdasarkan nama atau NIK...">
                    </div>
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
                                <th width="180">Status</th>
                                <th width="200" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $key => $siswa)
                                <tr class="border-bottom" data-status="{{ $siswa->status_pendaftaran }}"
                                    data-nama="{{ strtolower($siswa->nama_lengkap) }}" data-nik="{{ $siswa->nik }}"
                                    data-tahun="{{ \Carbon\Carbon::parse($siswa->created_at)->format('Y') }}">
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
                                        <small
                                            class="text-muted">{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d-m-Y') }}</small>
                                    </td>
                                    <td>
                                        @if ($siswa->status_pendaftaran == 'Baru')
                                            <span class="badge bg-warning text-dark mb-2"><i class="fas fa-clock me-1"></i>
                                                Baru</span>
                                            <div class="d-flex flex-wrap gap-1">
                                                <form action="{{ route('admin.seleksisiswa.updateStatus', $siswa->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="Diterima">
                                                    <button class="btn btn-sm btn-success" type="submit"
                                                        title="Terima Siswa">
                                                        <i class="fas fa-check"></i> Terima
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.seleksisiswa.updateStatus', $siswa->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="Ditolak">
                                                    <button class="btn btn-sm btn-outline-danger" type="submit"
                                                        title="Tolak Siswa">
                                                        <i class="fas fa-times"></i> Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span
                                                class="badge {{ $siswa->status_pendaftaran == 'Diterima' ? 'bg-success' : 'bg-danger' }} mb-2">
                                                <i
                                                    class="fas {{ $siswa->status_pendaftaran == 'Diterima' ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                                                {{ $siswa->status_pendaftaran }}
                                            </span>
                                            <div>
                                                <form action="{{ route('admin.seleksisiswa.updateStatus', $siswa->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="Baru">
                                                    <button class="btn btn-sm btn-outline-warning" type="submit"
                                                        title="Reset Status">
                                                        <i class="fas fa-undo"></i> Reset
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1 justify-content-center">
                                            <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                                data-bs-target="#detailModal{{ $siswa->id }}">
                                                <i class="fas fa-eye me-1"></i> Detail
                                            </button>
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $siswa->id }}">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </button>
                                            <form action="{{ route('admin.seleksisiswa.destroy', $siswa->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')">
                                                    <i class="fas fa-trash me-1"></i> Hapus
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

        <!-- Modal Detail untuk setiap siswa -->
        @foreach ($data as $siswa)
            <div class="modal fade" id="detailModal{{ $siswa->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">
                                <i class="fas fa-user-graduate me-2"></i>Detail Data Calon Siswa
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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
                                                    <p class="mb-0">
                                                        {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d F Y') }}
                                                    </p>
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
                                                        @if ($siswa->akta_kelahiran)
                                                            <span class="badge bg-success">Tersedia</span>
                                                        @else
                                                            <span class="badge bg-danger">Tidak Tersedia</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label class="fw-bold text-success small">Kartu Keluarga</label>
                                                    <p class="mb-0">
                                                        @if ($siswa->kartu_keluarga)
                                                            <span class="badge bg-success">Tersedia</span>
                                                        @else
                                                            <span class="badge bg-danger">Tersedia</span>
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
                                                    <p class="mb-0">
                                                        {{ \Carbon\Carbon::parse($siswa->created_at)->format('d F Y H:i') }}
                                                    </p>
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

            <!-- Modal Edit untuk setiap siswa -->
            <div class="modal fade" id="editModal{{ $siswa->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Data Calon Siswa</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.seleksisiswa.update', $siswa->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row">
                                    <!-- Nama Lengkap -->
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_lengkap{{ $siswa->id }}" class="form-label">Nama Lengkap
                                            *</label>
                                        <input type="text" class="form-control" id="nama_lengkap{{ $siswa->id }}"
                                            name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}"
                                            required>
                                        @error('nama_lengkap')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- NIK -->
                                    <div class="col-md-6 mb-3">
                                        <label for="nik{{ $siswa->id }}" class="form-label">NIK *</label>
                                        <input type="text" class="form-control" id="nik{{ $siswa->id }}"
                                            name="nik" value="{{ old('nik', $siswa->nik) }}" required>
                                        @error('nik')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Jenis Kelamin -->
                                    <div class="col-md-6 mb-3">
                                        <label for="jenis_kelamin{{ $siswa->id }}" class="form-label">Jenis Kelamin
                                            *</label>
                                        <select class="form-select" id="jenis_kelamin{{ $siswa->id }}"
                                            name="jenis_kelamin" required>
                                            <option value="Laki-laki"
                                                {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="Perempuan"
                                                {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tempat Lahir -->
                                    <div class="col-md-6 mb-3">
                                        <label for="tempat_lahir{{ $siswa->id }}" class="form-label">Tempat Lahir
                                            *</label>
                                        <input type="text" class="form-control" id="tempat_lahir{{ $siswa->id }}"
                                            name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}"
                                            required>
                                        @error('tempat_lahir')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tanggal Lahir -->
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_lahir{{ $siswa->id }}" class="form-label">Tanggal Lahir
                                            *</label>
                                        <input type="date" class="form-control" id="tanggal_lahir{{ $siswa->id }}"
                                            name="tanggal_lahir"
                                            value="{{ old('tanggal_lahir', \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('Y-m-d')) }}"
                                            required>
                                        @error('tanggal_lahir')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- No HP -->
                                    <div class="col-md-6 mb-3">
                                        <label for="no_hp{{ $siswa->id }}" class="form-label">No. HP</label>
                                        <input type="text" class="form-control" id="no_hp{{ $siswa->id }}"
                                            name="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}">
                                        @error('no_hp')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6 mb-3">
                                        <label for="email{{ $siswa->id }}" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email{{ $siswa->id }}"
                                            name="email" value="{{ old('email', $siswa->email) }}">
                                        @error('email')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Asal Sekolah -->
                                    <div class="col-md-6 mb-3">
                                        <label for="asal_sekolah{{ $siswa->id }}" class="form-label">Asal
                                            Sekolah</label>
                                        <input type="text" class="form-control" id="asal_sekolah{{ $siswa->id }}"
                                            name="asal_sekolah" value="{{ old('asal_sekolah', $siswa->asal_sekolah) }}">
                                        @error('asal_sekolah')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tahun Lulus -->
                                    <div class="col-md-6 mb-3">
                                        <label for="tahun_lulus{{ $siswa->id }}" class="form-label">Tahun
                                            Lulus</label>
                                        <input type="number" class="form-control" id="tahun_lulus{{ $siswa->id }}"
                                            name="tahun_lulus" value="{{ old('tahun_lulus', $siswa->tahun_lulus) }}"
                                            min="2000" max="{{ date('Y') + 1 }}">
                                        @error('tahun_lulus')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Alamat -->
                                    <div class="col-12 mb-3">
                                        <label for="alamat{{ $siswa->id }}" class="form-label">Alamat</label>
                                        <textarea class="form-control" id="alamat{{ $siswa->id }}" name="alamat" rows="2">{{ old('alamat', $siswa->alamat) }}</textarea>
                                        @error('alamat')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Kelurahan, Kecamatan, Kabupaten -->
                                    <div class="col-md-4 mb-3">
                                        <label for="kelurahan{{ $siswa->id }}" class="form-label">Kelurahan</label>
                                        <input type="text" class="form-control" id="kelurahan{{ $siswa->id }}"
                                            name="kelurahan" value="{{ old('kelurahan', $siswa->kelurahan) }}">
                                        @error('kelurahan')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="kecamatan{{ $siswa->id }}" class="form-label">Kecamatan</label>
                                        <input type="text" class="form-control" id="kecamatan{{ $siswa->id }}"
                                            name="kecamatan" value="{{ old('kecamatan', $siswa->kecamatan) }}">
                                        @error('kecamatan')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="kabupaten{{ $siswa->id }}" class="form-label">Kabupaten</label>
                                        <input type="text" class="form-control" id="kabupaten{{ $siswa->id }}"
                                            name="kabupaten" value="{{ old('kabupaten', $siswa->kabupaten) }}">
                                        @error('kabupaten')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Provinsi, Kode Pos -->
                                    <div class="col-md-6 mb-3">
                                        <label for="provinsi{{ $siswa->id }}" class="form-label">Provinsi</label>
                                        <input type="text" class="form-control" id="provinsi{{ $siswa->id }}"
                                            name="provinsi" value="{{ old('provinsi', $siswa->provinsi) }}">
                                        @error('provinsi')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="kode_pos{{ $siswa->id }}" class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" id="kode_pos{{ $siswa->id }}"
                                            name="kode_pos" value="{{ old('kode_pos', $siswa->kode_pos) }}">
                                        @error('kode_pos')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Data Ayah -->
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_ayah{{ $siswa->id }}" class="form-label">Nama Ayah</label>
                                        <input type="text" class="form-control" id="nama_ayah{{ $siswa->id }}"
                                            name="nama_ayah" value="{{ old('nama_ayah', $siswa->nama_ayah) }}">
                                        @error('nama_ayah')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="pekerjaan_ayah{{ $siswa->id }}" class="form-label">Pekerjaan
                                            Ayah</label>
                                        <input type="text" class="form-control"
                                            id="pekerjaan_ayah{{ $siswa->id }}" name="pekerjaan_ayah"
                                            value="{{ old('pekerjaan_ayah', $siswa->pekerjaan_ayah) }}">
                                        @error('pekerjaan_ayah')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="pendidikan_ayah{{ $siswa->id }}" class="form-label">Pendidikan
                                            Ayah</label>
                                        <input type="text" class="form-control"
                                            id="pendidikan_ayah{{ $siswa->id }}" name="pendidikan_ayah"
                                            value="{{ old('pendidikan_ayah', $siswa->pendidikan_ayah) }}">
                                        @error('pendidikan_ayah')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="penghasilan_ayah{{ $siswa->id }}" class="form-label">Penghasilan
                                            Ayah</label>
                                        <input type="text" class="form-control"
                                            id="penghasilan_ayah{{ $siswa->id }}" name="penghasilan_ayah"
                                            value="{{ old('penghasilan_ayah', $siswa->penghasilan_ayah) }}">
                                        @error('penghasilan_ayah')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Data Ibu -->
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_ibu{{ $siswa->id }}" class="form-label">Nama Ibu</label>
                                        <input type="text" class="form-control" id="nama_ibu{{ $siswa->id }}"
                                            name="nama_ibu" value="{{ old('nama_ibu', $siswa->nama_ibu) }}">
                                        @error('nama_ibu')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="pekerjaan_ibu{{ $siswa->id }}" class="form-label">Pekerjaan
                                            Ibu</label>
                                        <input type="text" class="form-control"
                                            id="pekerjaan_ibu{{ $siswa->id }}" name="pekerjaan_ibu"
                                            value="{{ old('pekerjaan_ibu', $siswa->pekerjaan_ibu) }}">
                                        @error('pekerjaan_ibu')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="pendidikan_ibu{{ $siswa->id }}" class="form-label">Pendidikan
                                            Ibu</label>
                                        <input type="text" class="form-control"
                                            id="pendidikan_ibu{{ $siswa->id }}" name="pendidikan_ibu"
                                            value="{{ old('pendidikan_ibu', $siswa->pendidikan_ibu) }}">
                                        @error('pendidikan_ibu')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="penghasilan_ibu{{ $siswa->id }}" class="form-label">Penghasilan
                                            Ibu</label>
                                        <input type="text" class="form-control"
                                            id="penghasilan_ibu{{ $siswa->id }}" name="penghasilan_ibu"
                                            value="{{ old('penghasilan_ibu', $siswa->penghasilan_ibu) }}">
                                        @error('penghasilan_ibu')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusFilter = document.getElementById('statusFilter');
            const searchInput = document.getElementById('searchInput');
            const tahunAjaranFilter = document.getElementById('tahunAjaranFilter');
            const tableRows = document.querySelectorAll('tbody tr');
            const totalDisplay = document.getElementById('totalDisplay');

            // Fungsi update total
            function updateTotalDisplay(count) {
                if (totalDisplay) {
                    totalDisplay.textContent = count !== undefined ? count : tableRows.length;
                }
            }

            // Generate opsi tahun ajaran
            function generateTahunAjaranOptions() {
                const years = new Set();
                tableRows.forEach(row => {
                    if (row.getAttribute('data-tahun')) {
                        years.add(row.getAttribute('data-tahun'));
                    }
                });

                const sortedYears = Array.from(years).sort((a, b) => b - a);
                let options = '<option value="">Semua Tahun</option>';

                sortedYears.forEach(year => {
                    options += `<option value="${year}">${year}/${parseInt(year) + 1}</option>`;
                });

                if (tahunAjaranFilter) {
                    tahunAjaranFilter.innerHTML = options;
                }
            }

            // Fungsi filter
            function filterTable() {
                const statusValue = statusFilter ? statusFilter.value : '';
                const searchValue = searchInput ? searchInput.value.toLowerCase() : '';
                const tahunValue = tahunAjaranFilter ? tahunAjaranFilter.value : '';
                let visibleCount = 0;

                tableRows.forEach(row => {
                    if (row.cells.length > 1) {
                        const status = row.getAttribute('data-status') || '';
                        const nama = row.getAttribute('data-nama')?.toLowerCase() || '';
                        const nik = row.getAttribute('data-nik')?.toLowerCase() || '';
                        const tahun = row.getAttribute('data-tahun') || '';

                        const statusMatch = statusValue === '' || status === statusValue;
                        const searchMatch = searchValue === '' || nama.includes(searchValue) || nik
                            .includes(searchValue);
                        const tahunMatch = tahunValue === '' || tahun === tahunValue;

                        if (statusMatch && searchMatch && tahunMatch) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });

                updateTotalDisplay(visibleCount);
            }

            // Inisialisasi
            generateTahunAjaranOptions();
            filterTable();

            if (statusFilter) statusFilter.addEventListener('change', filterTable);
            if (searchInput) searchInput.addEventListener('input', filterTable);
            if (tahunAjaranFilter) tahunAjaranFilter.addEventListener('change', filterTable);

            // Animasi
            document.querySelectorAll('.form-control').forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
            });

            // Tooltip
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            tooltipTriggerList.map(el => new bootstrap.Tooltip(el));

            // Validasi form
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    const requiredFields = this.querySelectorAll('[required]');
                    let valid = true;

                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            valid = false;
                            field.classList.add('is-invalid');
                            if (!field.nextElementSibling || !field.nextElementSibling
                                .classList.contains('text-danger')) {
                                const errorDiv = document.createElement('div');
                                errorDiv.className = 'text-danger small';
                                errorDiv.textContent = 'Field ini wajib diisi';
                                field.parentNode.appendChild(errorDiv);
                            }
                        } else {
                            field.classList.remove('is-invalid');
                            if (field.nextElementSibling && field.nextElementSibling
                                .classList.contains('text-danger')) {
                                field.nextElementSibling.remove();
                            }
                        }
                    });

                    if (!valid) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Harap isi semua field yang wajib diisi!',
                        });
                    }
                });
            });

            // Hapus error saat input
            document.querySelectorAll('.form-control').forEach(input => {
                input.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.classList.remove('is-invalid');
                        if (this.nextElementSibling && this.nextElementSibling.classList.contains(
                                'text-danger')) {
                            this.nextElementSibling.remove();
                        }
                    }
                });
            });
        });
    </script>
@endsection

@section('styles')
    <style>
        /* Edit modal specific styles */
        .modal-lg {
            max-width: 800px;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #2e7d32;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #2e7d32;
            box-shadow: 0 0 0 0.2rem rgba(46, 125, 50, 0.25);
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        /* Responsive adjustments for edit modal */
        @media (max-width: 992px) {
            .modal-lg {
                max-width: 95%;
            }
        }

        @media (max-width: 768px) {
            .modal-body .row>[class*="col-"] {
                margin-bottom: 1rem;
            }

            .modal-body .mb-3 {
                margin-bottom: 0.75rem !important;
            }
        }

        /* Add to your styles */
        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
        }

        .is-invalid {
            border-color: #dc3545;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 3.6.4.4.4-.4'/%3e%3cpath d='M6 7v1'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
    </style>
@endsection
