@extends('pengguna.beranda-content')

@section('content')
    <div class="container py-4 mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <!-- Header Section -->
                <div class="text-center mb-4 animate-fade">
                    <div class="title-container position-relative d-inline-block mb-3">
                        <h2 class="fw-bold text-navy mb-2 section-title"
                            style="font-size: 2rem; position: relative; z-index: 2;">
                            Formulir Pendaftaran Peserta Didik Baru
                        </h2>
                    </div>
                    <div class="subtitle-wrapper mb-3">
                        <span class="subtitle-badge bg-navy text-white px-3 py-1 rounded-pill d-inline-block"
                            style="font-size: 0.95rem; font-weight: 500;">
                            MI Diponegoro 03 Karangklesem
                        </span>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger animate-fade">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Pendaftaran -->
                <div class="card mb-5 border-0 shadow-lg animate-fade" data-delay="100">
                    <div class="card-header bg-navy text-white py-3 d-flex align-items-center">
                        <div class="icon-container bg-white text-navy rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width: 36px; height: 36px;">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h5 class="mb-0 fw-semibold">Formulir Pendaftaran</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('pendaftaran.storeUser') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Data Pribadi -->
                            <!-- Data Pribadi -->
                            <div class="section-header mb-4 mt-4">
                                <h5 class="fw-bold text-navy d-flex align-items-center">
                                    <span
                                        class="bg-navy text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                        style="width: 30px; height: 30px;">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    Data Pribadi
                                </h5>
                                <hr class="mt-2">
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap *</label>
                                    <input type="text" name="nama_lengkap" class="form-control" required
                                        value="{{ old('nama_lengkap') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NIK *</label>
                                    <input type="text" name="nik" class="form-control" required
                                        value="{{ old('nik') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Kelamin *</label>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Laki-laki"
                                            {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan"
                                            {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tempat Lahir *</label>
                                    <input type="text" name="tempat_lahir" class="form-control" required
                                        value="{{ old('tempat_lahir') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Lahir *</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required
                                        value="{{ old('tanggal_lahir') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nomor KIP (opsional)</label>
                                    <input type="text" name="no_kip" class="form-control" value="{{ old('no_kip') }}">
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="section-header mb-4 mt-5">
                                <h5 class="fw-bold text-navy d-flex align-items-center">
                                    <span
                                        class="bg-navy text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                        style="width: 30px; height: 30px;">
                                        <i class="fas fa-home"></i>
                                    </span>
                                    Alamat Domisili
                                </h5>
                                <hr class="mt-2">
                            </div>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label">Alamat Lengkap *</label>
                                    <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat') }}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Kelurahan *</label>
                                    <input type="text" name="kelurahan" class="form-control" required
                                        value="{{ old('kelurahan') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Kecamatan *</label>
                                    <input type="text" name="kecamatan" class="form-control" required
                                        value="{{ old('kecamatan') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Kabupaten *</label>
                                    <input type="text" name="kabupaten" class="form-control" required
                                        value="{{ old('kabupaten') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Provinsi *</label>
                                    <input type="text" name="provinsi" class="form-control" required
                                        value="{{ old('provinsi') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kode Pos *</label>
                                    <input type="text" name="kode_pos" class="form-control" required
                                        value="{{ old('kode_pos') }}">
                                </div>
                            </div>

                            <!-- Kontak -->
                            <div class="section-header mb-4 mt-5">
                                <h5 class="fw-bold text-navy d-flex align-items-center">
                                    <span
                                        class="bg-navy text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                        style="width: 30px; height: 30px;">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    Kontak
                                </h5>
                                <hr class="mt-2">
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">No HP *</label>
                                    <input type="text" name="no_hp" class="form-control" required
                                        value="{{ old('no_hp') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control" required
                                        value="{{ old('email') }}">
                                </div>
                            </div>

                            <!-- Pendidikan -->
                            <div class="section-header mb-4 mt-5">
                                <h5 class="fw-bold text-navy d-flex align-items-center">
                                    <span
                                        class="bg-navy text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                        style="width: 30px; height: 30px;">
                                        <i class="fas fa-graduation-cap"></i>
                                    </span>
                                    Riwayat Pendidikan
                                </h5>
                                <hr class="mt-2">
                            </div>
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label">Asal Sekolah *</label>
                                    <input type="text" name="asal_sekolah" class="form-control" required
                                        value="{{ old('asal_sekolah') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Tahun Lulus *</label>
                                    <input type="text" name="tahun_lulus" class="form-control" required
                                        value="{{ old('tahun_lulus') }}">
                                </div>
                            </div>

                            <!-- Data Ayah -->
                            <div class="section-header mb-4 mt-5">
                                <h5 class="fw-bold text-navy d-flex align-items-center">
                                    <span
                                        class="bg-navy text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                        style="width: 30px; height: 30px;">
                                        <i class="fas fa-male"></i>
                                    </span>
                                    Data Ayah *
                                </h5>
                                <hr class="mt-2">
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Ayah *</label>
                                    <input type="text" name="nama_ayah" class="form-control" required
                                        value="{{ old('nama_ayah') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pekerjaan Ayah</label>
                                    <select name="pekerjaan_ayah"
                                        class="form-control @error('pekerjaan_ayah') is-invalid @enderror">
                                        <option value="">Pilih Pekerjaan Ayah</option>
                                        <option value="PNS" {{ old('pekerjaan_ayah') == 'PNS' ? 'selected' : '' }}>PNS
                                        </option>
                                        <option value="TNI/POLRI"
                                            {{ old('pekerjaan_ayah') == 'TNI/POLRI' ? 'selected' : '' }}>TNI/POLRI</option>
                                        <option value="Guru/Dosen"
                                            {{ old('pekerjaan_ayah') == 'Guru/Dosen' ? 'selected' : '' }}>Guru/Dosen
                                        </option>
                                        <option value="Petani" {{ old('pekerjaan_ayah') == 'Petani' ? 'selected' : '' }}>
                                            Petani</option>
                                        <option value="Wiraswasta"
                                            {{ old('pekerjaan_ayah') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta
                                        </option>
                                        <option value="Karyawan Swasta"
                                            {{ old('pekerjaan_ayah') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan
                                            Swasta</option>
                                        <option value="Buruh" {{ old('pekerjaan_ayah') == 'Buruh' ? 'selected' : '' }}>
                                            Buruh</option>
                                        <option value="Tidak Bekerja"
                                            {{ old('pekerjaan_ayah') == 'Tidak Bekerja' ? 'selected' : '' }}>Tidak Bekerja
                                        </option>
                                        <option value="Lainnya"
                                            {{ old('pekerjaan_ayah') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('pekerjaan_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pendidikan Ayah</label>
                                    <select name="pendidikan_ayah"
                                        class="form-control @error('pendidikan_ayah') is-invalid @enderror">
                                        <option value="">Pilih Pendidikan Ayah</option>
                                        <option value="Tidak Sekolah"
                                            {{ old('pendidikan_ayah') == 'Tidak Sekolah' ? 'selected' : '' }}>Tidak Sekolah
                                        </option>
                                        <option value="SD/MI" {{ old('pendidikan_ayah') == 'SD/MI' ? 'selected' : '' }}>
                                            SD / MI</option>
                                        <option value="SMP/MTs"
                                            {{ old('pendidikan_ayah') == 'SMP/MTs' ? 'selected' : '' }}>SMP / MTs</option>
                                        <option value="SMA/MA/SMK"
                                            {{ old('pendidikan_ayah') == 'SMA/MA/SMK' ? 'selected' : '' }}>SMA / MA / SMK
                                        </option>
                                        <option value="Diploma"
                                            {{ old('pendidikan_ayah') == 'Diploma' ? 'selected' : '' }}>Diploma (D1)
                                        </option>
                                        <option value="D4/S1" {{ old('pendidikan_ayah') == 'D4/S1' ? 'selected' : '' }}>
                                            Strata 1 (S1)</option>
                                        <option value="S2" {{ old('pendidikan_ayah') == 'S2' ? 'selected' : '' }}>
                                            Strata 2 (S2)</option>
                                        <option value="S3" {{ old('pendidikan_ayah') == 'S3' ? 'selected' : '' }}>
                                            Strata 3 (S3)</option>
                                    </select>
                                    @error('pendidikan_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Penghasilan Ayah</label>
                                    <select name="penghasilan_ayah"
                                        class="form-control @error('penghasilan_ayah') is-invalid @enderror">
                                        <option value="">Pilih Penghasilan Ayah</option>
                                        <option value="< Rp. 500.000"
                                            {{ old('penghasilan_ayah') == '< Rp. 500.000' ? 'selected' : '' }}>&lt; Rp.
                                            500.000</option>
                                        <option value="Rp. 500.000 - Rp. 1.000.000"
                                            {{ old('penghasilan_ayah') == 'Rp. 500.000 - Rp. 1.000.000' ? 'selected' : '' }}>
                                            Rp. 500.000 - Rp. 1.000.000</option>
                                        <option value="Rp. 1.000.000 - Rp. 2.000.000"
                                            {{ old('penghasilan_ayah') == 'Rp. 1.000.000 - Rp. 2.000.000' ? 'selected' : '' }}>
                                            Rp. 1.000.000 - Rp. 2.000.000</option>
                                        <option value="Rp. 2.000.000 - Rp. 5.000.000"
                                            {{ old('penghasilan_ayah') == 'Rp. 2.000.000 - Rp. 5.000.000' ? 'selected' : '' }}>
                                            Rp. 2.000.000 - Rp. 5.000.000</option>
                                        <option value="Rp. 5.000.000 - Rp. 10.000.000"
                                            {{ old('penghasilan_ayah') == 'Rp. 5.000.000 - Rp. 10.000.000' ? 'selected' : '' }}>
                                            Rp. 5.000.000 - Rp. 10.000.000</option>
                                        <option value="> Rp. 10.000.000"
                                            {{ old('penghasilan_ayah') == '> Rp. 10.000.000' ? 'selected' : '' }}>&gt; Rp.
                                            10.000.000</option>
                                    </select>
                                    @error('penghasilan_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Data Ibu -->
                            <div class="section-header mb-4 mt-5">
                                <h5 class="fw-bold text-navy d-flex align-items-center">
                                    <span
                                        class="bg-navy text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                        style="width: 30px; height: 30px;">
                                        <i class="fas fa-female"></i>
                                    </span>
                                    Data Ibu *
                                </h5>
                                <hr class="mt-2">
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Ibu *</label>
                                    <input type="text" name="nama_ibu" class="form-control" required
                                        value="{{ old('nama_ibu') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pekerjaan Ibu</label>
                                    <select name="pekerjaan_ibu"
                                        class="form-control @error('pekerjaan_ibu') is-invalid @enderror">
                                        <option value="">Pilih Pekerjaan Ibu</option>
                                        <option value="PNS" {{ old('pekerjaan_ibu') == 'PNS' ? 'selected' : '' }}>PNS
                                        </option>
                                        <option value="TNI/POLRI"
                                            {{ old('pekerjaan_ibu') == 'TNI/POLRI' ? 'selected' : '' }}>TNI/POLRI</option>
                                        <option value="Guru/Dosen"
                                            {{ old('pekerjaan_ibu') == 'Guru/Dosen' ? 'selected' : '' }}>Guru/Dosen
                                        </option>
                                        <option value="Petani" {{ old('pekerjaan_ibu') == 'Petani' ? 'selected' : '' }}>
                                            Petani</option>
                                        <option value="Wiraswasta"
                                            {{ old('pekerjaan_ibu') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta
                                        </option>
                                        <option value="Karyawan Swasta"
                                            {{ old('pekerjaan_ibu') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan
                                            Swasta</option>
                                        <option value="Buruh" {{ old('pekerjaan_ibu') == 'Buruh' ? 'selected' : '' }}>
                                            Buruh</option>
                                        <option value="Tidak Bekerja"
                                            {{ old('pekerjaan_ibu') == 'Tidak Bekerja' ? 'selected' : '' }}>Tidak Bekerja
                                        </option>
                                        <option value="Lainnya" {{ old('pekerjaan_ibu') == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    @error('pekerjaan_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pendidikan Ibu</label>
                                    <select name="pendidikan_ibu"
                                        class="form-control @error('pendidikan_ibu') is-invalid @enderror">
                                        <option value="">Pilih Pendidikan Ibu</option>
                                        <option value="Tidak Sekolah"
                                            {{ old('pendidikan_ibu') == 'Tidak Sekolah' ? 'selected' : '' }}>Tidak Sekolah
                                        </option>
                                        <option value="SD/MI" {{ old('pendidikan_ibu') == 'SD/MI' ? 'selected' : '' }}>SD
                                            / MI</option>
                                        <option value="SMP/MTs"
                                            {{ old('pendidikan_ibu') == 'SMP/MTs' ? 'selected' : '' }}>SMP / MTs</option>
                                        <option value="SMA/MA/SMK"
                                            {{ old('pendidikan_ibu') == 'SMA/MA/SMK' ? 'selected' : '' }}>SMA / MA / SMK
                                        </option>
                                        <option value="Diploma"
                                            {{ old('pendidikan_ibu') == 'Diploma' ? 'selected' : '' }}>Diploma (D1)
                                        </option>
                                        <option value="D4/S1" {{ old('pendidikan_ibu') == 'D4/S1' ? 'selected' : '' }}>
                                            Strata 1 (S1)</option>
                                        <option value="S2" {{ old('pendidikan_ibu') == 'S2' ? 'selected' : '' }}>
                                            Strata 2 (S2)</option>
                                        <option value="S3" {{ old('pendidikan_ibu') == 'S3' ? 'selected' : '' }}>
                                            Strata 3 (S3)</option>
                                    </select>
                                    @error('pendidikan_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Penghasilan Ibu</label>
                                    <select name="penghasilan_ibu"
                                        class="form-control @error('penghasilan_ibu') is-invalid @enderror">
                                        <option value="">Pilih Penghasilan Ibu</option>
                                        <option value="< Rp. 500.000"
                                            {{ old('penghasilan_ibu') == '< Rp. 500.000' ? 'selected' : '' }}>&lt; Rp.
                                            500.000</option>
                                        <option value="Rp. 500.000 - Rp. 1.000.000"
                                            {{ old('penghasilan_ibu') == 'Rp. 500.000 - Rp. 1.000.000' ? 'selected' : '' }}>
                                            Rp. 500.000 - Rp. 1.000.000</option>
                                        <option value="Rp. 1.000.000 - Rp. 2.000.000"
                                            {{ old('penghasilan_ibu') == 'Rp. 1.000.000 - Rp. 2.000.000' ? 'selected' : '' }}>
                                            Rp. 1.000.000 - Rp. 2.000.000</option>
                                        <option value="Rp. 2.000.000 - Rp. 5.000.000"
                                            {{ old('penghasilan_ibu') == 'Rp. 2.000.000 - Rp. 5.000.000' ? 'selected' : '' }}>
                                            Rp. 2.000.000 - Rp. 5.000.000</option>
                                        <option value="Rp. 5.000.000 - Rp. 10.000.000"
                                            {{ old('penghasilan_ibu') == 'Rp. 5.000.000 - Rp. 10.000.000' ? 'selected' : '' }}>
                                            Rp. 5.000.000 - Rp. 10.000.000</option>
                                        <option value="> Rp. 10.000.000"
                                            {{ old('penghasilan_ibu') == '> Rp. 10.000.000' ? 'selected' : '' }}>&gt; Rp.
                                            10.000.000</option>
                                    </select>
                                    @error('penghasilan_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Upload Dokumen -->
                            <!-- Upload Dokumen -->
                            <div class="section-header mb-4 mt-5">
                                <h5 class="fw-bold text-navy d-flex align-items-center">
                                    <span
                                        class="bg-navy text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                        style="width: 30px; height: 30px;">
                                        <i class="fas fa-file-upload"></i>
                                    </span>
                                    Upload Dokumen
                                </h5>
                                <hr class="mt-2">
                                <p class="text-muted fst-italic" style="font-size: 0.9rem;">
                                    * Dokumen yang diupload harus berupa <strong>hasil scan asli</strong>, bukan foto dari
                                    kamera.
                                </p>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Akta Kelahiran *</label>
                                    <input type="file" name="akta_kelahiran" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kartu Keluarga *</label>
                                    <input type="file" name="kartu_keluarga" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Foto Siswa (3x4) *</label>
                                    <input type="file" name="foto_siswa" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Foto KIP (opsional)</label>
                                    <input type="file" name="foto_kip" class="form-control">
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-navy btn-lg rounded-pill px-5">
                                    <i class="fas fa-paper-plane me-2"></i> Daftar Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --navy-color: #1b5e20;
        }

        .bg-navy {
            background-color: var(--navy-color) !important;
        }

        .text-navy {
            color: var(--navy-color) !important;
        }

        .btn-navy {
            background-color: var(--navy-color);
            color: #fff;
            border: none;
            transition: 0.3s;
        }

        .btn-navy:hover {
            background-color: #145214;
            color: #fff;
        }

        .card {
            border-radius: 12px;
            overflow: hidden;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .icon-container {
            transition: all 0.3s ease;
        }

        .card:hover .icon-container {
            transform: rotate(10deg) scale(1.1);
        }

        .animate-fade {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }

        .animate-fade.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .section-header h5 {
            position: relative;
            padding-bottom: 5px;
        }

        .section-header hr {
            border-top: 2px solid var(--navy-color);
            opacity: 0.3;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--navy-color);
            box-shadow: 0 0 0 0.25rem rgba(27, 94, 32, 0.25);
        }
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
            }, {
                threshold: 0.1
            });
            animatedElements.forEach(element => {
                observer.observe(element);
            });
        });
    </script>
@endsection
