@extends('Admin.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="page-header mb-4" style="background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);
                                color: white;
                                padding: 20px;
                                border-radius: 10px;
                                margin-bottom: 20px;
                                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title" style="color: #ffffff; font-weight: 700;">
                        <i class="fas fa-star me-2"></i> Kelola Testimoni
                    </h1>
                    <p class="mb-0">Atur dan kelola semua testimoni dari siswa dan orang tua</p>
                </div>
            </div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: transparent; padding: 0; margin-bottom: 0;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" style="color: #e0e0e0;">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page" style="color: #ffffff;">
                        Testimoni
                    </li>
                </ol>
            </nav>
        </div>


        <!-- Alert -->
        @if (session('success'))
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
                                                                        <img src="{{ $item->foto && file_exists(public_path('uploads/testimoni/' . basename($item->foto)))
                                        ? asset('uploads/testimoni/' . basename($item->foto))
                                        : asset('uploads/testimoni/default.jpg') }}" alt="Foto {{ $item->nama }}"
                                                                            style="max-width:80px; max-height:80px; object-fit:cover; border-radius:6px;">
                                                                    </td>


                                                                    <td>
                                                                        <span
                                                                            class="badge bg-{{ $item->status == 'diterima' ? 'success' : ($item->status == 'ditolak' ? 'danger' : 'warning') }}">
                                                                            {{ ucfirst($item->status) }}
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <div class="d-flex flex-wrap justify-content-center gap-2">

                                                                            {{-- Tombol Terima --}}
                                                                            @if ($item->status != 'diterima')
                                                                                <form action="{{ route('admin.testimoni.update', $item->id) }}"
                                                                                    method="POST" class="m-0">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <input type="hidden" name="status" value="diterima">
                                                                                    <button type="submit"
                                                                                        class="btn btn-outline-success btn-sm rounded-pill px-3 py-1 shadow-sm"
                                                                                        onclick="return confirm('Terima testimoni ini?')"
                                                                                        title="Terima testimoni">
                                                                                        <i class="fas fa-check-circle me-1"></i> Terima
                                                                                    </button>
                                                                                </form>
                                                                            @endif

                                                                            {{-- Tombol Tolak --}}
                                                                            @if ($item->status != 'ditolak')
                                                                                <form action="{{ route('admin.testimoni.update', $item->id) }}"
                                                                                    method="POST" class="m-0">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <input type="hidden" name="status" value="ditolak">
                                                                                    <button type="submit"
                                                                                        class="btn btn-outline-warning btn-sm rounded-pill px-3 py-1 shadow-sm"
                                                                                        onclick="return confirm('Tolak testimoni ini?')"
                                                                                        title="Tolak testimoni">
                                                                                        <i class="fas fa-times-circle me-1"></i> Tolak
                                                                                    </button>
                                                                                </form>
                                                                            @endif

                                                                            {{-- Tombol Hapus --}}
                                                                            <form action="{{ route('admin.testimoni.destroy', $item->id) }}"
                                                                                method="POST" class="m-0">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1 shadow-sm"
                                                                                    onclick="return confirm('Hapus testimoni ini?')"
                                                                                    title="Hapus testimoni">
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