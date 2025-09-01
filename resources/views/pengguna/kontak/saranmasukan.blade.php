@extends('pengguna.beranda-content')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Saran & Masukan</h2>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Form Saran & Masukan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pengguna.saranmasukan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama (opsional)</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email (opsional)</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="form-label">No HP (opsional)</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
                </div>

                <div class="mb-3">
                    <label for="kritik" class="form-label">Kritik</label>
                    <textarea name="kritik" rows="3" class="form-control">{{ old('kritik') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="saran" class="form-label">Saran</label>
                    <textarea name="saran" rows="3" class="form-control">{{ old('saran') }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Kirim</button>
            </form>
        </div>
    </div>
</div>
@endsection
