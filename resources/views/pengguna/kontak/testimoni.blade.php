@extends('pengguna.beranda-content')

@section('content')
<div class="container py-4 mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <!-- Header Section -->
            <div class="text-center mb-4 animate-fade">
                <div class="title-container position-relative d-inline-block mb-3">
                    <h2 class="fw-bold text-navy mb-2 section-title" style="font-size: 2rem; position: relative; z-index: 2;">
                        Testimoni
                    </h2>
                </div>
                <div class="subtitle-wrapper mb-3">
                    <span class="subtitle-badge bg-navy text-white px-3 py-1 rounded-pill d-inline-block" style="font-size: 0.95rem; font-weight: 500;">
                        MI Diponegoro 03 Karangklesem
                    </span>
                </div>
            </div>

            <!-- Pesan sukses -->
            @if(session('success'))
                <div class="alert alert-success animate-fade">{{ session('success') }}</div>
            @endif

            <!-- Form tambah testimoni -->
            <div class="card mb-5 border-0 shadow-lg animate-fade" data-delay="100">
                <div class="card-header bg-navy text-white py-3 d-flex align-items-center">
                    <div class="icon-container bg-white text-navy rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                        <i class="fas fa-plus"></i>
                    </div>
                    <h5 class="mb-0 fw-semibold">Beri Testimoni</h5>
                </div>
                <div class="card-body p-4">
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
                        <button type="submit" class="btn btn-navy">Kirim Testimoni</button>
                    </form>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --navy-color: #1b5e20;
}
.bg-navy { background-color: var(--navy-color) !important; }
.text-navy { color: var(--navy-color) !important; }
.btn-navy { background-color: var(--navy-color); color: #fff; border: none; transition: 0.3s; }
.btn-navy:hover { background-color: #145214; color: #fff; }

.card { border-radius: 12px; overflow: hidden; transition: 0.3s; }
.card:hover { transform: translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.15) !important; }

.icon-container { transition: all 0.3s ease; }
.card:hover .icon-container { transform: rotate(10deg) scale(1.1); }

.animate-fade { opacity: 0; transform: translateY(20px); transition: all 0.6s ease; }
.animate-fade.visible { opacity: 1; transform: translateY(0); }
.empty-state-icon { transition: all 0.5s ease; }
.card:hover .empty-state-icon { transform: scale(1.1); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const animatedElements = document.querySelectorAll('.animate-fade');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const delay = entry.target.getAttribute('data-delay') || 0;
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, delay * 50);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    animatedElements.forEach(element => { observer.observe(element); });
});
</script>
@endsection
