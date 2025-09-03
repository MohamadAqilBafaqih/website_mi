@extends('Admin.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-bullhorn"></i> Kelola Pengumuman
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengumuman</li>
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
                        {{ $data->isEmpty() ? 'Tambah' : 'Perbarui' }} Pengumuman
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ $data->isEmpty() ? route('admin.pengumuman.store') : route('admin.pengumuman.update', $data->first()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if($data->isNotEmpty())
                            @method('PUT')
                        @endif
                        
                        <!-- Running Teks -->
                        <div class="mb-4">
                            <label for="running_teks" class="form-label fw-bold text-success">
                                <i class="fas fa-align-left me-1"></i> Running Teks
                            </label>
                            <textarea name="running_teks" id="running_teks" rows="3" class="form-control border-success" placeholder="Masukkan running teks" required>{{ $data->isEmpty() ? old('running_teks') : $data->first()->running_teks }}</textarea>
                            @error('running_teks')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Foto Slide -->
                        @for ($i = 1; $i <= 3; $i++)
                        <div class="mb-4">
                            <label for="foto_slide{{ $i }}" class="form-label fw-bold text-success">
                                <i class="fas fa-image me-1"></i> Foto Slide {{ $i }}
                            </label>
                            <input type="file" name="foto_slide{{ $i }}" id="foto_slide{{ $i }}" class="form-control border-success" accept="image/*">
                            @error('foto_slide'.$i)
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                            @if($data->isNotEmpty() && $data->first()->{'foto_slide'.$i})
                                <div class="mt-2">
                                    <img src="{{ asset('uploads/pengumuman/'.$data->first()->{'foto_slide'.$i}) }}" alt="Foto Slide {{ $i }}" width="150" class="img-thumbnail">
                                    <p class="small text-muted mt-1">Foto saat ini</p>
                                </div>
                            @endif
                        </div>
                        @endfor

                        <!-- Tombol -->
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-success btn-icon">
                                <i class="fas fa-save me-2"></i>{{ $data->isEmpty() ? 'Simpan' : 'Perbarui' }}
                            </button>
                            @if($data->isNotEmpty())
                                <button type="button" class="btn btn-danger btn-icon" onclick="confirmDelete({{ $data->first()->id }})">
                                    <i class="fas fa-trash-alt me-2"></i>Hapus
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
                form.action = `/admin/pengumuman/${id}`;
                form.submit();
            }
        });
    }

    document.querySelectorAll('.form-control').forEach((el, idx) => {
        el.style.animationDelay = `${idx * 0.1}s`;
    });
</script>

<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .card-header {
        border-radius: 12px 12px 0 0 !important;
        background-color: white;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    .form-control {
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 0 0.25rem rgba(76,175,80,0.25);
    }
    textarea.form-control { min-height: 100px; }
    .btn-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .btn-success { background-color: #2e7d32; border-color: #2e7d32; }
    .btn-success:hover { background-color: #1b5e20; border-color: #1b5e20; }
    .animate-fade-in {
        animation: fadeIn 0.5s ease forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
