@extends('pengguna.beranda-content')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="card shadow-sm">
            <div class="row g-0">
                <div class="col-md-5">
                    @if($prestasi->foto)
                        <img src="{{ asset('uploads/prestasisiswa/' . $prestasi->foto) }}" 
                             class="img-fluid rounded-start" 
                             alt="{{ $prestasi->nama_prestasi }}"
                             style="height: 100%; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" 
                             class="img-fluid rounded-start" 
                             alt="No Image">
                    @endif
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h3 class="card-title mb-3">{{ $prestasi->nama_prestasi }}</h3>
                        <ul class="list-unstyled mb-3">
                            <li><strong>Nama Siswa:</strong> {{ $prestasi->nama_siswa }}</li>
                            <li><strong>Kelas:</strong> {{ $prestasi->kelas }}</li>
                            <li><strong>Tingkat:</strong> {{ $prestasi->tingkat ?? '-' }}</li>
                            <li><strong>Jenis Prestasi:</strong> {{ $prestasi->jenis_prestasi ?? '-' }}</li>
                            <li><strong>Penyelenggara:</strong> {{ $prestasi->penyelenggara ?? '-' }}</li>
                            <li>
                                <strong>Tanggal:</strong> 
                                {{ $prestasi->tanggal ? \Carbon\Carbon::parse($prestasi->tanggal)->format('d M Y') : '-' }}
                            </li>
                        </ul>
                        <p class="card-text">
                            {!! nl2br(e($prestasi->keterangan)) !!}
                        </p>
                        <a href="{{ route('pengguna.prestasi.index') }}" class="btn btn-outline-success mt-3">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Prestasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
