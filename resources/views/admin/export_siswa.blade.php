<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Siswa - {{ $siswa->nama_lengkap }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #2e7d32;
            padding-bottom: 10px;
        }

        .header h1 {
            color: #2e7d32;
            margin: 0;
            font-size: 20px;
        }

        .header p {
            margin: 5px 0;
        }

        .section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .section-title {
            background-color: #2e7d32;
            color: white;
            padding: 5px 10px;
            font-weight: bold;
            margin-bottom: 10px;
            border-radius: 4px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .info-table td {
            padding: 5px;
            vertical-align: top;
        }

        .info-table .label {
            font-weight: bold;
            width: 30%;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .badge {
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: bold;
        }

        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>DATA SISWA DITERIMA</h1>
        <p>MI DIPONEGORO 03 KARANGKLESEM</p>
        <p>Alamat: Jl. Gunung Tugel No. 10 RT 03 RW 09
            Karangklesem, Kec. Purwokerto Selatan
            Kab. Banyumas, Jawa Tengah</p>
    </div>

    <!-- Data Pribadi -->
    <div class="section">
        <div class="section-title">DATA PRIBADI</div>
        <table class="info-table">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td>: {{ $siswa->nama_lengkap }}</td>
                <td class="label">NIK</td>
                <td>: {{ $siswa->nik }}</td>
            </tr>
            <tr>
                <td class="label">Nomor KIP</td>
                <td colspan="3">: {{ $siswa->no_kip ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Jenis Kelamin</td>
                <td>: {{ $siswa->jenis_kelamin }}</td>
                <td class="label">Tempat, Tanggal Lahir</td>
                <td>: {{ $siswa->tempat_lahir }},
                    {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td class="label">Status Pendaftaran</td>
                <td colspan="3">:
                    <span
                        class="badge badge-{{ $siswa->status_pendaftaran == 'Diterima' ? 'success' : ($siswa->status_pendaftaran == 'Ditolak' ? 'danger' : 'warning') }}">
                        {{ $siswa->status_pendaftaran }}
                    </span>
                </td>
            </tr>
        </table>

    </div>

    <!-- Kontak & Alamat -->
    <div class="section">
        <div class="section-title">KONTAK & ALAMAT</div>
        <table class="info-table">
            <tr>
                <td class="label">No. HP</td>
                <td>: {{ $siswa->no_hp }}</td>
                <td class="label">Email</td>
                <td>: {{ $siswa->email }}</td>
            </tr>
            <tr>
                <td class="label">Alamat Lengkap</td>
                <td colspan="3">: {{ $siswa->alamat }}</td>
            </tr>
            <tr>
                <td class="label">Kelurahan</td>
                <td>: {{ $siswa->kelurahan }}</td>
                <td class="label">Kecamatan</td>
                <td>: {{ $siswa->kecamatan }}</td>
            </tr>
            <tr>
                <td class="label">Kabupaten</td>
                <td>: {{ $siswa->kabupaten }}</td>
                <td class="label">Provinsi</td>
                <td>: {{ $siswa->provinsi }}</td>
            </tr>
            <tr>
                <td class="label">Kode Pos</td>
                <td>: {{ $siswa->kode_pos }}</td>
            </tr>
        </table>
    </div>

    <!-- Data Sekolah -->
    <div class="section">
        <div class="section-title">DATA SEKOLAH</div>
        <table class="info-table">
            <tr>
                <td class="label">Asal Sekolah</td>
                <td>: {{ $siswa->asal_sekolah }}</td>
                <td class="label">Tahun Lulus</td>
                <td>: {{ $siswa->tahun_lulus }}</td>
            </tr>
        </table>
    </div>

    <!-- Data Orang Tua -->
    <div class="section">
        <div class="section-title">DATA ORANG TUA</div>

        <table class="info-table">
            <tr>
                <td colspan="4" style="font-weight: bold; background-color: #f8f9fa;">Data Ayah</td>
            </tr>
            <tr>
                <td class="label">Nama Ayah</td>
                <td>: {{ $siswa->nama_ayah }}</td>
                <td class="label">Pekerjaan Ayah</td>
                <td>: {{ $siswa->pekerjaan_ayah }}</td>
            </tr>
            <tr>
                <td class="label">Pendidikan Ayah</td>
                <td>: {{ $siswa->pendidikan_ayah }}</td>
                <td class="label">Penghasilan Ayah</td>
                <td>: {{ $siswa->penghasilan_ayah ?? '0' }}</td>
            </tr>
        </table>

        <table class="info-table">
            <tr>
                <td colspan="4" style="font-weight: bold; background-color: #f8f9fa;">Data Ibu</td>
            </tr>
            <tr>
                <td class="label">Nama Ibu</td>
                <td>: {{ $siswa->nama_ibu }}</td>
                <td class="label">Pekerjaan Ibu</td>
                <td>: {{ $siswa->pekerjaan_ibu }}</td>
            </tr>
            <tr>
                <td class="label">Pendidikan Ibu</td>
                <td>: {{ $siswa->pendidikan_ibu }}</td>
                <td class="label">Penghasilan Ibu</td>
                <td>: {{ $siswa->penghasilan_ibu ?? '0' }}</td>
            </tr>
        </table>
    </div>

    <!-- Dokumen -->
    <div class="section">
        <div class="section-title">DOKUMEN</div>
        <table class="info-table">
            <tr>
                <td class="label">Akta Kelahiran</td>
                <td>: {{ $siswa->akta_kelahiran ? 'Tersedia' : 'Tidak Tersedia' }}</td>
            </tr>
            <tr>
                <td class="label">Kartu Keluarga</td>
                <td>: {{ $siswa->kartu_keluarga ? 'Tersedia' : 'Tidak Tersedia' }}</td>
            </tr>
            <tr>
                <td class="label">Foto Siswa</td>
                <td>: {{ $siswa->foto_siswa ? 'Tersedia' : 'Tidak Tersedia' }}</td>
            </tr>
            <tr>
                <td class="label">Foto KIP</td>
                <td>: {{ $siswa->foto_kip ? 'Tersedia' : 'Tidak Tersedia' }}</td>
            </tr>
        </table>
    </div>


    <div class="footer">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i:s') }}</p>
        <p>Oleh: Admin PPDB MI Diponegoro 03 Karangklesem</p>
    </div>
</body>

</html>
