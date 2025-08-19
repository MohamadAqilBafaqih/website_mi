@extends('Admin.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-user-graduate"></i> Kelola Calon Siswa
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pendaftaran Siswa</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Calon Siswa</li>
            </ol>
        </nav>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row animate-fade-in">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-success">
                        <i class="fas fa-list me-2"></i> Daftar Calon Siswa
                    </h5>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
                        <i class="fas fa-plus me-1"></i> Tambah Baru
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable">
                            <thead class="table-success">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Asal Sekolah</th>
                                    <th>Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_lengkap }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ $item->asal_sekolah ?? '-' }}</td>
                                    <td>
                                        <span class="badge 
                                            {{ $item->status_pendaftaran == 'Diterima' ? 'bg-success' : 
                                               ($item->status_pendaftaran == 'Ditolak' ? 'bg-danger' : 'bg-secondary') }}">
                                            {{ $item->status_pendaftaran }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" 
                                            data-bs-target="#detailModal" data-id="{{ $item->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" 
                                            data-bs-target="#editModal" data-id="{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data calon siswa</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Calon Siswa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.calonsiswa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-success fw-bold mb-3">Data Pribadi</h6>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_lengkap" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NISN</label>
                                    <input type="text" class="form-control" name="nisn">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIK</label>
                                    <input type="text" class="form-control" name="nik">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="form-select" name="jenis_kelamin" required>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Agama</label>
                                    <input type="text" class="form-control" name="agama">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-success fw-bold mb-3">Kontak & Alamat</h6>
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="2"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kelurahan</label>
                                    <input type="text" class="form-control" name="kelurahan">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kecamatan</label>
                                    <input type="text" class="form-control" name="kecamatan">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kabupaten</label>
                                    <input type="text" class="form-control" name="kabupaten">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Provinsi</label>
                                    <input type="text" class="form-control" name="provinsi">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kode Pos</label>
                                    <input type="text" class="form-control" name="kode_pos">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No. HP</label>
                                    <input type="text" class="form-control" name="no_hp">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h6 class="text-success fw-bold mb-3">Data Sekolah Asal</h6>
                            <div class="mb-3">
                                <label class="form-label">Asal Sekolah</label>
                                <input type="text" class="form-control" name="asal_sekolah">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tahun Lulus</label>
                                <input type="text" class="form-control" name="tahun_lulus">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-success fw-bold mb-3">Status Pendaftaran</h6>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status_pendaftaran">
                                    <option value="Baru">Baru</option>
                                    <option value="Diterima">Diterima</option>
                                    <option value="Ditolak">Ditolak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h6 class="text-success fw-bold mb-3">Data Ayah</h6>
                            <div class="mb-3">
                                <label class="form-label">Nama Ayah</label>
                                <input type="text" class="form-control" name="nama_ayah">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIK Ayah</label>
                                    <input type="text" class="form-control" name="nik_ayah">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pekerjaan Ayah</label>
                                    <input type="text" class="form-control" name="pekerjaan_ayah">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pendidikan Ayah</label>
                                <input type="text" class="form-control" name="pendidikan_ayah">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-success fw-bold mb-3">Data Ibu</h6>
                            <div class="mb-3">
                                <label class="form-label">Nama Ibu</label>
                                <input type="text" class="form-control" name="nama_ibu">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIK Ibu</label>
                                    <input type="text" class="form-control" name="nik_ibu">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pekerjaan Ibu</label>
                                    <input type="text" class="form-control" name="pekerjaan_ibu">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pendidikan Ibu</label>
                                <input type="text" class="form-control" name="pendidikan_ibu">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h6 class="text-success fw-bold mb-3">Penghasilan Orang Tua</h6>
                            <div class="mb-3">
                                <label class="form-label">Penghasilan</label>
                                <input type="text" class="form-control" name="penghasilan_ortu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-success fw-bold mb-3">Dokumen Pendukung</h6>
                            <div class="mb-3">
                                <label class="form-label">Akta Kelahiran</label>
                                <input type="file" class="form-control" name="akta_kelahiran" accept=".jpg,.jpeg,.png,.pdf">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kartu Keluarga</label>
                                <input type="file" class="form-control" name="kartu_keluarga" accept=".jpg,.jpeg,.png,.pdf">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="detailModalLabel">Detail Calon Siswa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detailContent">
                <!-- Content will be loaded via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="editModalLabel">Edit Calon Siswa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body" id="editContent">
                    <!-- Content will be loaded via AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Form (hidden) -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    // Confirm delete function
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data calon siswa akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2e7d32',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('deleteForm');
                form.action = `/admin/calonsiswa/${id}`;
                form.submit();
            }
        });
    }

    // Load detail data via AJAX
    document.getElementById('detailModal').addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const modal = this;
        
        fetch(`/admin/calonsiswa/${id}`)
            .then(response => response.text())
            .then(html => {
                modal.querySelector('#detailContent').innerHTML = html;
            });
    });

    // Load edit form via AJAX
    document.getElementById('editModal').addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const modal = this;
        
        fetch(`/admin/calonsiswa/${id}/edit`)
            .then(response => response.text())
            .then(html => {
                modal.querySelector('#editContent').innerHTML = html;
                modal.querySelector('#editForm').action = `/admin/calonsiswa/${id}`;
            });
    });

    // Initialize DataTable
    document.addEventListener('DOMContentLoaded', function() {
        $('#dataTable').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json'
            }
        });
    });
</script>

<style>
    /* Custom styles for this page */
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
    
    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
    }
    
    .table-success {
        background-color: #d1e7dd;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
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
    
    .modal-section {
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }
    
    .modal-section:last-child {
        border-bottom: none;
    }
</style>
@endsection