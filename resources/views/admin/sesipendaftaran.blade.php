@extends('Admin.dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-calendar-alt"></i> Kelola Sesi Pendaftaran
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sesi Pendaftaran</li>
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

        <div class="row animate-fade-in">
            <div class="col-lg-12">
                <!-- Form Card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-success">
                            <i class="fas fa-edit me-2"></i> Form Sesi Pendaftaran
                        </h5>
                    </div>
                    <div class="card-body">
                        <form id="sesiForm" action="{{ route('admin.sesipendaftaran.store') }}" method="POST">
                            @csrf
                            <input type="hidden" id="formMethod" name="_method" value="POST">
                            <input type="hidden" id="sesi_id" name="sesi_id">

                            <div class="mb-4">
                                <label for="nama_sesi" class="form-label fw-bold text-success">
                                    <i class="fas fa-heading me-1"></i> Nama Sesi
                                </label>
                                <input type="text" name="nama_sesi" id="nama_sesi" class="form-control border-success"
                                    placeholder="Contoh: Gelombang 1" required>
                            </div>

                            <div class="mb-4">
                                <label for="tahun_ajaran" class="form-label fw-bold text-success">
                                    <i class="fas fa-calendar me-1"></i> Tahun Ajaran
                                </label>
                                <input type="text" name="tahun_ajaran" id="tahun_ajaran"
                                    class="form-control border-success" placeholder="2025/2026" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="tanggal_mulai" class="form-label fw-bold text-success">
                                        <i class="fas fa-play me-1"></i> Tanggal Mulai
                                    </label>
                                    <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                                        class="form-control border-success" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="tanggal_selesai" class="form-label fw-bold text-success">
                                        <i class="fas fa-stop me-1"></i> Tanggal Selesai
                                    </label>
                                    <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                                        class="form-control border-success" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="status" class="form-label fw-bold text-success">
                                    <i class="fas fa-toggle-on me-1"></i> Status
                                </label>
                                <select name="status" id="status" class="form-select border-success" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-success btn-icon" id="btnSubmit">
                                    <i class="fas fa-save me-2"></i> Simpan
                                </button>
                                <button type="reset" class="btn btn-secondary btn-icon" onclick="resetForm()">
                                    <i class="fas fa-undo me-2"></i> Reset
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Sesi Pendaftaran -->
        <div class="row mt-4 animate-fade-in">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-success">
                            <i class="fas fa-list me-2"></i> Daftar Sesi Pendaftaran
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-success">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Sesi</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                        <th width="20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_sesi }}</td>
                                            <td>{{ $item->tahun_ajaran }}</td>
                                            <td>{{ $item->tanggal_mulai->format('Y-m-d') }}</td>
                                            <td>{{ $item->tanggal_selesai->format('Y-m-d') }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $item->status == 'aktif' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <button class="btn btn-sm btn-info"
                                                        onclick="editSesi({{ $item->id }}, '{{ $item->nama_sesi }}', '{{ $item->tahun_ajaran }}', '{{ $item->tanggal_mulai->format('Y-m-d') }}', '{{ $item->tanggal_selesai->format('Y-m-d') }}', '{{ $item->status }}')">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <form action="{{ route('admin.sesipendaftaran.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Hapus sesi ini?')">
                                                            <i class="fas fa-trash-alt"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada sesi pendaftaran</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editSesi(id, nama_sesi, tahun_ajaran, tanggal_mulai, tanggal_selesai, status) {
            document.getElementById('sesiForm').action = `/admin/sesipendaftaran/${id}`;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('sesi_id').value = id;

            document.getElementById('nama_sesi').value = nama_sesi;
            document.getElementById('tahun_ajaran').value = tahun_ajaran;
            document.getElementById('tanggal_mulai').value = tanggal_mulai;
            document.getElementById('tanggal_selesai').value = tanggal_selesai;
            document.getElementById('status').value = status;

            document.getElementById('btnSubmit').innerHTML = '<i class="fas fa-save me-2"></i> Perbarui';
        }

        function resetForm() {
            document.getElementById('sesiForm').action = `{{ route('admin.sesipendaftaran.store') }}`;
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('sesi_id').value = '';

            document.getElementById('btnSubmit').innerHTML = '<i class="fas fa-save me-2"></i> Simpan';
        }
    </script>
@endsection
