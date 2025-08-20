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
            <div class="card custom-card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-list me-2"></i> Daftar Kritik & Saran
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover custom-table">
                            <thead class="table-success">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="15%">Nama</th>
                                    <th width="15%">Email</th>
                                    <th width="12%">No. HP</th>
                                    <th width="18%">Kritik</th>
                                    <th width="18%">Saran</th>
                                    <th width="10%">Status</th>
                                    <th width="17%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $item)
                                <tr class="custom-table-row">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-light-success rounded-circle me-2 d-flex align-items-center justify-content-center">
                                                <i class="fas fa-user fs-6"></i>
                                            </div>
                                            <div>{{ $item->nama ?? '-' }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->email)
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-envelope text-primary me-2"></i>
                                            <span class="text-truncate">{{ $item->email }}</span>
                                        </div>
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->no_hp)
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-phone text-info me-2"></i>
                                            <span>{{ $item->no_hp }}</span>
                                        </div>
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-truncate-2-lines" title="{{ $item->kritik ?? '' }}">
                                            {{ $item->kritik ?? '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-truncate-2-lines" title="{{ $item->saran ?? '' }}">
                                            {{ $item->saran ?? '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge status-badge 
                                            @if($item->status == 'Belum Dibaca') bg-danger
                                            @elseif($item->status == 'Dibaca') bg-warning text-dark
                                            @elseif($item->status == 'Ditindaklanjuti') bg-success
                                            @endif">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            @if($item->status != 'Dibaca')
                                            <form action="{{ route('admin.kritiksaran.update', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT') <!-- Tambahkan method PUT di sini -->
                                                <input type="hidden" name="status" value="Dibaca">
                                                <button type="submit" class="btn btn-action btn-read" title="Tandai sebagai Dibaca">
                                                    <i class="fas fa-envelope-open"></i>
                                                </button>
                                            </form>
                                            @endif
                                            
                                            @if($item->status != 'Ditindaklanjuti')
                                            <form action="{{ route('admin.kritiksaran.update', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT') <!-- Tambahkan method PUT di sini -->
                                                <input type="hidden" name="status" value="Ditindaklanjuti">
                                                <button type="submit" class="btn btn-action btn-process" title="Tandai sebagai Ditindaklanjuti">
                                                    <i class="fas fa-check-circle"></i>
                                                </button>
                                            </form>
                                            @endif
                                            
                                            <button class="btn btn-action btn-detail view-btn" data-bs-toggle="modal" data-bs-target="#detailModal" 
                                                data-nama="{{ $item->nama ?? '-' }}"
                                                data-email="{{ $item->email ?? '-' }}"
                                                data-nohp="{{ $item->no_hp ?? '-' }}"
                                                data-kritik="{{ $item->kritik ?? '-' }}"
                                                data-saran="{{ $item->saran ?? '-' }}"
                                                data-tanggal="{{ $item->created_at->format('d M Y H:i') }}"
                                                title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="empty-state">
                                            <i class="fas fa-comment-slash fs-1 text-muted"></i>
                                            <p class="mt-3 mb-0 text-muted">Tidak ada data kritik & saran</p>
                                        </div>
                                    </td>
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
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="fas fa-info-circle me-2"></i>Detail Kritik & Saran
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <p class="mb-1"><strong>Nama Pengirim:</strong></p>
                        <p id="detail-nama" class="p-2 bg-light rounded">-</p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1"><strong>Email:</strong></p>
                        <p id="detail-email" class="p-2 bg-light rounded">-</p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1"><strong>No. HP:</strong></p>
                        <p id="detail-nohp" class="p-2 bg-light rounded">-</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Kritik:</strong></p>
                        <p id="detail-kritik" class="p-2 bg-light rounded text-justify">-</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Saran:</strong></p>
                        <p id="detail-saran" class="p-2 bg-light rounded text-justify">-</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="mb-1"><strong>Tanggal Kirim:</strong></p>
                        <p id="detail-tanggal" class="p-2 bg-light rounded">-</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
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
    .custom-card {
        border-radius: 12px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }
    
    .custom-card .card-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .custom-table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0 8px;
    }
    
    .custom-table thead th {
        border: none;
        font-weight: 600;
        padding: 12px 15px;
        background-color: #d1e7dd !important;
        color: #0f5132;
        vertical-align: middle;
    }
    
    .custom-table tbody tr.custom-table-row {
        background-color: white;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border-radius: 10px;
    }
    
    .custom-table tbody tr.custom-table-row:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }
    
    .custom-table tbody td {
        padding: 12px 15px;
        vertical-align: middle;
        border-top: none;
    }
    
    .custom-table tbody tr:first-child td:first-child {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }
    
    .custom-table tbody tr:first-child td:last-child {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }
    
    .avatar-sm {
        width: 32px;
        height: 32px;
        display: flex;
    }
    
    .text-truncate-2-lines {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.4;
    }
    
    .status-badge {
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        transition: all 0.2s ease;
    }
    
    .btn-read {
        background-color: #ffc107;
        color: white;
        border: none;
    }
    
    .btn-read:hover {
        background-color: #e0a800;
        transform: scale(1.1);
    }
    
    .btn-process {
        background-color: #198754;
        color: white;
        border: none;
    }
    
    .btn-process:hover {
        background-color: #157347;
        transform: scale(1.1);
    }
    
    .btn-detail {
        background-color: #0dcaf0;
        color: white;
        border: none;
    }
    
    .btn-detail:hover {
        background-color: #0baccc;
        transform: scale(1.1);
    }
    
    .empty-state {
        padding: 2rem 0;
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
    
    /* Responsive adjustments */
    @media (max-width: 992px) {
        .custom-table thead {
            display: none;
        }
        
        .custom-table tbody tr {
            display: block;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border-radius: 10px;
        }
        
        .custom-table tbody td {
            display: block;
            text-align: right;
            padding: 10px 15px;
            position: relative;
            border-bottom: 1px solid #f1f1f1;
        }
        
        .custom-table tbody td:last-child {
            border-bottom: none;
        }
        
        .custom-table tbody td::before {
            content: attr(data-label);
            position: absolute;
            left: 15px;
            font-weight: 600;
            text-align: left;
        }
        
        .custom-table tbody td:first-child {
            background-color: #f8f9fa;
            font-weight: 600;
            text-align: center !important;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        
        .custom-table tbody td:last-child {
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        
        /* Add data labels for responsive view */
        .custom-table tbody td:nth-child(1)::before { content: 'No'; }
        .custom-table tbody td:nth-child(2)::before { content: 'Nama'; }
        .custom-table tbody td:nth-child(3)::before { content: 'Email'; }
        .custom-table tbody td:nth-child(4)::before { content: 'No. HP'; }
        .custom-table tbody td:nth-child(5)::before { content: 'Kritik'; }
        .custom-table tbody td:nth-child(6)::before { content: 'Saran'; }
        .custom-table tbody td:nth-child(7)::before { content: 'Status'; }
        .custom-table tbody td:nth-child(8)::before { content: 'Aksi'; }
        
        .btn-action {
            width: 32px;
            height: 32px;
        }
    }
</style>

<script>
    // Add data labels for responsive table
    document.addEventListener('DOMContentLoaded', function() {
        const cells = document.querySelectorAll('.custom-table td');
        cells.forEach(cell => {
            const headerText = document.querySelectorAll('.custom-table th')[cell.cellIndex].textContent;
            cell.setAttribute('data-label', headerText);
        });
    });
</script>
@endsection