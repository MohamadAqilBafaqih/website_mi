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
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
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
                    <h5 class="card-title text-success"><i class="fas fa-list me-2"></i> Daftar Kritik & Saran</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-success">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th>Kritik</th>
                                    <th>Saran</th>
                                    <th>Status</th>
                                    <th width="18%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama ?? '-' }}</td>
                                    <td>{{ $item->email ?? '-' }}</td>
                                    <td>{{ $item->no_hp ?? '-' }}</td>
                                    <td>
                                        <div style="max-height: 50px; overflow-y:auto; line-height:1.4;">
                                            {{ $item->kritik ?? '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="max-height: 50px; overflow-y:auto; line-height:1.4;">
                                            {{ $item->saran ?? '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $item->status=='Ditindaklanjuti'?'success':($item->status=='Dibaca'?'warning':'danger') }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1 flex-wrap">
                                            @if($item->status != 'Dibaca')
                                            <form action="{{ route('admin.kritiksaran.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="Dibaca">
                                                <button type="submit" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-envelope-open me-1"></i> Dibaca
                                                </button>
                                            </form>
                                            @endif

                                            @if($item->status != 'Ditindaklanjuti')
                                            <form action="{{ route('admin.kritiksaran.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="Ditindaklanjuti">
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fas fa-check-circle me-1"></i> Ditindaklanjuti
                                                </button>
                                            </form>
                                            @endif

                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal"
                                                data-nama="{{ $item->nama ?? '-' }}"
                                                data-email="{{ $item->email ?? '-' }}"
                                                data-nohp="{{ $item->no_hp ?? '-' }}"
                                                data-kritik="{{ $item->kritik ?? '-' }}"
                                                data-saran="{{ $item->saran ?? '-' }}"
                                                data-tanggal="{{ $item->created_at->format('d M Y H:i') }}">
                                                <i class="fas fa-eye me-1"></i> Detail
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data kritik & saran.</td>
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
                <h5 class="modal-title" id="detailModalLabel"><i class="fas fa-info-circle me-2"></i>Detail Kritik & Saran</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama:</strong> <span id="detail-nama">-</span></p>
                <p><strong>Email:</strong> <span id="detail-email">-</span></p>
                <p><strong>No. HP:</strong> <span id="detail-nohp">-</span></p>
                <p><strong>Kritik:</strong> <span id="detail-kritik">-</span></p>
                <p><strong>Saran:</strong> <span id="detail-saran">-</span></p>
                <p><strong>Tanggal Kirim:</strong> <span id="detail-tanggal">-</span></p>
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
    document.querySelectorAll('[data-bs-target="#detailModal"]').forEach(button => {
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
@endsection
