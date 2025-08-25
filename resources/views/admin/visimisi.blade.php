@extends('Admin.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-bullseye"></i> Kelola Visi & Misi
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Informasi Madrasah</a></li>
                <li class="breadcrumb-item active" aria-current="page">Visi & Misi</li>
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
                        {{ $data->isEmpty() ? 'Tambah' : 'Perbarui' }} Visi & Misi
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ $data->isEmpty() ? route('admin.visimisi.store') : route('admin.visimisi.update', $data->first()->id) }}" method="POST">
                        @csrf
                        @if($data->isNotEmpty())
                            @method('PUT')
                        @endif
                        
                        <div class="mb-4">
                            <label for="visi" class="form-label fw-bold text-success">
                                <i class="fas fa-eye me-1"></i> Visi Madrasah
                            </label>
                            <textarea name="visi" id="visi" rows="4" class="form-control border-success" 
                                placeholder="Masukkan visi madrasah" required>{{ $data->isEmpty() ? old('visi') : $data->first()->visi }}</textarea>
                            @error('visi')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="misi" class="form-label fw-bold text-success">
                                <i class="fas fa-bullseye me-1"></i> Misi Madrasah
                            </label>
                            <textarea name="misi" id="misi" rows="6" class="form-control border-success" 
                                placeholder="Masukkan misi madrasah" required>{{ $data->isEmpty() ? old('misi') : $data->first()->misi }}</textarea>
                            @error('misi')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-success btn-icon">
                                <i class="fas fa-save me-2"></i>{{ $data->isEmpty() ? 'Simpan' : 'Perbarui' }}
                            </button>
                            
                            @if($data->isNotEmpty())
                                <button type="button" class="btn btn-danger btn-icon" 
                                    onclick="confirmDelete({{ $data->first()->id }})">
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
                form.action = `/admin/visimisi/${id}`;
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
</style>
@endsection

