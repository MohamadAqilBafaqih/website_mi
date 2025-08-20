@extends('Admin.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <h1 class="page-title">
            <i class="fas fa-users"></i> Data Siswa Diterima
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
            </ol>
        </nav>
    </div>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabel Data Siswa -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat / Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Email</th>
                            <th>Asal Sekolah</th>
                            <th>Orang Tua</th>
                            <th>Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswa as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->tempat_lahir }}, {{ \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                                <td>{{ $item->alamat }}, {{ $item->kelurahan }}, {{ $item->kecamatan }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->asal_sekolah }} ({{ $item->tahun_lulus }})</td>
                                <td>
                                    <strong>Ayah:</strong> {{ $item->nama_ayah }} <br>
                                    Pekerjaan: {{ $item->pekerjaan_ayah }} <br>
                                    Pendidikan: {{ $item->pendidikan_ayah }} <br>
                                    Penghasilan: {{ $item->penghasilan_ayah }} <br><br>
                                    <strong>Ibu:</strong> {{ $item->nama_ibu }} <br>
                                    Pekerjaan: {{ $item->pekerjaan_ibu }} <br>
                                    Pendidikan: {{ $item->pendidikan_ibu }} <br>
                                    Penghasilan: {{ $item->penghasilan_ibu }}
                                </td>
                                <td>
                                    @if($item->akta_kelahiran)
                                        <a href="{{ Storage::url($item->akta_kelahiran) }}" target="_blank" class="btn btn-sm btn-primary">Akta</a>
                                    @endif
                                    @if($item->kartu_keluarga)
                                        <a href="{{ Storage::url($item->kartu_keluarga) }}" target="_blank" class="btn btn-sm btn-secondary">KK</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.datasiswa.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.datasiswa.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">Tidak ada data siswa diterima.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
