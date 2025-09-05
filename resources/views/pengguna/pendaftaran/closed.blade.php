@extends('pengguna.beranda-content')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg rounded-4 border-0" data-aos="fade-up" data-aos-duration="800">
                    <div class="card-body text-center p-5">

                        <!-- Icon -->
                        <div class="mb-4">
                            <i class="fas fa-info-circle fa-3x text-success"></i>
                        </div>

                        <!-- Pesan -->
                        <h4 class="fw-bold mb-3" style="color: #2e7d32;">
                            {{ $message }}
                        </h4>

                        <!-- Divider -->
                        <div class="mx-auto mb-3"
                            style="width: 60px; height: 3px; background-color: #2e7d32; border-radius: 10px;"></div>

                        <!-- Tambahan teks opsional -->
                        <p class="text-muted">
                            "Halo Sahabat Madrasah 👋
                            Saat ini pendaftaran belum dibuka. Jangan khawatir, pendaftaran akan dimulai sesuai dengan
                            tanggal yang tercantum pada brosur. Silakan pantau terus informasi dari kami ya 🙏."
                        </p>

                        <!-- Tombol kembali -->
                        <a href="{{ url('/') }}" class="btn btn-success rounded-pill px-4 mt-3">
                            <i class="fas fa-home me-2"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
