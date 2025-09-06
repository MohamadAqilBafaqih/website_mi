@extends('pengguna.beranda-content')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Card Status -->
            <div class="card shadow-lg rounded-4 border-0 animate-fade">
                <div class="card-body text-center p-5">
                    
                    <!-- Icon -->
                    <div class="mb-4">
                        <div class="status-icon bg-light-navy text-navy rounded-circle d-inline-flex align-items-center justify-content-center">
                            <i class="fas fa-comment-dots fa-2x"></i>
                        </div>
                    </div>

                    <!-- Judul -->
                    <h3 class="text-navy fw-bold mb-3">Terima Kasih atas Kritik & Saran Anda!</h3>
                    <p class="lead text-muted mb-4">
                        Masukan Anda sangat berharga bagi <strong>MI Diponegoro 03 Karangklesem</strong>.  
                        Kritik dan saran Anda telah berhasil dikirim dan akan kami tinjau untuk perbaikan ke depan.
                    </p>

                    <!-- Informasi Status -->
                    <div class="info-box bg-light-navy p-4 rounded-3 mb-4 text-start">
                        <h5 class="text-navy fw-semibold mb-3">
                            <i class="fas fa-info-circle me-2"></i> Informasi Kritik & Saran
                        </h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <i class="fas fa-check-circle text-navy me-3"></i>
                                    <div>
                                        <small class="fw-semibold">Status Pengiriman</small>
                                        <p class="mb-0">Berhasil dikirim</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <i class="fas fa-eye text-navy me-3"></i>
                                    <div>
                                        <small class="fw-semibold">Tinjauan</small>
                                        <p class="mb-0">Akan diperiksa oleh admin</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('pengguna.beranda-content') }}" class="btn btn-navy rounded-pill px-4">
                            <i class="fas fa-home me-2"></i> Kembali ke Beranda
                        </a>
                        <a href="{{ route('pengguna.kritik.create') }}" class="btn btn-outline-navy rounded-pill px-4">
                            <i class="fas fa-plus me-2"></i> Kirim Kritik/Saran Lagi
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
:root {
    --navy-color: #1b5e20;
    --light-navy: rgba(27, 94, 32, 0.1);
}
.bg-navy { background-color: var(--navy-color) !important; }
.text-navy { color: var(--navy-color) !important; }
.bg-light-navy { background-color: var(--light-navy) !important; }
.btn-outline-navy { border-color: var(--navy-color); color: var(--navy-color); }
.btn-outline-navy:hover { background-color: var(--navy-color); color: white; }
.btn-navy { background-color: var(--navy-color); color: #fff; border: none; transition: 0.3s; }
.btn-navy:hover { background-color: #145214; color: #fff; transform: translateY(-2px); }
.card { border-radius: 16px; transition: 0.3s; }
.card:hover { transform: translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.15) !important; }
.status-icon { width: 80px; height: 80px; font-size: 2rem; }
.info-box { border-left: 4px solid var(--navy-color); }
.animate-fade { opacity: 0; transform: translateY(20px); transition: all 0.6s ease; }
.animate-fade.visible { opacity: 1; transform: translateY(0); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const animatedElements = document.querySelectorAll('.animate-fade');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    animatedElements.forEach(element => observer.observe(element));
});
</script>
@endsection
