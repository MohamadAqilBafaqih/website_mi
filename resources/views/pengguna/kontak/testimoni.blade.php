@extends('pengguna.beranda-content')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Testimoni</h2>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form tambah testimoni --}}
    <div class="card shadow mb-5">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Tambah Testimoni</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pengguna.kontak.testimoni.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" 
                           name="nama" 
                           class="form-control @error('nama') is-invalid @enderror" 
                           value="{{ old('nama') }}" required>
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="sebagai" class="form-label">Sebagai</label>
                    <select name="sebagai" class="form-select @error('sebagai') is-invalid @enderror" required>
                        <option value="">-- Pilih --</option>
                        <option value="alumni" {{ old('sebagai') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                        <option value="wali murid" {{ old('sebagai') == 'wali murid' ? 'selected' : '' }}>Wali Murid</option>
                        <option value="komite sekolah" {{ old('sebagai') == 'komite sekolah' ? 'selected' : '' }}>Komite Sekolah</option>
                    </select>
                    @error('sebagai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="testimoni" class="form-label">Testimoni</label>
                    <textarea name="testimoni" rows="4" class="form-control @error('testimoni') is-invalid @enderror" required>{{ old('testimoni') }}</textarea>
                    @error('testimoni') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto (Opsional)</label>
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                    @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-success">Kirim Testimoni</button>
            </form>
        </div>
    </div>

    {{-- Daftar testimoni yang sudah diterima --}}
    <div class="row">
        @forelse($data as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($item->foto)
                        <img src="{{ asset('storage/'.$item->foto) }}" class="card-img-top" alt="Foto {{ $item->nama }}">
                    @else
                        <img src="{{ asset('images/default-user.png') }}" class="card-img-top" alt="Default Foto">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nama }}</h5>
                        <h6 class="card-subtitle text-muted">{{ ucfirst($item->sebagai) }}</h6>
                        <p class="mt-2">{{ $item->testimoni }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Belum ada testimoni yang ditampilkan.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $data->links() }}
    </div>
</div>
@endsection
