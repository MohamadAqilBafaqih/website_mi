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
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Testimoni</li>
            </ol>
        </nav>
    </div>

    <!-- Alert -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row animate-fade-in">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-success"><i class="fas fa-list me-2"></i> Daftar Testimoni</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-success">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Sebagai</th>
                                    <th>Testimoni</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama ?? '-' }}</td>
                                    <td>{{ ucfirst($item->sebagai) ?? '-' }}</td>
                                    <td>
                                        <div style="max-height: 80px; overflow-y:auto; line-height:1.4;">
                                            {{ $item->testimoni ?? '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->foto && file_exists(public_path('storage/testimoni/' . $item->foto)))
                                            <img src="{{ asset('storage/testimoni/' . $item->foto) }}" 
                                                 alt="Foto {{ $item->nama }}" 
                                                 style="max-width:80px; max-height:80px; object-fit:cover; border-radius:6px;">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $item->status=='diterima'?'success':($item->status=='ditolak'?'danger':'warning') }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1 flex-wrap">
                                            @if($item->status != 'diterima')
                                            <form action="{{ route('admin.testimoni.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="diterima">
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Terima testimoni ini?')">
                                                    <i class="fas fa-check-circle me-1"></i> Terima
                                                </button>
                                            </form>
                                            @endif

                                            @if($item->status != 'ditolak')
                                            <form action="{{ route('admin.testimoni.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="ditolak">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tolak testimoni ini?')">
                                                    <i class="fas fa-times-circle me-1"></i> Tolak
                                                </button>
                                            </form>
                                            @endif

                                            <form action="{{ route('admin.testimoni.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus testimoni ini?')">
                                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada testimoni.</td>
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
@endsection
