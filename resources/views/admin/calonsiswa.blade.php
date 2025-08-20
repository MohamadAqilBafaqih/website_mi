<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Calon Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .page-header {
            background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(193, 183, 183, 0.1);
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
            border: none;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 15px 20px;
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
        }

        .form-control {
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.25);
        }

        textarea.form-control {
            min-height: 120px;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-success {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }

        .btn-success:hover {
            background-color: #1b5e20;
            border-color: #1b5e20;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #bb2d3b;
            border-color: #bb2d3b;
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-section {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #2e7d32;
        }

        .form-section h6 {
            color: #2e7d32;
            font-weight: 600;
        }

        .required-field::after {
            content: " *";
            color: #dc3545;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
        }

        /* Perbaikan responsivitas */
        @media (max-width: 768px) {
            .card-header h5 {
                font-size: 1.1rem;
            }

            .btn-icon {
                width: 100%;
                margin-bottom: 10px;
            }

            .d-flex.justify-content-end {
                flex-direction: column;
            }

            .form-section {
                padding: 12px;
            }
        }

        /* Efek visual untuk input file */
        .form-control[type="file"] {
            padding: 0.5rem;
        }

        /* Perataan yang lebih baik untuk form */
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #495057;
        }

        /* Animasi untuk input */
        .form-control,
        .form-select {
            transition: all 0.3s ease;
        }

        /* Perbaikan tampilan pada mobile */
        @media (max-width: 576px) {
            .page-header h1 {
                font-size: 1.5rem;
            }

            .breadcrumb {
                font-size: 0.8rem;
            }

            .form-section h6 {
                font-size: 0.95rem;
            }
        }
    </style>
</head>

<body>
    @extends('Admin.dashboard')

    @section('content')
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title" style="color: #f9f9f9;">
                    <i class="fas fa-user-graduate"></i> Kelola Calon Siswa
                </h1>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.calonsiswa.index') }}">Pendaftaran Siswa</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Calon Siswa</li>
                    </ol>
                </nav>
            </div>

            <!-- Alert Success -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn"
                    role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Alert Error -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn"
                    role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Terdapat kesalahan dalam pengisian form. Silakan periksa kembali.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Form Card -->
            <div class="row animate-fade-in">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-success">
                                <i class="fas fa-plus-circle me-2"></i> Formulir Pendaftaran Calon Siswa
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.calonsiswa.store') }}" method="POST"
                                enctype="multipart/form-data" id="tambahForm">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-section">
                                            <h6 class="fw-bold mb-3"><i class="fas fa-user me-2"></i>Data Pribadi</h6>
                                            <div class="mb-3">
                                                <label class="form-label required-field">Nama Lengkap</label>
                                                <input type="text"
                                                    class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                    name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                                                @error('nama_lengkap')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">NIK</label>
                                                <input type="text"
                                                    class="form-control @error('nik') is-invalid @enderror" name="nik"
                                                    value="{{ old('nik') }}" maxlength="20">
                                                @error('nik')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label required-field">Jenis Kelamin</label>
                                                    <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                                        name="jenis_kelamin" required>
                                                        <option value="">Pilih Jenis Kelamin</option>
                                                        <option value="Laki-laki"
                                                            {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                                            Laki-laki</option>
                                                        <option value="Perempuan"
                                                            {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                                            Perempuan</option>
                                                    </select>
                                                    @error('jenis_kelamin')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <!-- Field Agama dihapus -->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Tempat Lahir</label>
                                                    <input type="text"
                                                        class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                        name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                                        maxlength="50">
                                                    @error('tempat_lahir')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Tanggal Lahir</label>
                                                    <input type="date"
                                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                        name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                                    @error('tanggal_lahir')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-section">
                                            <h6 class="fw-bold mb-3"><i class="fas fa-address-book me-2"></i>Kontak & Alamat
                                            </h6>
                                            <div class="mb-3">
                                                <label class="form-label">Alamat</label>
                                                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="2">{{ old('alamat') }}</textarea>
                                                @error('alamat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Kelurahan</label>
                                                    <input type="text"
                                                        class="form-control @error('kelurahan') is-invalid @enderror"
                                                        name="kelurahan" value="{{ old('kelurahan') }}" maxlength="50">
                                                    @error('kelurahan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Kecamatan</label>
                                                    <input type="text"
                                                        class="form-control @error('kecamatan') is-invalid @enderror"
                                                        name="kecamatan" value="{{ old('kecamatan') }}" maxlength="50">
                                                    @error('kecamatan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Kabupaten</label>
                                                    <input type="text"
                                                        class="form-control @error('kabupaten') is-invalid @enderror"
                                                        name="kabupaten" value="{{ old('kabupaten') }}" maxlength="50">
                                                    @error('kabupaten')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Provinsi</label>
                                                    <input type="text"
                                                        class="form-control @error('provinsi') is-invalid @enderror"
                                                        name="provinsi" value="{{ old('provinsi') }}" maxlength="50">
                                                    @error('provinsi')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Kode Pos</label>
                                                    <input type="text"
                                                        class="form-control @error('kode_pos') is-invalid @enderror"
                                                        name="kode_pos" value="{{ old('kode_pos') }}" maxlength="10">
                                                    @error('kode_pos')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">No. HP</label>
                                                    <input type="text"
                                                        class="form-control @error('no_hp') is-invalid @enderror"
                                                        name="no_hp" value="{{ old('no_hp') }}" maxlength="20">
                                                    @error('no_hp')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" maxlength="100">
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-section">
                                            <h6 class="fw-bold mb-3"><i class="fas fa-school me-2"></i>Data Sekolah Asal
                                            </h6>
                                            <div class="mb-3">
                                                <label class="form-label">Asal Sekolah</label>
                                                <input type="text"
                                                    class="form-control @error('asal_sekolah') is-invalid @enderror"
                                                    name="asal_sekolah" value="{{ old('asal_sekolah') }}"
                                                    maxlength="100">
                                                @error('asal_sekolah')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Tahun Lulus</label>
                                                <input type="text"
                                                    class="form-control @error('tahun_lulus') is-invalid @enderror"
                                                    name="tahun_lulus" value="{{ old('tahun_lulus') }}" maxlength="4"
                                                    pattern="\d{4}" title="Masukkan 4 digit tahun">
                                                @error('tahun_lulus')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-section">
                                            <h6 class="fw-bold mb-3"><i class="fas fa-male me-2"></i>Data Ayah</h6>
                                            <div class="mb-3">
                                                <label class="form-label">Nama Ayah</label>
                                                <input type="text"
                                                    class="form-control @error('nama_ayah') is-invalid @enderror"
                                                    name="nama_ayah" value="{{ old('nama_ayah') }}" maxlength="100">
                                                @error('nama_ayah')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <!-- Field NIK Ayah dihapus -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Pekerjaan Ayah</label>
                                                    <select name="pekerjaan_ayah"
                                                        class="form-control @error('pekerjaan_ayah') is-invalid @enderror">
                                                        <option value="">Pilih Pekerjaan Ayah</option>
                                                        <option value="PNS"
                                                            {{ old('pekerjaan_ayah') == 'PNS' ? 'selected' : '' }}>PNS
                                                        </option>
                                                        <option value="TNI/POLRI"
                                                            {{ old('pekerjaan_ayah') == 'TNI/POLRI' ? 'selected' : '' }}>
                                                            TNI/POLRI</option>
                                                        <option value="Guru/Dosen"
                                                            {{ old('pekerjaan_ayah') == 'Guru/Dosen' ? 'selected' : '' }}>
                                                            Guru/Dosen</option>
                                                        <option value="Petani"
                                                            {{ old('pekerjaan_ayah') == 'Petani' ? 'selected' : '' }}>
                                                            Petani</option>
                                                        <option value="Wiraswasta"
                                                            {{ old('pekerjaan_ayah') == 'Wiraswasta' ? 'selected' : '' }}>
                                                            Wiraswasta</option>
                                                        <option value="Karyawan Swasta"
                                                            {{ old('pekerjaan_ayah') == 'Karyawan Swasta' ? 'selected' : '' }}>
                                                            Karyawan Swasta</option>
                                                        <option value="Buruh"
                                                            {{ old('pekerjaan_ayah') == 'Buruh' ? 'selected' : '' }}>Buruh
                                                        </option>
                                                        <option value="Tidak Bekerja"
                                                            {{ old('pekerjaan_ayah') == 'Tidak Bekerja' ? 'selected' : '' }}>
                                                            Tidak Bekerja</option>
                                                        <option value="Lainnya"
                                                            {{ old('pekerjaan_ayah') == 'Lainnya' ? 'selected' : '' }}>
                                                            Lainnya</option>
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
                                                            {{ old('pendidikan_ayah') == 'Tidak Sekolah' ? 'selected' : '' }}>
                                                            Tidak Sekolah</option>
                                                        <option value="SD/MI"
                                                            {{ old('pendidikan_ayah') == 'SD/MI' ? 'selected' : '' }}>SD /
                                                            MI</option>
                                                        <option value="SMP/MTs"
                                                            {{ old('pendidikan_ayah') == 'SMP/MTs' ? 'selected' : '' }}>SMP
                                                            / MTs</option>
                                                        <option value="SMA/MA/SMK"
                                                            {{ old('pendidikan_ayah') == 'SMA/MA/SMK' ? 'selected' : '' }}>
                                                            SMA / MA / SMK</option>
                                                        <option value="Diploma"
                                                            {{ old('pendidikan_ayah') == 'Diploma' ? 'selected' : '' }}>
                                                            Diploma
                                                            (D1)</option>
                                                        <option value="D4/S1"
                                                            {{ old('pendidikan_ayah') == 'S1' ? 'selected' : '' }}>Strata 1
                                                            (S1)</option>
                                                        <option value="S2"
                                                            {{ old('pendidikan_ayah') == 'S2' ? 'selected' : '' }}>Strata 2
                                                            (S2)</option>
                                                        <option value="S3"
                                                            {{ old('pendidikan_ayah') == 'S3' ? 'selected' : '' }}>Strata 3
                                                            (S3)</option>
                                                    </select>
                                                    @error('pendidikan_ayah')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Penghasilan Ayah</label>
                                                <select name="penghasilan_ayah"
                                                    class="form-control @error('penghasilan_ayah') is-invalid @enderror">
                                                    <option value="">Pilih Penghasilan Ayah</option>
                                                    <option value="< Rp. 500.000"
                                                        {{ old('penghasilan_ayah') == '< Rp. 500.000' ? 'selected' : '' }}>
                                                        < Rp. 500.000</option>
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
                                                        {{ old('penghasilan_ayah') == '> Rp. 10.000.000' ? 'selected' : '' }}>
                                                        > Rp. 10.000.000</option>
                                                </select>
                                                @error('penghasilan_ayah')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-section">
                                            <h6 class="fw-bold mb-3"><i class="fas fa-female me-2"></i>Data Ibu</h6>
                                            <div class="mb-3">
                                                <label class="form-label">Nama Ibu</label>
                                                <input type="text"
                                                    class="form-control @error('nama_ibu') is-invalid @enderror"
                                                    name="nama_ibu" value="{{ old('nama_ibu') }}" maxlength="100">
                                                @error('nama_ibu')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Pekerjaan Ibu</label>
                                                    <select name="pekerjaan_ibu"
                                                        class="form-control @error('pekerjaan_ibu') is-invalid @enderror">
                                                        <option value="">Pilih Pekerjaan Ibu</option>
                                                        <option value="PNS"
                                                            {{ old('pekerjaan_ibu') == 'PNS' ? 'selected' : '' }}>PNS
                                                        </option>
                                                        <option value="TNI/POLRI"
                                                            {{ old('pekerjaan_ibu') == 'TNI/POLRI' ? 'selected' : '' }}>
                                                            TNI/POLRI</option>
                                                        <option value="Guru/Dosen"
                                                            {{ old('pekerjaan_ibu') == 'Guru/Dosen' ? 'selected' : '' }}>
                                                            Guru/Dosen</option>
                                                        <option value="Petani"
                                                            {{ old('pekerjaan_ibu') == 'Petani' ? 'selected' : '' }}>Petani
                                                        </option>
                                                        <option value="Wiraswasta"
                                                            {{ old('pekerjaan_ibu') == 'Wiraswasta' ? 'selected' : '' }}>
                                                            Wiraswasta</option>
                                                        <option value="Karyawan Swasta"
                                                            {{ old('pekerjaan_ibu') == 'Karyawan Swasta' ? 'selected' : '' }}>
                                                            Karyawan Swasta</option>
                                                        <option value="Buruh"
                                                            {{ old('pekerjaan_ibu') == 'Buruh' ? 'selected' : '' }}>Buruh
                                                        </option>
                                                        <option value="Ibu Rumah Tangga"
                                                            {{ old('pekerjaan_ibu') == 'Ibu Rumah Tangga' ? 'selected' : '' }}>
                                                            Ibu Rumah Tangga</option>
                                                        <option value="Tidak Bekerja"
                                                            {{ old('pekerjaan_ibu') == 'Tidak Bekerja' ? 'selected' : '' }}>
                                                            Tidak Bekerja</option>
                                                        <option value="Lainnya"
                                                            {{ old('pekerjaan_ibu') == 'Lainnya' ? 'selected' : '' }}>
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
                                                            {{ old('pendidikan_ibu') == 'Tidak Sekolah' ? 'selected' : '' }}>
                                                            Tidak Sekolah</option>
                                                        <option value="SD/MI"
                                                            {{ old('pendidikan_ibu') == 'SD/MI' ? 'selected' : '' }}>SD /
                                                            MI</option>
                                                        <option value="SMP/MTs"
                                                            {{ old('pendidikan_ibu') == 'SMP/MTs' ? 'selected' : '' }}>SMP
                                                            / MTs</option>
                                                        <option value="SMA/MA/SMK"
                                                            {{ old('pendidikan_ibu') == 'SMA/MA/SMK' ? 'selected' : '' }}>
                                                            SMA / MA / SMK</option>
                                                        <option value="Diploma"
                                                            {{ old('pendidikan_ibu') == 'Diploma' ? 'selected' : '' }}>
                                                            Diploma
                                                            (D1)</option>
                                                        <option value="S1"
                                                            {{ old('pendidikan_ibu') == 'S1' ? 'selected' : '' }}>Strata 1
                                                            (S1)</option>
                                                        <option value="S2"
                                                            {{ old('pendidikan_ibu') == 'S2' ? 'selected' : '' }}>Strata 2
                                                            (S2)</option>
                                                        <option value="S3"
                                                            {{ old('pendidikan_ibu') == 'S3' ? 'selected' : '' }}>Strata 3
                                                            (S3)</option>
                                                    </select>
                                                    @error('pendidikan_ibu')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Penghasilan Ibu</label>
                                                <select name="penghasilan_ibu"
                                                    class="form-control @error('penghasilan_ibu') is-invalid @enderror">
                                                    <option value="">Pilih Penghasilan Ibu</option>
                                                    <option value="< Rp. 500.000"
                                                        {{ old('penghasilan_ibu') == '< Rp. 500.000' ? 'selected' : '' }}>
                                                        < Rp. 500.000</option>
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
                                                        {{ old('penghasilan_ibu') == '> Rp. 10.000.000' ? 'selected' : '' }}>
                                                        > Rp. 10.000.000</option>
                                                </select>
                                                @error('penghasilan_ibu')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-section">
                                            <h6 class="fw-bold mb-3"><i class="fas fa-file-alt me-2"></i>Dokumen Pendukung
                                            </h6>
                                            <div class="mb-3">
                                                <label class="form-label">Akta Kelahiran</label>
                                                <input type="file"
                                                    class="form-control @error('akta_kelahiran') is-invalid @enderror"
                                                    name="akta_kelahiran" accept=".jpg,.jpeg,.png,.pdf">
                                                <small class="text-muted">Maksimal ukuran file: 10MB</small>
                                                @error('akta_kelahiran')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Kartu Keluarga</label>
                                                <input type="file"
                                                    class="form-control @error('kartu_keluarga') is-invalid @enderror"
                                                    name="kartu_keluarga" accept=".jpg,.jpeg,.png,.pdf">
                                                <small class="text-muted">Maksimal ukuran file: 10MB</small>
                                                @error('kartu_keluarga')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary me-2">
                                        <i class="fas fa-arrow-left me-1"></i> Kembali
                                    </a>
                                    <button type="reset" class="btn btn-warning me-2">
                                        <i class="fas fa-undo me-1"></i> Reset Form
                                    </button>
                                    <button type="submit" class="btn btn-success btn-icon">
                                        <i class="fas fa-save me-2"></i>Simpan Data
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                // Handle form submission
                $('#tambahForm').submit(function(e) {
                    e.preventDefault();

                    // Clear previous validation errors
                    $('.form-control').removeClass('is-invalid');
                    $('.invalid-feedback').text('');
                    $('.form-select').removeClass('is-invalid');

                    // Get form data
                    var formData = new FormData(this);

                    // Show loading state
                    var submitButton = $(this).find('button[type="submit"]');
                    var originalText = submitButton.html();
                    submitButton.prop('disabled', true).html(
                        '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...');

                    // Submit form via AJAX
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            // Show success message
                            if (response.success) {
                                $('#successAlert').removeClass('d-none').find('span').text(response
                                    .message);

                                // Scroll to alert
                                $('html, body').animate({
                                    scrollTop: $('#successAlert').offset().top - 100
                                }, 500);

                                // Reset form
                                $('#tambahForm')[0].reset();

                                // Redirect after 2 seconds
                                setTimeout(function() {
                                    window.location.href =
                                        "{{ route('admin.calonsiswa.index') }}";
                                }, 2000);
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                // Validation errors
                                var errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    var element = $('[name="' + key + '"]');
                                    element.addClass('is-invalid');
                                    element.nextAll('.invalid-feedback').first().text(value[
                                        0]);
                                });

                                // Show error message
                                $('#errorAlert').removeClass('d-none').find('span').text(
                                    'Terdapat kesalahan dalam pengisian form. Silakan periksa kembali.'
                                );

                                // Scroll to first error
                                $('html, body').animate({
                                    scrollTop: $('.is-invalid').first().offset().top - 100
                                }, 500);
                            } else {
                                // Other errors
                                $('#errorAlert').removeClass('d-none').find('span').text(
                                    'Terjadi kesalahan. Silakan coba lagi.');

                                // Scroll to error
                                $('html, body').animate({
                                    scrollTop: $('#errorAlert').offset().top - 100
                                }, 500);
                            }
                        },
                        complete: function() {
                            // Restore button state
                            submitButton.prop('disabled', false).html(originalText);
                        }
                    });
                });

                // Add animation to form elements
                document.querySelectorAll('.form-control').forEach((element, index) => {
                    element.style.animationDelay = `${index * 0.1}s`;
                });
            });
        </script>
    @endsection
</body>

</html>
