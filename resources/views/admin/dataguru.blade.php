@extends('Admin.dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-chalkboard-teacher"></i> Kelola Data Guru
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Guru</li>
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
                            <i class="fas {{ empty($guru) ? 'fa-plus-circle' : 'fa-edit' }} me-2"></i>
                            {{ empty($guru) ? 'Tambah' : 'Edit' }} Data Guru
                        </h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ empty($guru) ? route('admin.dataguru.store') : route('admin.dataguru.update', $guru->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (!empty($guru))
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="nama_lengkap" class="form-label fw-bold text-success">
                                            <i class="fas fa-user me-1"></i> Nama Lengkap
                                        </label>
                                        <input type="text" name="nama_lengkap" id="nama_lengkap"
                                            class="form-control border-success" placeholder="Masukkan nama lengkap"
                                            value="{{ empty($guru) ? old('nama_lengkap') : $guru->nama_lengkap }}" required>
                                        @error('nama_lengkap')
                                            <div class="text-danger small mt-2">
                                                <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="jenis_kelamin" class="form-label fw-bold text-success">
                                            <i class="fas fa-venus-mars me-1"></i> Jenis Kelamin
                                        </label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control border-success"
                                            required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L"
                                                {{ (empty($guru) ? old('jenis_kelamin') : $guru->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="P"
                                                {{ (empty($guru) ? old('jenis_kelamin') : $guru->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="text-danger small mt-2">
                                                <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="jabatan" class="form-label fw-bold text-success">
                                            <i class="fas fa-briefcase me-1"></i> Jabatan
                                        </label>
                                        <input type="text" name="jabatan" id="jabatan"
                                            class="form-control border-success" placeholder="Masukkan jabatan"
                                            value="{{ empty($guru) ? old('jabatan') : $guru->jabatan }}">
                                        @error('jabatan')
                                            <div class="text-danger small mt-2">
                                                <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="mata_pelajaran" class="form-label fw-bold text-success">
                                            <i class="fas fa-book me-1"></i> Mata Pelajaran
                                        </label>
                                        <input type="text" name="mata_pelajaran" id="mata_pelajaran"
                                            class="form-control border-success" placeholder="Masukkan mata pelajaran"
                                            value="{{ empty($guru) ? old('mata_pelajaran') : $guru->mata_pelajaran }}">
                                        @error('mata_pelajaran')
                                            <div class="text-danger small mt-2">
                                                <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="pendidikan_terakhir" class="form-label fw-bold text-success">
                                            <i class="fas fa-graduation-cap me-1"></i> Pendidikan Terakhir
                                        </label>
                                        <input type="text" name="pendidikan_terakhir" id="pendidikan_terakhir"
                                            class="form-control border-success" placeholder="Masukkan pendidikan terakhir"
                                            value="{{ empty($guru) ? old('pendidikan_terakhir') : $guru->pendidikan_terakhir }}">
                                        @error('pendidikan_terakhir')
                                            <div class="text-danger small mt-2">
                                                <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="status" class="form-label fw-bold text-success">
                                            <i class="fas fa-info-circle me-1"></i> Status
                                        </label>
                                        <select name="status" id="status" class="form-select border-success">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="Aktif"
                                                {{ (empty($guru) ? old('status') : $guru->status) == 'Aktif' ? 'selected' : '' }}>
                                                Aktif</option>
                                            <option value="Tidak Aktif"
                                                {{ (empty($guru) ? old('status') : $guru->status) == 'Tidak Aktif' ? 'selected' : '' }}>
                                                Tidak Aktif</option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger small mt-2">
                                                <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="email" class="form-label fw-bold text-success">
                                            <i class="fas fa-envelope me-1"></i> Email
                                        </label>
                                        <input type="email" name="email" id="email"
                                            class="form-control border-success" placeholder="Masukkan email"
                                            value="{{ empty($guru) ? old('email') : $guru->email }}">
                                        @error('email')
                                            <div class="text-danger small mt-2">
                                                <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="no_hp" class="form-label fw-bold text-success">
                                            <i class="fas fa-phone me-1"></i> No. HP
                                        </label>
                                        <input type="text" name="no_hp" id="no_hp"
                                            class="form-control border-success" placeholder="Masukkan nomor HP"
                                            value="{{ empty($guru) ? old('no_hp') : $guru->no_hp }}">
                                        @error('no_hp')
                                            <div class="text-danger small mt-2">
                                                <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="foto" class="form-label fw-bold text-success">
                                    <i class="fas fa-image me-1"></i> Foto Guru
                                </label>
                                <input type="file" name="foto" id="foto" class="form-control border-success"
                                    accept="image/*">
                                @error('foto')
                                    <div class="text-danger small mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                                @if (!empty($guru) && $guru->foto)
                                    <div class="mt-2">
                                        <img src="{{ asset('uploads/guru/' . $guru->foto) }}" alt="Foto Guru"
                                            width="150" class="img-thumbnail">
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-success btn-icon">
                                    <i class="fas fa-save me-2"></i>{{ empty($guru) ? 'Simpan' : 'Perbarui' }}
                                </button>

                                @if (!empty($guru))
                                    <button type="button" class="btn btn-danger btn-icon"
                                        onclick="confirmDelete({{ $guru->id }})">
                                        <i class="fas fa-trash-alt me-2"></i>Hapus
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Guru -->
        <div class="row mt-4 animate-fade-in">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-success">
                            <i class="fas fa-list me-2"></i> Daftar Guru
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-success">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Foto</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Jabatan</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Status</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($item->foto)
                                                    <img src="{{ asset('uploads/guru/' . $item->foto) }}" alt="Foto Guru"
                                                        width="60" class="rounded-circle">
                                                @else
                                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 60px; height: 60px;">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $item->nama_lengkap ?? '-' }}</td>
                                            <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                            <td>{{ $item->jabatan ?? '-' }}</td>
                                            <td>{{ $item->mata_pelajaran ?? '-' }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $item->status == 'Aktif' ? 'success' : 'secondary' }}">
                                                    {{ $item->status ?? 'Tidak Aktif' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.dataguru.edit', $item->id) }}"
                                                    class="btn btn-sm btn-info mb-1">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.dataguru.destroy', $item->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Hapus data guru ini?')">
                                                        <i class="fas fa-trash-alt"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data guru</td>
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

    <!-- Delete Form (hidden) -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        // Confirm delete function
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2e7d32',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('deleteForm');
                    form.action = `/admin/dataguru/${id}`;
                    form.submit();
                }
            });
        }

        // Add animation to form elements
        document.querySelectorAll('.form-control').forEach((element, index) => {
            element.style.animationDelay = `${index * 0.1}s`;
        });
    </script>

    <style>
        /* Custom styles for this page */
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-radius: 12px 12px 0 0 !important;
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .form-control {
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.25);
        }

        textarea.form-control {
            min-height: 120px;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-success {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }

        .btn-success:hover {
            background-color: #1b5e20;
            border-color: #1b5e20;
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

        .table th {
            font-weight: 600;
        }

        .badge {
            font-size: 0.85em;
            padding: 0.5em 0.75em;
        }
    </style>
@endsection
