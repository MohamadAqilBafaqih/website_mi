@extends('pengguna.beranda-content')

@section('content')
<div class="container py-5">
    <h2 class="text-center fw-bold mb-4">Galeri Kegiatan</h2>

    <div class="row g-4">
        @forelse($galeri as $item)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    @if($item->foto)
                        <img src="{{ asset('uploads/galeri_kegiatan/'.$item->foto) }}" 
                             class="card-img-top" 
                             alt="{{ $item->judul_kegiatan }}" 
                             style="height: 220px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/no-image.jpg') }}" 
                             class="card-img-top" 
                             alt="Tidak ada gambar" 
                             style="height: 220px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $item->judul_kegiatan }}</h5>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-calendar-event"></i> 
                            {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : $item->created_at->format('d M Y') }}
                        </p>
                        <p class="card-text text-truncate" style="max-height: 60px;">
                            {{ Str::limit(strip_tags($item->deskripsi), 100, '...') }}
                        </p>
                        <a href="{{ route('pengguna.galeri.show', $item->id) }}" class="btn btn-success mt-auto">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada kegiatan yang ditambahkan.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $galeri->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
