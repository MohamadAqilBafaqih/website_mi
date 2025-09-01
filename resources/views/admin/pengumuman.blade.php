@extends('Admin.dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-bullhorn"></i> Kelola Pengumuman
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengumuman</li>
                </ol>
            </nav>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row animate-fade-in">
            <div class="col-lg-12">
                @forelse($data as $pengumuman)
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title text-success">
                                <i class="fas fa-edit me-2"></i> Pengumuman #{{ $loop->iteration }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.pengumuman.update', $pengumuman->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <label for="running_teks_{{ $pengumuman->id }}" class="form-label fw-bold text-success">
                                        <i class="fas fa-text-width me-1"></i> Running Teks
                                    </label>
                                    <textarea name="running_teks" id="running_teks_{{ $pengumuman->id }}" rows="5" class="form-control border-success"
                                        required>{{ $pengumuman->running_teks }}</textarea>
                                </div>

                                @for ($i = 1; $i <= 3; $i++)
                                    <div class="mb-4">
                                        <label for="foto_slide{{ $i }}_{{ $pengumuman->id }}"
                                            class="form-label fw-bold text-success">
                                            <i class="fas fa-image me-1"></i> Foto Slide {{ $i }}
                                        </label>
                                        <input type="file" name="foto_slide{{ $i }}"
                                            id="foto_slide{{ $i }}_{{ $pengumuman->id }}"
                                            class="form-control border-success">

                                        @if ($pengumuman->{'foto_slide' . $i})
                                            <div class="mt-2">
                                                <a href="{{ asset('uploads/pengumuman/' . $pengumuman->{'foto_slide' . $i}) }}"
                                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i> Lihat Foto Slide {{ $i }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @endfor



                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="submit" class="btn btn-success btn-icon">
                                        <i class="fas fa-save me-2"></i> Perbarui
                                    </button>

                                    <button type="button" class="btn btn-danger btn-icon"
                                        onclick="confirmDelete({{ $pengumuman->id }})">
                                        <i class="fas fa-trash-alt me-2"></i> Hapus
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning text-center">
                        <i class="fas fa-exclamation-circle me-2"></i> Belum ada pengumuman.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Delete Form (hidden) -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data pengumuman akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2e7d32',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('deleteForm');
                    form.action = `/admin/pengumuman/${id}`;
                    form.submit();
                }
            });
        }

        // Initialize CKEditor for each running_teks textarea
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($data as $pengumuman)
                if (document.getElementById('running_teks_{{ $pengumuman->id }}')) {
                    ClassicEditor
                        .create(document.getElementById('running_teks_{{ $pengumuman->id }}'), {
                            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
                                'blockQuote', 'undo', 'redo'
                            ]
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }
            @endforeach
        });
    </script>

    <style>
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-radius: 12px 12px 0 0 !important;
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .form-control {
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.25);
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
            background-color: #d32f2f;
            border-color: #d32f2f;
        }

        .btn-danger:hover {
            background-color: #b71c1c;
            border-color: #b71c1c;
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

        .ck-editor__editable {
            min-height: 150px;
            border-radius: 0 0 8px 8px !important;
        }

        .ck.ck-toolbar {
            border-radius: 8px 8px 0 0 !important;
        }
    </style>
@endsection
