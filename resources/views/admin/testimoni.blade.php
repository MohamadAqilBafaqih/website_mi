@extends('Admin.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-star"></i> Kelola Testimoni
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Testimoni</li>
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
            @forelse($data as $item)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title text-success">
                            <i class="fas fa-user-edit me-2"></i> Testimoni #{{ $loop->iteration }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Nama:</strong> {{ $item->nama ?? '-' }}</p>
                        <p><strong>Sebagai:</strong> {{ ucfirst($item->sebagai) ?? '-' }}</p>
                        <p><strong>Testimoni:</strong></p>
                        <div class="text-justify">{{ $item->testimoni ?? '-' }}</div>
                        
                        <p class="mt-3">
                            <strong>Foto:</strong>
                            @if ($item->foto)
                                <a href="{{ asset('uploads/testimoni/' . $item->foto) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i> Lihat Foto
                                </a>
                            @else
                                -
                            @endif
                        </p>

                        <p>
                            <strong>Status:</strong>
                            <span class="badge status-badge 
                                @if($item->status=='baru') bg-warning text-dark
                                @elseif($item->status=='diterima') bg-success
                                @elseif($item->status=='ditolak') bg-danger @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                        </p>

                        <div class="d-flex flex-wrap gap-2 mt-3">
                            @if($item->status != 'diterima')
                                <form action="{{ route('admin.testimoni.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="diterima">
                                    <button type="submit" class="btn btn-success btn-icon">
                                        <i class="fas fa-check-circle me-1"></i> Terima
                                    </button>
                                </form>
                            @endif

                            @if($item->status != 'ditolak')
                                <form action="{{ route('admin.testimoni.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" class="btn btn-danger btn-icon">
                                        <i class="fas fa-times-circle me-1"></i> Tolak
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('admin.testimoni.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-icon" onclick="return confirm('Hapus testimoni ini?')">
                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning text-center">
                    <i class="fas fa-comment-slash me-2"></i> Belum ada testimoni.
                </div>
            @endforelse
        </div>
    </div>
</div>

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

    .btn-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-success {
        background-color: #2e7d32;
        border-color: #2e7d32;
        color: white;
    }

    .btn-success:hover {
        background-color: #1b5e20;
        border-color: #1b5e20;
    }

    .btn-danger {
        background-color: #d32f2f;
        border-color: #d32f2f;
        color: white;
    }

    .btn-danger:hover {
        background-color: #b71c1c;
        border-color: #b71c1c;
    }

    .btn-outline-danger {
        border-color: #d32f2f;
        color: #d32f2f;
    }

    .btn-outline-danger:hover {
        background-color: #d32f2f;
        color: white;
    }

    .text-justify {
        text-align: justify;
    }

    .animate-fade-in {
        animation: fadeIn 0.5s ease forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.85rem;
    }
</style>
@endsection
