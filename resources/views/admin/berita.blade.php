@extends('Admin.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-newspaper"></i> Kelola Berita
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Berita</li>
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
                        <i class="fas {{ empty($berita) ? 'fa-plus-circle' : 'fa-edit' }} me-2"></i>
                        {{ empty($berita) ? 'Tambah' : 'Edit' }} Berita
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ empty($berita) ? route('admin.berita.store') : route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($berita))
                            @method('PUT')
                        @endif
                        
                        <div class="mb-4">
                            <label for="judul" class="form-label fw-bold text-success">
                                <i class="fas fa-heading me-1"></i> Judul Berita
                            </label>
                            <input type="text" name="judul" id="judul" class="form-control border-success" 
                                placeholder="Masukkan judul berita" value="{{ empty($berita) ? old('judul') : $berita->judul }}" required>
                            @error('judul')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="isi" class="form-label fw-bold text-success">
                                <i class="fas fa-align-left me-1"></i> Isi Berita
                            </label>
                            <textarea name="isi" id="isi" rows="6" class="form-control border-success" 
                                placeholder="Masukkan isi berita" required>{{ empty($berita) ? old('isi') : $berita->isi }}</textarea>
                            @error('isi')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="foto" class="form-label fw-bold text-success">
                                <i class="fas fa-image me-1"></i> Foto Berita
                            </label>
                            <input type="file" name="foto" id="foto" class="form-control border-success" 
                                accept="image/*">
                            @error('foto')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                            @if(!empty($berita) && $berita->foto)
                                <div class="mt-2">
                                    <img src="{{ asset('uploads/berita/'.$berita->foto) }}" alt="Foto Berita" width="150" class="img-thumbnail">
                                </div>
                            @endif
                        </div>
                        
                        <div class="mb-4">
                            <label for="penulis" class="form-label fw-bold text-success">
                                <i class="fas fa-user me-1"></i> Penulis
                            </label>
                            <input type="text" name="penulis" id="penulis" class="form-control border-success" 
                                placeholder="Masukkan nama penulis" value="{{ empty($berita) ? old('penulis') : $berita->penulis }}" required>
                            @error('penulis')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="tanggal" class="form-label fw-bold text-success">
                                <i class="fas fa-calendar me-1"></i> Tanggal
                            </label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control border-success" 
                                value="{{ empty($berita) ? (old('tanggal') ? old('tanggal') : date('Y-m-d')) : $berita->tanggal->format('Y-m-d') }}" required>
                            @error('tanggal')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-success btn-icon">
                                <i class="fas fa-save me-2"></i>{{ empty($berita) ? 'Simpan' : 'Perbarui' }}
                            </button>
                            
                            @if(!empty($berita))
                                <button type="button" class="btn btn-danger btn-icon" 
                                    onclick="confirmDelete({{ $berita->id }})">
                                    <i class="fas fa-trash-alt me-2"></i>Hapus
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Daftar Berita -->
    <div class="row mt-4 animate-fade-in">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-success">
                        <i class="fas fa-list me-2"></i> Daftar Berita
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-success">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Judul</th>
                                    <th>Isi</th>
                                    <th>Foto</th>
                                    <th>Penulis</th>
                                    <th>Tanggal</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->judul ?? '-' }}</td>
                                    <td>{{ Str::limit($item->isi, 50) }}</td>
                                    <td>
                                        @if($item->foto)
                                            <img src="{{ asset('uploads/berita/'.$item->foto) }}" alt="Foto Berita" width="80">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $item->penulis ?? '-' }}</td>
                                    <td>{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-sm btn-info mb-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus berita ini?')">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data berita</td>
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
                form.action = `/admin/berita/${id}`;
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
</style>
@endsection