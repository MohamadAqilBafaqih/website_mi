@extends('pengguna.beranda-content')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Sarana & Prasarana</h2>

    <div class="row">
        @foreach($data as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($item->foto)
                        <img src="{{ asset('uploads/sarana_prasarana/' . $item->foto) }}" class="card-img-top" alt="{{ $item->nama_fasilitas }}">
                    @else
                        <img src="{{ asset('gambar/no-image.png') }}" class="card-img-top" alt="No Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nama_fasilitas }}</h5>
                        <p class="card-text"><strong>Jenis:</strong> {{ $item->jenis_fasilitas ?? '-' }}</p>
                        <p class="card-text"><strong>Kondisi:</strong> {{ $item->kondisi ?? '-' }}</p>
                        <p class="card-text"><strong>Tahun:</strong> {{ $item->tahun_pengadaan ?? '-' }}</p>
                        <p class="card-text">{{ $item->deskripsi }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
