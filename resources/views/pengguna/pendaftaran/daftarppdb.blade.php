@extends('pengguna.beranda-content')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 text-center fw-bold">Formulir Pendaftaran Peserta Didik Baru</h2>

        <form action="{{ route('pendaftaran.storeUser') }}" method="POST" enctype="multipart/form-data"
            class="card shadow p-4 rounded-4">
            @csrf

            {{-- Data Pribadi --}}
            <h5 class="fw-bold mb-3">Data Pribadi</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap *</label>
                    <input type="text" name="nama_lengkap" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">NIK *</label>
                    <input type="text" name="nik" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jenis Kelamin *</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tempat Lahir *</label>
                    <input type="text" name="tempat_lahir" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Lahir *</label>
                    <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>
            </div>

            {{-- Alamat --}}
            <h5 class="fw-bold mt-4 mb-3">Alamat Domisili</h5>
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label">Alamat Lengkap *</label>
                    <textarea name="alamat" class="form-control" rows="2" required></textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kelurahan *</label>
                    <input type="text" name="kelurahan" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kecamatan *</label>
                    <input type="text" name="kecamatan" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kabupaten *</label>
                    <input type="text" name="kabupaten" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Provinsi *</label>
                    <input type="text" name="provinsi" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kode Pos *</label>
                    <input type="text" name="kode_pos" class="form-control" required>
                </div>
            </div>

            {{-- Kontak --}}
            <h5 class="fw-bold mt-4 mb-3">Kontak</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">No HP *</label>
                    <input type="text" name="no_hp" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
            </div>

            {{-- Pendidikan --}}
            <h5 class="fw-bold mt-4 mb-3">Riwayat Pendidikan</h5>
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Asal Sekolah *</label>
                    <input type="text" name="asal_sekolah" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tahun Lulus *</label>
                    <input type="text" name="tahun_lulus" class="form-control" required>
                </div>
            </div>

            {{-- Data Ayah --}}
            <h5 class="fw-bold mt-4 mb-3">Data Ayah *</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Ayah *</label>
                    <input type="text" name="nama_ayah" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pekerjaan Ayah</label>
                    <select name="pekerjaan_ayah" class="form-control @error('pekerjaan_ayah') is-invalid @enderror">
                        <option value="">Pilih Pekerjaan Ayah</option>
                        <option value="PNS" {{ old('pekerjaan_ayah') == 'PNS' ? 'selected' : '' }}>PNS</option>
                        <option value="TNI/POLRI" {{ old('pekerjaan_ayah') == 'TNI/POLRI' ? 'selected' : '' }}>TNI/POLRI
                        </option>
                        <option value="Guru/Dosen" {{ old('pekerjaan_ayah') == 'Guru/Dosen' ? 'selected' : '' }}>Guru/Dosen
                        </option>
                        <option value="Petani" {{ old('pekerjaan_ayah') == 'Petani' ? 'selected' : '' }}>Petani</option>
                        <option value="Wiraswasta" {{ old('pekerjaan_ayah') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta
                        </option>
                        <option value="Karyawan Swasta" {{ old('pekerjaan_ayah') == 'Karyawan Swasta' ? 'selected' : '' }}>
                            Karyawan Swasta</option>
                        <option value="Buruh" {{ old('pekerjaan_ayah') == 'Buruh' ? 'selected' : '' }}>Buruh</option>
                        <option value="Tidak Bekerja" {{ old('pekerjaan_ayah') == 'Tidak Bekerja' ? 'selected' : '' }}>
                            Tidak Bekerja</option>
                        <option value="Lainnya" {{ old('pekerjaan_ayah') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('pekerjaan_ayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pendidikan Ayah</label>
                    <select name="pendidikan_ayah" class="form-control @error('pendidikan_ayah') is-invalid @enderror">
                        <option value="">Pilih Pendidikan Ayah</option>
                        <option value="Tidak Sekolah" {{ old('pendidikan_ayah') == 'Tidak Sekolah' ? 'selected' : '' }}>
                            Tidak Sekolah</option>
                        <option value="SD/MI" {{ old('pendidikan_ayah') == 'SD/MI' ? 'selected' : '' }}>SD / MI</option>
                        <option value="SMP/MTs" {{ old('pendidikan_ayah') == 'SMP/MTs' ? 'selected' : '' }}>SMP / MTs
                        </option>
                        <option value="SMA/MA/SMK" {{ old('pendidikan_ayah') == 'SMA/MA/SMK' ? 'selected' : '' }}>SMA / MA
                            / SMK</option>
                        <option value="Diploma" {{ old('pendidikan_ayah') == 'Diploma' ? 'selected' : '' }}>Diploma (D1)
                        </option>
                        <option value="D4/S1" {{ old('pendidikan_ayah') == 'D4/S1' ? 'selected' : '' }}>Strata 1 (S1)
                        </option>
                        <option value="S2" {{ old('pendidikan_ayah') == 'S2' ? 'selected' : '' }}>Strata 2 (S2)
                        </option>
                        <option value="S3" {{ old('pendidikan_ayah') == 'S3' ? 'selected' : '' }}>Strata 3 (S3)
                        </option>
                    </select>
                    @error('pendidikan_ayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Penghasilan Ayah</label>
                    <select name="penghasilan_ayah" class="form-control @error('penghasilan_ayah') is-invalid @enderror">
                        <option value="">Pilih Penghasilan Ayah</option>
                        <option value="< Rp. 500.000" {{ old('penghasilan_ayah') == '< Rp. 500.000' ? 'selected' : '' }}>
                            &lt; Rp. 500.000</option>
                        <option value="Rp. 500.000 - Rp. 1.000.000"
                            {{ old('penghasilan_ayah') == 'Rp. 500.000 - Rp. 1.000.000' ? 'selected' : '' }}>Rp. 500.000 -
                            Rp. 1.000.000</option>
                        <option value="Rp. 1.000.000 - Rp. 2.000.000"
                            {{ old('penghasilan_ayah') == 'Rp. 1.000.000 - Rp. 2.000.000' ? 'selected' : '' }}>Rp.
                            1.000.000 - Rp. 2.000.000</option>
                        <option value="Rp. 2.000.000 - Rp. 5.000.000"
                            {{ old('penghasilan_ayah') == 'Rp. 2.000.000 - Rp. 5.000.000' ? 'selected' : '' }}>Rp.
                            2.000.000 - Rp. 5.000.000</option>
                        <option value="Rp. 5.000.000 - Rp. 10.000.000"
                            {{ old('penghasilan_ayah') == 'Rp. 5.000.000 - Rp. 10.000.000' ? 'selected' : '' }}>Rp.
                            5.000.000 - Rp. 10.000.000</option>
                        <option value="> Rp. 10.000.000"
                            {{ old('penghasilan_ayah') == '> Rp. 10.000.000' ? 'selected' : '' }}>&gt; Rp. 10.000.000
                        </option>
                    </select>
                    @error('penghasilan_ayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Data Ibu --}}
            <h5 class="fw-bold mt-4 mb-3">Data Ibu *</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Ibu *</label>
                    <input type="text" name="nama_ibu" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pekerjaan Ibu</label>
                    <select name="pekerjaan_ibu" class="form-control @error('pekerjaan_ibu') is-invalid @enderror">
                        <option value="">Pilih Pekerjaan Ibu</option>
                        <option value="PNS" {{ old('pekerjaan_ibu') == 'PNS' ? 'selected' : '' }}>PNS</option>
                        <option value="TNI/POLRI" {{ old('pekerjaan_ibu') == 'TNI/POLRI' ? 'selected' : '' }}>TNI/POLRI
                        </option>
                        <option value="Guru/Dosen" {{ old('pekerjaan_ibu') == 'Guru/Dosen' ? 'selected' : '' }}>Guru/Dosen
                        </option>
                        <option value="Petani" {{ old('pekerjaan_ibu') == 'Petani' ? 'selected' : '' }}>Petani</option>
                        <option value="Wiraswasta" {{ old('pekerjaan_ibu') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta
                        </option>
                        <option value="Karyawan Swasta" {{ old('pekerjaan_ibu') == 'Karyawan Swasta' ? 'selected' : '' }}>
                            Karyawan Swasta</option>
                        <option value="Buruh" {{ old('pekerjaan_ibu') == 'Buruh' ? 'selected' : '' }}>Buruh</option>
                        <option value="Tidak Bekerja" {{ old('pekerjaan_ibu') == 'Tidak Bekerja' ? 'selected' : '' }}>
                            Tidak Bekerja</option>
                        <option value="Lainnya" {{ old('pekerjaan_ibu') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('pekerjaan_ibu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pendidikan Ibu</label>
                    <select name="pendidikan_ibu" class="form-control @error('pendidikan_ibu') is-invalid @enderror">
                        <option value="">Pilih Pendidikan Ibu</option>
                        <option value="Tidak Sekolah" {{ old('pendidikan_ibu') == 'Tidak Sekolah' ? 'selected' : '' }}>
                            Tidak Sekolah</option>
                        <option value="SD/MI" {{ old('pendidikan_ibu') == 'SD/MI' ? 'selected' : '' }}>SD / MI</option>
                        <option value="SMP/MTs" {{ old('pendidikan_ibu') == 'SMP/MTs' ? 'selected' : '' }}>SMP / MTs
                        </option>
                        <option value="SMA/MA/SMK" {{ old('pendidikan_ibu') == 'SMA/MA/SMK' ? 'selected' : '' }}>SMA / MA
                            / SMK</option>
                        <option value="Diploma" {{ old('pendidikan_ibu') == 'Diploma' ? 'selected' : '' }}>Diploma (D1)
                        </option>
                        <option value="D4/S1" {{ old('pendidikan_ibu') == 'D4/S1' ? 'selected' : '' }}>Strata 1 (S1)
                        </option>
                        <option value="S2" {{ old('pendidikan_ibu') == 'S2' ? 'selected' : '' }}>Strata 2 (S2)
                        </option>
                        <option value="S3" {{ old('pendidikan_ibu') == 'S3' ? 'selected' : '' }}>Strata 3 (S3)
                        </option>
                    </select>
                    @error('pendidikan_ibu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Penghasilan Ibu</label>
                    <select name="penghasilan_ibu" class="form-control @error('penghasilan_ibu') is-invalid @enderror">
                        <option value="">Pilih Penghasilan Ibu</option>
                        <option value="< Rp. 500.000" {{ old('penghasilan_ibu') == '< Rp. 500.000' ? 'selected' : '' }}>
                            &lt; Rp. 500.000</option>
                        <option value="Rp. 500.000 - Rp. 1.000.000"
                            {{ old('penghasilan_ibu') == 'Rp. 500.000 - Rp. 1.000.000' ? 'selected' : '' }}>Rp. 500.000 -
                            Rp. 1.000.000</option>
                        <option value="Rp. 1.000.000 - Rp. 2.000.000"
                            {{ old('penghasilan_ibu') == 'Rp. 1.000.000 - Rp. 2.000.000' ? 'selected' : '' }}>Rp. 1.000.000
                            - Rp. 2.000.000</option>
                        <option value="Rp. 2.000.000 - Rp. 5.000.000"
                            {{ old('penghasilan_ibu') == 'Rp. 2.000.000 - Rp. 5.000.000' ? 'selected' : '' }}>Rp. 2.000.000
                            - Rp. 5.000.000</option>
                        <option value="Rp. 5.000.000 - Rp. 10.000.000"
                            {{ old('penghasilan_ibu') == 'Rp. 5.000.000 - Rp. 10.000.000' ? 'selected' : '' }}>Rp.
                            5.000.000 - Rp. 10.000.000</option>
                        <option value="> Rp. 10.000.000"
                            {{ old('penghasilan_ibu') == '> Rp. 10.000.000' ? 'selected' : '' }}>&gt; Rp. 10.000.000
                        </option>
                    </select>
                    @error('penghasilan_ibu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Upload Dokumen --}}
            <h5 class="fw-bold mt-4 mb-3">Upload Dokumen</h5>
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
                    <label class="form-label">Nomor KIP (opsional)</label>
                    <input type="text" name="no_kip" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Foto KIP (opsional)</label>
                    <input type="file" name="foto_kip" class="form-control">
                </div>
            </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn btn-success btn-lg rounded-pill px-5">
                    <i class="bi bi-send"></i> Daftar Sekarang
                </button>
            </div>
        </form>
    </div>
@endsection
