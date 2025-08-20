@extends('Admin.dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-building"></i> Kelola Sarana & Prasarana
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sarana & Prasarana</li>
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
                            <i class="fas {{ empty($sarana) ? 'fa-plus-circle' : 'fa-edit' }} me-2"></i>
                            {{ empty($sarana) ? 'Tambah' : 'Edit' }} Sarana & Prasarana
                        </h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ empty($sarana) ? route('admin.saranaprasarana.store') : route('admin.saranaprasarana.update', $sarana->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (!empty($sarana))
                                @method('PUT')
                            @endif

                            <div class="mb-4">
                                <label for="nama_fasilitas" class="form-label fw-bold text-success">
                                    <i class="fas fa-tag me-1"></i> Nama Fasilitas
                                </label>
                                <input type="text" name="nama_fasilitas" id="nama_fasilitas"
                                    class="form-control border-success" placeholder="Masukkan nama fasilitas"
                                    value="{{ empty($sarana) ? old('nama_fasilitas') : $sarana->nama_fasilitas }}" required>
                                @error('nama_fasilitas')
                                    <div class="text-danger small mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="jenis_fasilitas" class="form-label fw-bold text-success">
                                    <i class="fas fa-list me-1"></i> Jenis Fasilitas
                                </label>
                                <select name="jenis_fasilitas" id="jenis_fasilitas" class="form-control border-success">
                                    <option value="">Pilih Jenis Fasilitas</option>
                                    <option value="Gedung"
                                        {{ (empty($sarana) ? old('jenis_fasilitas') : $sarana->jenis_fasilitas) == 'Sarana' ? 'selected' : '' }}>
                                        Sarana</option>
                                    <option value="Laboratorium"
                                        {{ (empty($sarana) ? old('jenis_fasilitas') : $sarana->jenis_fasilitas) == 'Prasarana' ? 'selected' : '' }}>
                                        Prasarana</option>
                                </select>
                                @error('jenis_fasilitas')
                                    <div class="text-danger small mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="mb-4">
                                <label for="deskripsi" class="form-label fw-bold text-success">
                                    <i class="fas fa-align-left me-1"></i> Deskripsi
                                </label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control border-success"
                                    placeholder="Masukkan deskripsi fasilitas">{{ empty($sarana) ? old('deskripsi') : $sarana->deskripsi }}</textarea>
                                @error('deskripsi')
                                    <div class="text-danger small mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="kondisi" class="form-label fw-bold text-success">
                                    <i class="fas fa-check-circle me-1"></i> Kondisi
                                </label>
                                <select name="kondisi" id="kondisi" class="form-control border-success">
                                    <option value="">Pilih Kondisi</option>
                                    <option value="Baik"
                                        {{ (empty($sarana) ? old('kondisi') : $sarana->kondisi) == 'Baik' ? 'selected' : '' }}>
                                        Baik</option>
                                    <option value="Cukup"
                                        {{ (empty($sarana) ? old('kondisi') : $sarana->kondisi) == 'Cukup' ? 'selected' : '' }}>
                                        Cukup</option>
                                    <option value="Kurang"
                                        {{ (empty($sarana) ? old('kondisi') : $sarana->kondisi) == 'Kurang' ? 'selected' : '' }}>
                                        Kurang</option>

                                </select>
                                @error('kondisi')
                                    <div class="text-danger small mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="foto" class="form-label fw-bold text-success">
                                    <i class="fas fa-image me-1"></i> Foto Fasilitas
                                </label>
                                <input type="file" name="foto" id="foto" class="form-control border-success"
                                    accept="image/*">
                                @error('foto')
                                    <div class="text-danger small mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                                @if (!empty($sarana) && $sarana->foto)
                                    <div class="mt-2">
                                        <img src="{{ asset('uploads/sarana_prasarana/' . $sarana->foto) }}"
                                            alt="Foto Fasilitas" width="150" class="img-thumbnail">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-4">
                                <label for="tahun_pengadaan" class="form-label fw-bold text-success">
                                    <i class="fas fa-calendar me-1"></i> Tahun Pengadaan
                                </label>
                                <input type="number" name="tahun_pengadaan" id="tahun_pengadaan"
                                    class="form-control border-success"
                                    placeholder="Masukkan tahun pengadaan (contoh: 2023)" min="1900"
                                    max="{{ date('Y') + 5 }}"
                                    value="{{ empty($sarana) ? old('tahun_pengadaan') : $sarana->tahun_pengadaan }}">
                                @error('tahun_pengadaan')
                                    <div class="text-danger small mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-success btn-icon">
                                    <i class="fas fa-save me-2"></i>{{ empty($sarana) ? 'Simpan' : 'Perbarui' }}
                                </button>

                                @if (!empty($sarana))
                                    <button type="button" class="btn btn-danger btn-icon"
                                        onclick="confirmDelete({{ $sarana->id }})">
                                        <i class="fas fa-trash-alt me-2"></i>Hapus
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Sarana & Prasarana -->
        <div class="row mt-4 animate-fade-in">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-success">
                            <i class="fas fa-list me-2"></i> Daftar Sarana & Prasarana
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-success">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Nama Fasilitas</th>
                                        <th>Jenis</th>
                                        <th>Deskripsi</th>
                                        <th>Kondisi</th>
                                        <th>Foto</th>
                                        <th>Tahun</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_fasilitas ?? '-' }}</td>
                                            <td>{{ $item->jenis_fasilitas ?? '-' }}</td>
                                            <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                                            <td>
                                                @if ($item->kondisi == 'Baik')
                                                    <span class="badge bg-success">{{ $item->kondisi }}</span>
                                                @elseif($item->kondisi == 'Rusak Ringan')
                                                    <span class="badge bg-warning">{{ $item->kondisi }}</span>
                                                @elseif($item->kondisi == 'Rusak Berat')
                                                    <span class="badge bg-danger">{{ $item->kondisi }}</span>
                                                @elseif($item->kondisi == 'Dalam Perbaikan')
                                                    <span class="badge bg-info">{{ $item->kondisi }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $item->kondisi ?? '-' }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->foto)
                                                    <img src="{{ asset('uploads/sarana_prasarana/' . $item->foto) }}"
                                                        alt="Foto Fasilitas" width="80">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $item->tahun_pengadaan ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('admin.saranaprasarana.edit', $item->id) }}"
                                                    class="btn btn-sm btn-info mb-1">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.saranaprasarana.destroy', $item->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Hapus data ini?')">
                                                        <i class="fas fa-trash-alt"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data sarana & prasarana</td>
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
                    form.action = `/admin/saranaprasarana/${id}`;
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
            padding: 0.35em 0.65em;
        }
    </style>
@endsection
