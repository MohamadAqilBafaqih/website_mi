@extends('pengguna.beranda-content')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Prestasi Siswa MI Diponegoro 03 Karangklesem</h2>

    <div class="row">
        @forelse($data as $item)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    @if($item->foto)
                        <img src="{{ asset('uploads/prestasisiswa/'.$item->foto) }}" class="card-img-top" alt="Prestasi">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nama_siswa }}</h5>
                        <p class="mb-1"><strong>Prestasi:</strong> {{ $item->nama_prestasi }}</p>
                        <p class="mb-1"><strong>Tingkat:</strong> {{ $item->tingkat }}</p>
                        <p class="mb-1"><strong>Tahun:</strong> {{ $item->tahun }}</p>
                        <p class="text-muted">{{ $item->keterangan }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Belum ada data prestasi siswa.</p>
        @endforelse
    </div>
</div>
@endsection
