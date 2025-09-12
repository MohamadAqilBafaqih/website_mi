@extends('Admin.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="page-header mb-4"
            style="background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title" style="color: #ffffff; font-weight: 700;">
                        <i class="fas fa-info-circle me-2"></i> Kelola Informasi PPDB
                    </h1>
                    <p class="mb-0">Atur dan kelola informasi PPDB madrasah</p>
                </div>
            </div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: transparent; padding: 0; margin-bottom: 0;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" style="color: #e0e0e0;">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page" style="color: #ffffff;">
                        Informasi PPDB
                    </li>
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
                            <i class="fas {{ $data->isEmpty() ? 'fa-plus-circle' : 'fa-edit' }} me-2"></i>
                            {{ $data->isEmpty() ? 'Tambah' : 'Perbarui' }} Informasi PPDB
                        </h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ $data->isEmpty() ? route('admin.infoppdb.store') : route('admin.infoppdb.update', $data->first()->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($data->isNotEmpty())
                                @method('PUT')
                            @endif

                            <!-- Jadwal -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-success">
                                    <i class="fas fa-calendar-alt me-1"></i> Jadwal PPDB
                                </label>
                                <textarea name="jadwal" rows="3" class="form-control border-success" required>{{ $data->isEmpty() ? old('jadwal') : $data->first()->jadwal }}</textarea>
                                @error('jadwal')
                                    <div class="text-danger small mt-2"><i
                                            class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Syarat -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-success">
                                    <i class="fas fa-clipboard-list me-1"></i> Syarat Pendaftaran
                                </label>
                                <textarea name="syarat" rows="3" class="form-control border-success" required>{{ $data->isEmpty() ? old('syarat') : $data->first()->syarat }}</textarea>
                                @error('syarat')
                                    <div class="text-danger small mt-2"><i
                                            class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Biaya -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-success">
                                    <i class="fas fa-money-bill me-1"></i> Rincian Biaya
                                </label>
                                <textarea name="biaya" rows="3" class="form-control border-success" required>{{ $data->isEmpty() ? old('biaya') : $data->first()->biaya }}</textarea>
                                @error('biaya')
                                    <div class="text-danger small mt-2"><i
                                            class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold text-success">
                                    <i class="fas fa-link me-1"></i> Link Grup Calon Siswa
                                </label>
                                <input type="url" name="link" class="form-control border-success"
                                    value="{{ $data->isEmpty() ? old('link') : $data->first()->link }}">
                                @error('link')
                                    <div class="text-danger small mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Kalender -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-success">
                                    <i class="fas fa-image me-1"></i> Kalender Akademik (Gambar)
                                </label>
                                <input type="file" name="kalender_akademik" class="form-control border-success"
                                    accept="image/*">

                                @if ($data->isNotEmpty() && $data->first()->kalender_akademik)
                                    <div class="mt-3">
                                        <img src="{{ asset('uploads/ppdb/' . $data->first()->kalender_akademik) }}"
                                            alt="Kalender Akademik" class="img-fluid rounded shadow-sm"
                                            style="max-height: 300px;">
                                    </div>
                                @endif
                            </div>


                            <!-- Brosur -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-success">
                                    <i class="fas fa-image me-1"></i> Brosur (Gambar)
                                </label>
                                <input type="file" name="brosur" class="form-control border-success" accept="image/*">

                                @if ($data->isNotEmpty() && $data->first()->brosur)
                                    <div class="mt-3">
                                        <img src="{{ asset('uploads/ppdb/' . $data->first()->brosur) }}" alt="Brosur PPDB"
                                            class="img-fluid rounded shadow-sm" style="max-height: 250px;">
                                    </div>
                                @endif
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-success btn-icon">
                                    <i class="fas fa-save me-2"></i>{{ $data->isEmpty() ? 'Simpan' : 'Perbarui' }}
                                </button>

                                @if ($data->isNotEmpty())
                                    <button type="button" class="btn btn-danger btn-icon"
                                        onclick="confirmDelete({{ $data->first()->id }})">
                                        <i class="fas fa-trash-alt me-2"></i> Hapus
                                    </button>
                                @endif
                            </div>
                        </form>
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
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2e7d32',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('deleteForm');
                    form.action = `/admin/infoppdb/${id}`;
                    form.submit();
                }
            });
        }
    </script>
@endsection
