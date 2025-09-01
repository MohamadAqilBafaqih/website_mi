@extends('pengguna.beranda-content')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Daftar Berita Terbaru</h2>

    <div class="row g-4">
        @foreach($data as $item)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    @if($item->foto)
                        <img src="{{ asset('uploads/berita/'.$item->foto) }}" 
                             class="card-img-top" 
                             alt="{{ $item->judul }}" 
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/no-image.jpg') }}" 
                             class="card-img-top" 
                             alt="Tidak ada gambar" 
                             style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $item->judul ?? 'Tanpa Judul' }}</h5>
                        <p class="card-text text-truncate" style="max-height: 60px; overflow:hidden;">
                            {{ Str::limit(strip_tags($item->isi), 100, '...') }}
                        </p>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-person-circle"></i> {{ $item->penulis ?? 'Admin' }} | 
                            <i class="bi bi-calendar-event"></i> {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : $item->created_at->format('d M Y') }}
                        </p>
                        <a href="{{ route('pengguna.berita.show', $item->id) }}" class="btn btn-success mt-auto">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
