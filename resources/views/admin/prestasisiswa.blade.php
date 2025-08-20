@extends('Admin.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-trophy"></i> Kelola Prestasi Siswa
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Prestasi Siswa</li>
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
                        <i class="fas {{ empty($prestasi) ? 'fa-plus-circle' : 'fa-edit' }} me-2"></i>
                        {{ empty($prestasi) ? 'Tambah' : 'Edit' }} Prestasi Siswa
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ empty($prestasi) ? route('admin.prestasisiswa.store') : route('admin.prestasisiswa.update', $prestasi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($prestasi))
                            @method('PUT')
                        @endif
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="nama_siswa" class="form-label fw-bold text-success">
                                        <i class="fas fa-user me-1"></i> Nama Siswa
                                    </label>
                                    <input type="text" name="nama_siswa" id="nama_siswa" class="form-control border-success" 
                                        placeholder="Masukkan nama siswa" value="{{ empty($prestasi) ? old('nama_siswa') : $prestasi->nama_siswa }}" required>
                                    @error('nama_siswa')
                                        <div class="text-danger small mt-2">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="nama_prestasi" class="form-label fw-bold text-success">
                                        <i class="fas fa-trophy me-1"></i> Nama Prestasi
                                    </label>
                                    <input type="text" name="nama_prestasi" id="nama_prestasi" class="form-control border-success" 
                                        placeholder="Masukkan nama prestasi" value="{{ empty($prestasi) ? old('nama_prestasi') : $prestasi->nama_prestasi }}" required>
                                    @error('nama_prestasi')
                                        <div class="text-danger small mt-2">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="tingkat" class="form-label fw-bold text-success">
                                        <i class="fas fa-layer-group me-1"></i> Tingkat Prestasi
                                    </label>
                                    <select name="tingkat" id="tingkat" class="form-control border-success">
                                        <option value="">Pilih Tingkat</option>
                                        <option value="Sekolah" {{ (empty($prestasi) ? old('tingkat') : $prestasi->tingkat) == 'Sekolah' ? 'selected' : '' }}>Sekolah</option>
                                        <option value="Kecamatan" {{ (empty($prestasi) ? old('tingkat') : $prestasi->tingkat) == 'Kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                                        <option value="Kabupaten/Kota" {{ (empty($prestasi) ? old('tingkat') : $prestasi->tingkat) == 'Kabupaten/Kota' ? 'selected' : '' }}>Kabupaten/Kota</option>
                                        <option value="Provinsi" {{ (empty($prestasi) ? old('tingkat') : $prestasi->tingkat) == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                                        <option value="Nasional" {{ (empty($prestasi) ? old('tingkat') : $prestasi->tingkat) == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                        <option value="Internasional" {{ (empty($prestasi) ? old('tingkat') : $prestasi->tingkat) == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                    </select>
                                    @error('tingkat')
                                        <div class="text-danger small mt-2">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="jenis_prestasi" class="form-label fw-bold text-success">
                                        <i class="fas fa-medal me-1"></i> Jenis Prestasi
                                    </label>
                                    <select name="jenis_prestasi" id="jenis_prestasi" class="form-control border-success">
                                        <option value="">Pilih Jenis</option>
                                        <option value="Akademik" {{ (empty($prestasi) ? old('jenis_prestasi') : $prestasi->jenis_prestasi) == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                                        <option value="Non-Akademik" {{ (empty($prestasi) ? old('jenis_prestasi') : $prestasi->jenis_prestasi) == 'Non-Akademik' ? 'selected' : '' }}>Non-Akademik</option>
                                    </select>
                                    @error('jenis_prestasi')
                                        <div class="text-danger small mt-2">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="tahun" class="form-label fw-bold text-success">
                                        <i class="fas fa-calendar me-1"></i> Tahun
                                    </label>
                                    <input type="number" name="tahun" id="tahun" class="form-control border-success" 
                                        placeholder="Tahun prestasi" min="2000" max="{{ date('Y') + 5 }}" 
                                        value="{{ empty($prestasi) ? old('tahun') : $prestasi->tahun }}">
                                    @error('tahun')
                                        <div class="text-danger small mt-2">
                                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="penyelenggara" class="form-label fw-bold text-success">
                                <i class="fas fa-building me-1"></i> Penyelenggara
                            </label>
                            <input type="text" name="penyelenggara" id="penyelenggara" class="form-control border-success" 
                                placeholder="Nama penyelenggara kegiatan" value="{{ empty($prestasi) ? old('penyelenggara') : $prestasi->penyelenggara }}">
                            @error('penyelenggara')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="foto" class="form-label fw-bold text-success">
                                <i class="fas fa-image me-1"></i> Foto Prestasi
                            </label>
                            <input type="file" name="foto" id="foto" class="form-control border-success" 
                                accept="image/*">
                            <div class="form-text">Format: JPG, PNG (maks. 10MB)</div>
                            @error('foto')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                            @if(!empty($prestasi) && $prestasi->foto)
                                <div class="mt-2">
                                    <img src="{{ asset('uploads/prestasisiswa/'.$prestasi->foto) }}" alt="Foto Prestasi" width="150" class="img-thumbnail">
                                </div>
                            @endif
                        </div>
                        
                        <div class="mb-4">
                            <label for="keterangan" class="form-label fw-bold text-success">
                                <i class="fas fa-align-left me-1"></i> Keterangan
                            </label>
                            <textarea name="keterangan" id="keterangan" rows="4" class="form-control border-success" 
                                placeholder="Tambahkan keterangan tentang prestasi">{{ empty($prestasi) ? old('keterangan') : $prestasi->keterangan }}</textarea>
                            @error('keterangan')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-success btn-icon">
                                <i class="fas fa-save me-2"></i>{{ empty($prestasi) ? 'Simpan' : 'Perbarui' }}
                            </button>
                            
                            @if(!empty($prestasi))
                                <button type="button" class="btn btn-danger btn-icon" 
                                    onclick="confirmDelete({{ $prestasi->id }})">
                                    <i class="fas fa-trash-alt me-2"></i>Hapus
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Daftar Prestasi Siswa -->
    <div class="row mt-4 animate-fade-in">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-success">
                        <i class="fas fa-list me-2"></i> Daftar Prestasi Siswa
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-success">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Nama Siswa</th>
                                    <th>Prestasi</th>
                                    <th>Tingkat</th>
                                    <th>Jenis</th>
                                    <th>Tahun</th>
                                    <th>Foto</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_siswa ?? '-' }}</td>
                                    <td>{{ $item->nama_prestasi ?? '-' }}</td>
                                    <td>
                                        @if($item->tingkat)
                                            <span class="badge 
                                                @if($item->tingkat == 'Sekolah') bg-secondary
                                                @elseif($item->tingkat == 'Kecamatan') bg-info
                                                @elseif($item->tingkat == 'Kabupaten/Kota') bg-primary
                                                @elseif($item->tingkat == 'Provinsi') bg-warning
                                                @elseif($item->tingkat == 'Nasional') bg-success
                                                @elseif($item->tingkat == 'Internasional') bg-danger
                                                @else bg-secondary @endif">
                                                {{ $item->tingkat }}
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->jenis_prestasi)
                                            <span class="badge 
                                                @if($item->jenis_prestasi == 'Akademik') bg-success
                                                @elseif($item->jenis_prestasi == 'Non-Akademik') bg-info
                                                @elseif($item->jenis_prestasi == 'Olahraga') bg-warning
                                                @elseif($item->jenis_prestasi == 'Seni') bg-purple
                                                @else bg-secondary @endif">
                                                {{ $item->jenis_prestasi }}
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $item->tahun ?? '-' }}</td>
                                    <td>
                                        @if($item->foto)
                                            <img src="{{ asset('uploads/prestasisiswa/'.$item->foto) }}" alt="Foto Prestasi" width="80" class="img-thumbnail">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.prestasisiswa.edit', $item->id) }}" class="btn btn-sm btn-info mb-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.prestasisiswa.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus prestasi ini?')">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data prestasi siswa</td>
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
                form.action = `/admin/prestasisiswa/${id}`;
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
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }
    
    .bg-purple {
        background-color: #6f42c1;
        color: white;
    }
</style>
@endsection