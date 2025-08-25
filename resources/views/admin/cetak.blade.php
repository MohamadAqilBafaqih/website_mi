<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Semua Siswa Diterima</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #2e7d32;
            padding-bottom: 10px;
        }

        .header h2 {
            color: #2e7d32;
            margin: 0;
            font-size: 20px;
        }

        .header p {
            margin: 5px 0;
            color: #555;
        }

        .info-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 8px 12px;
            background-color: #e8f5e9;
            border-radius: 4px;
            border-left: 4px solid #2e7d32;
        }

        .info-item {
            display: flex;
            align-items: center;
        }

        .info-item strong {
            margin-right: 5px;
            color: #2e7d32;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #2e7d32;
            color: white;
        }

        th {
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
        }

        tbody tr {
            border-bottom: 1px solid #ddd;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f8e9;
        }

        td {
            padding: 10px 8px;
            vertical-align: top;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            font-size: 11px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

        .page-info {
            padding: 5px 10px;
            background-color: #e8f5e9;
            border-radius: 4px;
            font-weight: bold;
        }

        @media print {
            body {
                padding: 0;
            }

            thead {
                background-color: #2e7d32 !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
            }

            tbody tr:nth-child(even) {
                background-color: #f9f9f9 !important;
                -webkit-print-color-adjust: exact;
            }

            .info-bar {
                border: 1px solid #ccc;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>DATA SISWA DITERIMA</h2>
        <p>MI DIPONEGORO 03 KARANGKLESEM</p>
        <p>Jl. Gunung Tugel No. 10 RT 03 RW 09 Karangklesem, Kec. Purwokerto Selatan, Kab. Banyumas, Jawa Tengah</p>
    </div>

    <!-- Bar informasi dengan jumlah siswa dan tahun ajaran -->
    <div class="info-bar">
        <div class="info-item">
            @php
                $currentMonth = \Carbon\Carbon::now()->month;
                $currentYear = \Carbon\Carbon::now()->year;
                $nextYear = $currentMonth >= 7 ? $currentYear + 1 : $currentYear;
                $startYear = $currentMonth >= 7 ? $currentYear : $currentYear - 1;
            @endphp

            <strong>Tahun Ajaran:</strong> {{ $startYear }}/{{ $nextYear }}

        </div>
        <div class="info-item">
            <strong>Jumlah Siswa:</strong> {{ count($siswa) }} orang
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>NIK</th>
                <th>JK</th>
                <th>TTL</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Asal Sekolah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->tempat_lahir }},
                        {{ \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d/m/Y') }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ $item->asal_sekolah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Informasi halaman -->
    <div class="pagination">
        <div class="page-info">Halaman 1 dari 1</div>
    </div>

    <div class="footer">
        <div>
            <p>Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i:s') }}</p>
        </div>
        <div>
            <p>Oleh: Admin PPDB MI Diponegoro 03 Karangklesem</p>
        </div>
    </div>
</body>

</html>