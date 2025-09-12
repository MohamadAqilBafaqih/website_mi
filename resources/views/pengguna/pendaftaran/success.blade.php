@extends('pengguna.beranda-content')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Card Status -->
                <div class="card shadow-lg rounded-4 border-0 animate-fade">
                    <div class="card-body text-center p-5">

                        <!-- Icon -->
                        <div class="mb-4">
                            <div
                                class="status-icon bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center shadow pulse-icon">
                                <i class="fas fa-check fa-2x"></i>
                            </div>
                        </div>

                        <!-- Judul -->
                        <h2 class="fw-bold text-success mb-3 animate-title">
                            🎉 Pendaftaran Berhasil!
                        </h2>

                        <!-- Sub Judul -->
                        <p class="lead text-muted mb-4">
                            Terima kasih telah mendaftar di
                            <strong class="text-success">MI Diponegoro 03 Karangklesem</strong>.<br>
                            Data Anda sudah kami simpan dan sedang <em>diproses lebih lanjut</em>.
                        </p>
                            @if (!empty($link))
                                <div class="alert alert-success mt-3 rounded-4 shadow-lg p-4 text-center border-0"
                                    style="background: linear-gradient(135deg, #25d366, #128c7e); color: #fff;">
                                    <!-- Ikon WhatsApp -->
                                    <div class="mb-3">
                                        <i class="fab fa-whatsapp fa-3x"></i>
                                    </div>

                                    <!-- Judul -->
                                    <h5 class="fw-bold mb-2">Wajib Gabung Grup Calon Siswa</h5>
                                    <p class="mb-4">
                                        Untuk mendapatkan <strong>informasi lebih lanjut</strong> mengenai proses PPDB,
                                        jadwal kegiatan, dan pengumuman penting, Anda diwajibkan bergabung ke grup WhatsApp
                                        resmi calon siswa.
                                    </p>

                                    <!-- Tombol Gabung -->
                                    <a href="{{ $link }}" target="_blank"
                                        class="btn btn-light text-success rounded-pill px-4 fw-semibold shadow-sm pulse-btn">
                                        <i class="fab fa-whatsapp me-2"></i> Gabung Grup WhatsApp
                                    </a>
                                </div>
                            @endif
                        </div>

                        <style>
                            /* Animasi tombol pulse */

                            /* Animasi ikon centang */
                            .pulse-icon {
                                animation: pulse 1.5s infinite;
                            }

                            @keyframes pulse {
                                0% {
                                    transform: scale(1);
                                    box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
                                }

                                70% {
                                    transform: scale(1.1);
                                    box-shadow: 0 0 0 20px rgba(40, 167, 69, 0);
                                }

                                100% {
                                    transform: scale(1);
                                    box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
                                }
                            }

                            /* Animasi judul */
                            .animate-title {
                                animation: fadeInUp 1s ease-out;
                            }

                            @keyframes fadeInUp {
                                from {
                                    opacity: 0;
                                    transform: translateY(20px);
                                }

                                to {
                                    opacity: 1;
                                    transform: translateY(0);
                                }
                            }

                            .pulse-btn {
                                position: relative;
                                overflow: hidden;
                                animation: pulse 1.5s infinite;
                            }

                            @keyframes pulse {
                                0% {
                                    transform: scale(1);
                                    box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
                                }

                                70% {
                                    transform: scale(1.05);
                                    box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
                                }

                                100% {
                                    transform: scale(1);
                                    box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
                                }
                            }
                        </style>



                        <!-- Tombol Navigasi -->
                        <div class="d-flex flex-column align-items-center gap-3">
                            <a href="{{ route('pengguna.beranda-content') }}" class="btn btn-navy rounded-pill px-4">
                                <i class="fas fa-home me-2"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        :root {
            --navy-color: #1b5e20;
            --light-navy: rgba(27, 94, 32, 0.1);
        }

        .bg-navy {
            background-color: var(--navy-color) !important;
        }

        .text-navy {
            color: var(--navy-color) !important;
        }

        .bg-light-navy {
            background-color: var(--light-navy) !important;
        }

        .btn-outline-navy {
            border-color: var(--navy-color);
            color: var(--navy-color);
        }

        .btn-outline-navy:hover {
            background-color: var(--navy-color);
            color: white;
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
            transform: translateY(-2px);
        }

        .card {
            border-radius: 16px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .status-icon {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }

        .info-box {
            border-left: 4px solid var(--navy-color);
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
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll('.animate-fade');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });
            animatedElements.forEach(element => observer.observe(element));
        });
    </script>
@endsection
