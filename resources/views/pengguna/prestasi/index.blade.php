@extends('pengguna.beranda-content')

@section('content')
<div class="container py-5">
    <h2 class="text-center fw-bold mb-4">Prestasi Siswa</h2>

    <div class="row g-4">
        @forelse($data as $prestasi)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    @if($prestasi->foto)
                        <img src="{{ asset('uploads/prestasisiswa/'.$prestasi->foto) }}" 
                             class="card-img-top" 
                             alt="{{ $prestasi->nama_prestasi }}" 
                             style="height: 220px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/no-image.jpg') }}" 
                             class="card-img-top" 
                             alt="Tidak ada gambar" 
                             style="height: 220px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $prestasi->nama_prestasi }}</h5>
                        <p class="text-muted small mb-2">
                            <i class="fas fa-calendar-alt"></i> 
                            {{ $prestasi->tanggal ? \Carbon\Carbon::parse($prestasi->tanggal)->format('d M Y') : $prestasi->created_at->format('d M Y') }}
                        </p>
                        <p class="card-text text-truncate" style="max-height: 60px;">
                            {{ Str::limit(strip_tags($prestasi->keterangan), 100, '...') }}
                        </p>
                        <a href="{{ route('pengguna.prestasi.show', $prestasi->id) }}" class="btn btn-success mt-auto">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada prestasi yang ditambahkan.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
