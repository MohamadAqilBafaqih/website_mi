@extends('pengguna.beranda-content')

@section('title', 'Kontak Sekolah')

@section('content')
    <div class="container py-5">
        <h1 class="mb-5 text-center">Kontak MI Diponegoro 03 Karangklesem</h1>

        <div class="row g-4">
            {{-- Profil & Alamat Sekolah --}}
            <div class="col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h3 class="card-title mb-3">Profil Sekolah</h3>
                        <p>
                            MI Diponegoro 03 Karangklesem adalah madrasah ibtidaiyah unggulan yang berfokus pada
                            pengembangan iman, ilmu, dan akhlak siswa.
                            Berlokasi di Karangklesem, Purwokerto Timur, Banyumas, Jawa Tengah.
                        </p>
                        <h5 class="mt-3">Alamat</h5>
                        <p>
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Jl. Karangklesem No.12, Kec. Purwokerto Timur, Kab. Banyumas, Jawa Tengah
                        </p>

                        <h5>NPSN</h5>
                        <p><i class="fas fa-id-card me-2"></i> 60710449</p>

                        <h5>Kontak</h5>
                        <p><i class="fas fa-phone me-2"></i>Telepon: (0281) 641382</p>
                        <p><i class="fas fa-envelope me-2"></i>Email: info@midiponegoro03.sch.id</p>
                        <p><i class="fas fa-clock me-2"></i>Jam Operasional: Senin – Kamis 07.00 – 14.30 WIB, Jumat 07.00 - 11.00, Sabtu 07.00 – 14.30 WIB</p>

                        <h5 class="mt-4">Media Sosial</h5>
                        <p>
                            <a href="#" class="me-3"><i class="fab fa-facebook fa-lg"></i></a>
                            <a href="#" class="me-3"><i class="fab fa-instagram fa-lg"></i></a>
                            <a href="#" class="me-3"><i class="fab fa-youtube fa-lg"></i></a>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Peta Lokasi --}}
            <div class="col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h3 class="card-title mb-3">Lokasi Sekolah</h3>
                        <div class="ratio ratio-16x9">
                            <iframe
                                src="{{ $googleMapsLink }}"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
