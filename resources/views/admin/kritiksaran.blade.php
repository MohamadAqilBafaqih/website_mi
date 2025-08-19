@extends('Admin.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-comment-dots"></i> Kelola Kritik & Saran
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kritik & Saran</li>
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
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-success">
                        <i class="fas fa-list me-2"></i> Daftar Kritik & Saran
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-success">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="15%">Nama</th>
                                    <th width="15%">Kontak</th>
                                    <th>Kritik</th>
                                    <th>Saran</th>
                                    <th width="15%">Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama ?? '-' }}</td>
                                    <td>
                                        @if($item->email)
                                            <i class="fas fa-envelope me-1"></i> {{ $item->email }}<br>
                                        @endif
                                        @if($item->no_hp)
                                            <i class="fas fa-phone me-1"></i> {{ $item->no_hp }}
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($item->kritik, 50) ?? '-' }}</td>
                                    <td>{{ Str::limit($item->saran, 50) ?? '-' }}</td>
                                    <td>
                                        <form action="{{ route('admin.kritiksaran.update', $item->id) }}" method="POST" class="status-form">
                                            @csrf
                                            <select name="status" class="form-select form-select-sm status-select" 
                                                data-id="{{ $item->id }}"
                                                style="background-color: {{ 
                                                    $item->status == 'Belum Dibaca' ? '#f8d7da' : 
                                                    ($item->status == 'Dibaca' ? '#fff3cd' : '#d1e7dd') 
                                                }}">
                                                <option value="Belum Dibaca" {{ $item->status == 'Belum Dibaca' ? 'selected' : '' }}>Belum Dibaca</option>
                                                <option value="Dibaca" {{ $item->status == 'Dibaca' ? 'selected' : '' }}>Dibaca</option>
                                                <option value="Ditindaklanjuti" {{ $item->status == 'Ditindaklanjuti' ? 'selected' : '' }}>Ditindaklanjuti</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info view-btn" data-bs-toggle="modal" data-bs-target="#detailModal" 
                                            data-nama="{{ $item->nama ?? '-' }}"
                                            data-email="{{ $item->email ?? '-' }}"
                                            data-nohp="{{ $item->no_hp ?? '-' }}"
                                            data-kritik="{{ $item->kritik ?? '-' }}"
                                            data-saran="{{ $item->saran ?? '-' }}"
                                            data-tanggal="{{ $item->created_at->format('d M Y H:i') }}">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>
                                        <form action="{{ route('admin.kritiksaran.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus kritik & saran ini?')">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data kritik & saran</td>
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

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="detailModalLabel">Detail Kritik & Saran</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <p class="mb-1"><strong>Nama Pengirim:</strong></p>
                        <p id="detail-nama">-</p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1"><strong>Email:</strong></p>
                        <p id="detail-email">-</p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1"><strong>No. HP:</strong></p>
                        <p id="detail-nohp">-</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Kritik:</strong></p>
                        <p id="detail-kritik" class="text-justify">-</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Saran:</strong></p>
                        <p id="detail-saran" class="text-justify">-</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="mb-1"><strong>Tanggal Kirim:</strong></p>
                        <p id="detail-tanggal">-</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Status change handler
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function() {
            const form = this.closest('.status-form');
            form.submit();
        });
    });

    // Detail modal handler
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('detail-nama').textContent = this.getAttribute('data-nama');
            document.getElementById('detail-email').textContent = this.getAttribute('data-email');
            document.getElementById('detail-nohp').textContent = this.getAttribute('data-nohp');
            document.getElementById('detail-kritik').textContent = this.getAttribute('data-kritik');
            document.getElementById('detail-saran').textContent = this.getAttribute('data-saran');
            document.getElementById('detail-tanggal').textContent = this.getAttribute('data-tanggal');
        });
    });
</script>

<style>
    /* Custom styles for this page */
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
    
    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
    }
    
    .table-success {
        background-color: #d1e7dd;
    }
    
    .status-select {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .status-select:hover {
        box-shadow: 0 0 0 0.25rem rgba(46, 125, 50, 0.25);
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
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
    
    .text-justify {
        text-align: justify;
    }
</style>
@endsection