@extends('Admin.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-info-circle"></i> Kelola Informasi PPDB
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Informasi PPDB</li>
            </ol>
        </nav>
    </div>

    <!-- Alert -->
    @if(session('success'))
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
                    <form action="{{ $data->isEmpty() ? route('admin.infoppdb.store') : route('admin.infoppdb.update', $data->first()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if($data->isNotEmpty())
                            @method('PUT')
                        @endif

                        <!-- Jadwal -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-success">
                                <i class="fas fa-calendar-alt me-1"></i> Jadwal PPDB
                            </label>
                            <textarea name="jadwal" rows="3" class="form-control border-success" required>{{ $data->isEmpty() ? old('jadwal') : $data->first()->jadwal }}</textarea>
                            @error('jadwal')
                                <div class="text-danger small mt-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Syarat -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-success">
                                <i class="fas fa-clipboard-list me-1"></i> Syarat Pendaftaran
                            </label>
                            <textarea name="syarat" rows="3" class="form-control border-success" required>{{ $data->isEmpty() ? old('syarat') : $data->first()->syarat }}</textarea>
                            @error('syarat')
                                <div class="text-danger small mt-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Biaya -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-success">
                                <i class="fas fa-money-bill me-1"></i> Rincian Biaya
                            </label>
                            <textarea name="biaya" rows="3" class="form-control border-success" required>{{ $data->isEmpty() ? old('biaya') : $data->first()->biaya }}</textarea>
                            @error('biaya')
                                <div class="text-danger small mt-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- FAQ -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-success">
                                <i class="fas fa-question-circle me-1"></i> FAQ (Opsional)
                            </label>
                            <textarea name="faq" rows="3" class="form-control border-success">{{ $data->isEmpty() ? old('faq') : $data->first()->faq }}</textarea>
                            @error('faq')
                                <div class="text-danger small mt-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kalender -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-success">
                                <i class="fas fa-file-pdf me-1"></i> Kalender Akademik (PDF)
                            </label>
                            <input type="file" name="kalender_akademik" class="form-control border-success" accept="application/pdf">
                            @if($data->isNotEmpty() && $data->first()->kalender_akademik)
                                <div class="mt-2">
                                    <a href="{{ asset('uploads/ppdb/'.$data->first()->kalender_akademik) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> Lihat File
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Brosur -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-success">
                                <i class="fas fa-file-pdf me-1"></i> Brosur (PDF)
                            </label>
                            <input type="file" name="brosur" class="form-control border-success" accept="application/pdf">
                            @if($data->isNotEmpty() && $data->first()->brosur)
                                <div class="mt-2">
                                    <a href="{{ asset('uploads/ppdb/'.$data->first()->brosur) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> Lihat File
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-success btn-icon">
                                <i class="fas fa-save me-2"></i>{{ $data->isEmpty() ? 'Simpan' : 'Perbarui' }}
                            </button>

                            @if($data->isNotEmpty())
                                <button type="button" class="btn btn-danger btn-icon" onclick="confirmDelete({{ $data->first()->id }})">
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
