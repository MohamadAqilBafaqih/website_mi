@extends('pengguna.beranda-content')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Daftar Guru</h2>

    <div class="row">
        @foreach($data as $guru)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($guru->foto)
                        <img src="{{ asset('uploads/guru/' . $guru->foto) }}" 
                             class="card-img-top" 
                             alt="{{ $guru->nama_lengkap }}">
                    @else
                        <img src="{{ asset('gambar/no-image.png') }}" 
                             class="card-img-top" 
                             alt="No Image">
                    @endif

                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $guru->nama_lengkap }}</h5>
                        <p class="card-text">{{ $guru->jabatan ?? '-' }}</p>
                        <p class="card-text"><strong>Mapel:</strong> {{ $guru->mata_pelajaran ?? '-' }}</p>
                        <p class="card-text"><strong>Pendidikan:</strong> {{ $guru->pendidikan_terakhir ?? '-' }}</p>
                        <p class="card-text"><strong>Email:</strong> {{ $guru->email ?? '-' }}</p>
                        <p class="card-text"><strong>No HP:</strong> {{ $guru->no_hp ?? '-' }}</p>
                        <p class="card-text"><strong>Status:</strong> {{ $guru->status ?? '-' }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
