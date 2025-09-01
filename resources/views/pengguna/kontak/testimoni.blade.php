@extends('pengguna.beranda-content') 
{{-- Sesuaikan dengan layout utama Anda --}}

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Tambah Testimoni</h2>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form tambah testimoni --}}
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Form Testimoni</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pengguna.testimoni.store') }}" method="POST" enctype="multipart/form-data">
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
</div>
@endsection
