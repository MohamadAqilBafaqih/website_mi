<!-- Prestasi Siswa -->
<section class="py-5 bg-light" id="prestasi">
    <div class="container">
        <h2 class="section-title text-center mb-5">Prestasi Siswa</h2>
        <div class="row g-4">
            @foreach ($prestasiTerbaru as $prestasi)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        @if ($prestasi->foto)
                            <img src="{{ asset('uploads/prestasisiswa/' . $prestasi->foto) }}" class="card-img-top"
                                alt="{{ $prestasi->nama_prestasi }}">
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2 small text-muted">
                                <span><i class="far fa-calendar-alt me-1"></i>
                                    {{ $prestasi->created_at->format('d M Y') }}</span>
                                <span><i class="fas fa-trophy me-1 text-warning"></i> {{ $prestasi->tingkat ?? 'Prestasi' }}</span>
                            </div>
                            <h5 class="card-title">{{ $prestasi->nama_prestasi }}</h5>
                            <p class="card-text text-muted">
                                {{ Str::limit($prestasi->keterangan ?? '-', 100) }}
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0 text-end">
                            <a href="{{ route('pengguna.prestasi.show', $prestasi->id) }}"
                                class="btn btn-outline-success btn-sm">
                                Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('pengguna.prestasi.index') }}" class="btn btn-success">
                Lihat Semua Prestasi <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>
