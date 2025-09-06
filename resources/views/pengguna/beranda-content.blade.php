<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MI Diponegoro 03 Karangklesem - Madrasah Unggulan')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2e7d32;
            --primary-hover: #1e5e23;
            --secondary-color: #81c784;
            --accent-color: #ffc107;
            --accent-hover: #e6ac00;
            --light-color: #f1f8e9;
            --dark-color: #1b5e20;
            --dark-hover: #0f4714;
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            scroll-behavior: smooth;
            background-color: #f8f9fa;
        }

        /* Improved navbar with better mobile responsiveness */
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, var(--dark-color), var(--primary-color));
            transition: all var(--transition-speed) ease;
            padding: 0.5rem 1rem;
        }

        .navbar.scrolled {
            background: var(--dark-color);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .navbar-brand {
            font-weight: 700;
            display: flex;
            align-items: center;
            transition: transform var(--transition-speed);
            font-size: 1.1rem;
        }

        .navbar-brand:hover {
            transform: scale(1.03);
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
            transition: transform 0.5s ease;
        }

        .navbar-brand:hover img {
            transform: rotate(15deg);
        }

        .nav-link {
            position: relative;
            padding: 8px 15px;
            transition: all var(--transition-speed);
            border-radius: 4px;
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link:focus {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .nav-link.active {
            font-weight: 600;
            background-color: rgba(255, 255, 255, 0.15);
        }

        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: var(--accent-color);
            transition: all var(--transition-speed);
            transform: translateX(-50%);
        }

        .nav-link:hover:after,
        .nav-link.active:after {
            width: 70%;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            background-color: white;
            margin-top: 5px;
        }

        .dropdown-item {
            transition: all var(--transition-speed);
            padding: 8px 15px;
        }

        .dropdown-item:hover {
            background-color: var(--light-color);
            transform: translateX(5px);
            color: var(--dark-color);
        }

        /* Improved hero section with better responsiveness */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1588072432836-e10032774350?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 100px 0;
            position: relative;
            transition: all 0.5s ease;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 80px 0;
                background-attachment: scroll;
                min-height: 60vh;
            }
        }

        .hero-section:hover {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1588072432836-e10032774350?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* Improved info cards with better responsiveness */
        .info-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all var(--transition-speed);
            margin-bottom: 20px;
            border-bottom: 4px solid var(--primary-color);
            cursor: pointer;
            height: 100%;
        }

        .info-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            border-bottom-color: var(--accent-color);
        }

        .info-card i {
            transition: all var(--transition-speed);
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: var(--primary-color);
        }

        .info-card:hover i {
            transform: scale(1.2);
            color: var(--accent-color);
        }

        .info-card h3 {
            color: var(--primary-color);
            font-size: 2.5rem;
            font-weight: 700;
            transition: color var(--transition-speed);
            margin-bottom: 0;
        }

        .info-card:hover h3 {
            color: var(--dark-color);
        }

        .info-card p {
            color: #666;
            margin-top: 10px;
        }

        /* Improved card styling */
        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all var(--transition-speed);
            margin-bottom: 20px;
            height: 100%;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Improved buttons */
        .btn-success {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 10px 25px;
            font-weight: 600;
            transition: all var(--transition-speed);
            position: relative;
            overflow: hidden;
            border-radius: 50px;
        }

        .btn-success:hover {
            background-color: var(--dark-hover);
            border-color: var(--dark-hover);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-success:active {
            transform: translateY(-1px);
        }

        .btn-outline-success {
            color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all var(--transition-speed);
            border-radius: 50px;
        }

        .btn-outline-success:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-light:hover {
            color: var(--dark-color);
        }

        /* Improved gallery */
        .gallery-img {
            border-radius: 10px;
            transition: all var(--transition-speed);
            cursor: pointer;
            height: 150px;
            object-fit: cover;
            filter: brightness(0.95);
            width: 100%;
        }

        .gallery-img:hover {
            transform: scale(1.05);
            filter: brightness(1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* Improved section titles */
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 30px;
            color: var(--dark-color);
            transition: all var(--transition-speed);
            font-weight: 700;
            font-size: 2rem;
        }

        .section-title:hover {
            color: var(--primary-color);
        }

        .section-title:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 4px;
            background: var(--accent-color);
            bottom: -10px;
            left: 0;
            border-radius: 2px;
            transition: width var(--transition-speed);
        }

        .section-title:hover:after {
            width: 100%;
        }

        /* Improved footer */
        footer {
            background: linear-gradient(135deg, var(--dark-color), var(--primary-color));
            padding: 40px 0 20px;
            position: relative;
        }

        footer:before {
            content: '';
            position: absolute;
            top: -20px;
            left: 0;
            right: 0;
            height: 20px;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), transparent);
        }

        .social-icons a {
            color: white;
            font-size: 1.5rem;
            margin: 0 10px;
            transition: all var(--transition-speed);
            display: inline-block;
        }

        .social-icons a:hover {
            color: var(--accent-color);
            transform: translateY(-5px) scale(1.2);
        }

        /* Improved floating buttons */
        .floating-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            z-index: 100;
            transition: all var(--transition-speed);
            text-decoration: none;
        }

        .floating-btn:hover {
            background-color: var(--dark-color);
            transform: scale(1.1) rotate(10deg);
            color: white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }

        .back-to-top {
            position: fixed;
            bottom: 100px;
            right: 30px;
            width: 50px;
            height: 50px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 99;
            opacity: 0;
            visibility: hidden;
            transition: all var(--transition-speed);
        }

        .back-to-top.active {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }

        /* Improved counters */
        .counter {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            transition: color var(--transition-speed);
        }

        .info-card:hover .counter {
            color: var(--dark-color);
        }

        /* Improved testimonials */
        .testimonial-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 3px solid var(--accent-color);
            transition: all var(--transition-speed);
        }

        .carousel-item .card:hover .testimonial-img {
            transform: scale(1.1);
            border-color: var(--primary-color);
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 40px;
            height: 40px;
            background-color: var(--primary-color);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 1;
            transition: all var(--transition-speed);
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background-color: var(--dark-color);
            transform: translateY(-50%) scale(1.1);
        }

        /* Animations */
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

        .animate-fade {
            animation: fadeIn 1s ease-out forwards;
        }

        /* Pulse animation for important elements */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        /* Hover effect for footer links */
        footer a {
            transition: all var(--transition-speed);
        }

        footer a:hover {
            color: var(--accent-color) !important;
            padding-left: 5px;
        }

        /* Dropdown animation */
        .dropdown-menu {
            display: block;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all var(--transition-speed);
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Account dropdown styling */
        .account-dropdown .dropdown-menu {
            min-width: 200px;
        }

        .account-dropdown .dropdown-item {
            padding: 8px 15px;
            color: var(--dark-color);
        }

        .account-dropdown .dropdown-item i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
            color: var(--primary-color);
        }

        .account-dropdown .dropdown-item:hover i {
            color: var(--dark-color);
        }

        html {
            scroll-behavior: smooth;
        }

        /* New improvements for better responsiveness */
        @media (max-width: 992px) {
            .navbar-brand {
                font-size: 1rem;
            }
            
            .navbar-brand img {
                height: 35px;
            }
            
            .nav-link {
                padding: 8px 10px;
                font-size: 0.9rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .info-card h3 {
                font-size: 2rem;
            }
            
            .counter {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }
            
            .hero-section p {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 1.6rem;
            }
            
            .info-card {
                padding: 15px;
            }
            
            .info-card h3 {
                font-size: 1.8rem;
            }
            
            .info-card i {
                font-size: 2rem;
            }
            
            .card-img-top {
                height: 180px;
            }
            
            .gallery-img {
                height: 120px;
            }
            
            footer .col-md-4 {
                margin-bottom: 30px;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 0.9rem;
            }
            
            .navbar-brand img {
                height: 30px;
            }
            
            .hero-section {
                padding: 60px 0;
                text-align: center;
            }
            
            .hero-section h1 {
                font-size: 1.8rem;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .info-card h3 {
                font-size: 1.6rem;
            }
            
            .counter {
                font-size: 1.6rem;
            }
            
            .btn-success, .btn-outline-success {
                padding: 8px 20px;
                font-size: 0.9rem;
            }
            
            .floating-btn {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
                bottom: 20px;
                right: 20px;
            }
            
            .back-to-top {
                width: 40px;
                height: 40px;
                font-size: 1rem;
                bottom: 80px;
                right: 20px;
            }
        }

        /* Custom spacing for sections */
        .section-padding {
            padding: 80px 0;
        }

        @media (max-width: 768px) {
            .section-padding {
                padding: 60px 0;
            }
        }

        /* Improved form controls */
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(46, 125, 50, 0.25);
        }

        /* Custom background colors */
        .bg-light-green {
            background-color: var(--light-color);
        }

        .bg-primary-green {
            background-color: var(--primary-color);
        }

        /* Text colors */
        .text-primary-green {
            color: var(--primary-color);
        }

        .text-dark-green {
            color: var(--dark-color);
        }

        /* Custom shadows */
        .shadow-soft {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08) !important;
        }

        .shadow-medium {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
        }

        /* Loading animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="100">
    <!-- Navigasi -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('pengguna.beranda-content') }}">
                <img src="{{ asset('gambar/logobaru.png') }}" alt="Logo" id="logo">
                MI Diponegoro 03 Karangklesem
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('pengguna.beranda-content') }}"><i
                                class="fas fa-home me-1"></i> Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-info-circle me-1"></i> Profil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                            <li><a class="dropdown-item" href="{{ route('pengguna.visimisi') }}"><i
                                        class="fas fa-bullseye me-2"></i> Visi &
                                    Misi</a></li>
                            <li><a class="dropdown-item" href="{{ route('pengguna.sejarah') }}"><i
                                        class="fas fa-history me-2"></i> Sejarah
                                    Madrasah</a></li>
                            <li><a class="dropdown-item" href="{{ route('pengguna.dataguru') }}"><i
                                        class="fas fa-chalkboard-teacher me-2"></i>
                                    Data Guru</a></li>
                            <li><a class="dropdown-item" href="{{ route('pengguna.prestasi.index') }}"><i
                                        class="fas fa-trophy me-2"></i> Prestasi
                                    Siswa</a></li>
                            <li><a class="dropdown-item" href="{{ route('pengguna.saranaprasarana') }}"><i
                                        class="fas fa-building me-2"></i> Sarana
                                    Prasarana</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="ppdbDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-user-graduate me-1"></i> PPDB
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="ppdbDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('ppdb.jadwal') }}">
                                    <i class="fas fa-calendar-alt me-2"></i> Jadwal Pendaftaran
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('ppdb.syarat') }}">
                                    <i class="fas fa-file-alt me-2"></i> Persyaratan
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('ppdb.biaya') }}">
                                    <i class="fas fa-money-bill-wave me-2"></i> Biaya Pendidikan
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('ppdb.kalender') }}">
                                    <i class="fas fa-calendar me-2"></i> Kalender Akademik
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pengguna.pendidikan') }}">
                            <i class="fas fa-graduation-cap me-1"></i> Pendidikan
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pengguna.berita.index') }}"><i
                                class="fas fa-newspaper me-1"></i>
                            Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pengguna.galeri.index') }}"><i
                                class="fas fa-images me-1"></i>
                            Galeri</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarKontak" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-envelope me-1"></i> Kontak
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarKontak">
                            <li>
                                <a class="dropdown-item" href="{{ route('pengguna.kontak.index') }}">
                                    <i class="fas fa-school me-1"></i> Informasi Sekolah
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('pengguna.kontak.testimoni.store') }}">
                                    <i class="fas fa-comment-dots me-1"></i> Beri Testimoni
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('pengguna.saranmasukan.index') }}">
                                    <i class="fas fa-lightbulb me-1"></i> Saran & Masukan
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="mb-3 text-white">MI Diponegoro 03 Karangklesem</h5>
                    <p class="text-white-50">Madrasah yang Unggul dalam Iman, Ilmu, dan Akhlak Mulia. Membentuk
                        generasi yang cerdas dan berkarakter.</p>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/share/1AsaKjSTnu/?mibextid=wwXIfr"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/midipokarkles_?igsh=ODZjcGVnYno5ejFi"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://youtu.be/UNkARFYWLLE"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="mb-3 text-white">Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('pendaftaran.create') }}"
                                class="text-white text-decoration-none"><i class="fas fa-chevron-right me-2"></i>
                                Pendaftaran Siswa Baru</a></li>
                        <li class="mb-2"><a href="{{ route('ppdb.kalender') }}" class="text-white text-decoration-none"><i
                                    class="fas fa-chevron-right me-2"></i> Kalender Akademik</a></li>
                        <li class="mb-2"><a href="https://maps.app.goo.gl/X6Pndur8nr7mMUzCA"
                                class="text-white text-decoration-none"><i class="fas fa-chevron-right me-2"></i> Peta
                                Lokasi</a></li>
                        <li class="mb-2"><a href="{{ route('pengguna.kontak.testimoni.store') }}" class="text-white text-decoration-none"><i
                                    class="fas fa-chevron-right me-2"></i> Testimoni</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="mb-3 text-white">Kontak Kami</h5>
                    <ul class="list-unstyled text-white-50">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-white"></i> Jl. Karangklesem
                            No.
                            03, Purwokerto</li>
                        <li class="mb-2"><i class="fas fa-phone me-2 text-white"></i> (0281) 641382</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2 text-white"></i>
                            info@midiponegoro03.sch.id
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-clock me-2 text-white"></i>
                            Senin - Kamis: 07.00 - 14.30 <br>
                            Jumat: 07.00 - 11.30 <br>
                            Sabtu: 07.00 - 14.30
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-light opacity-25">
            <div class="text-center text-white-50">
                <p class="mb-0">&copy; {{ date('Y') }} MI Diponegoro 03 Karangklesem. Semua Hak Dilindungi.
                </p>
            </div>
        </div>
    </footer>

    <!-- Floating Buttons -->
    <a href="#" class="floating-btn">
        <i class="fab fa-whatsapp"></i>
    </a>
    <a href="#home" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- Gallery Modal -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalLabel">Galeri Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="" class="img-fluid rounded" id="modalImage" alt="">
                    <p class="mt-3 fw-bold" id="modalCaption"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Counter animation
        const counters = document.querySelectorAll('.counter');
        const speed = 200;

        function animateCounters() {
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / speed;

                if (count < target) {
                    const updateCount = () => {
                        const current = +counter.innerText;
                        if (current < target) {
                            counter.innerText = Math.ceil(current + increment);
                            setTimeout(updateCount, 1);
                        } else {
                            counter.innerText = target;
                        }
                    };
                    updateCount();
                }
            });
        }

        // Run counters when section is in view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });

        const counterSection = document.querySelector('#about');
        if (counterSection) {
            observer.observe(counterSection);
        }

        // Gallery modal
        const galleryModal = document.getElementById('galleryModal');
        if (galleryModal) {
            galleryModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const imgSrc = button.getAttribute('data-bs-img');
                const caption = button.getAttribute('data-bs-caption');

                document.getElementById('modalImage').src = imgSrc;
                document.getElementById('modalCaption').textContent = caption;
            });
        }

        // Logo animation
        const logo = document.getElementById('logo');
        if (logo) {
            logo.addEventListener('mouseover', function() {
                this.style.transform = 'rotate(15deg)';
            });

            logo.addEventListener('mouseout', function() {
                this.style.transform = 'rotate(0)';
            });
        }

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            const backToTop = document.querySelector('.back-to-top');

            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
                backToTop.classList.add('active');
            } else {
                navbar.classList.remove('scrolled');
                backToTop.classList.remove('active');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 70,
                        behavior: 'smooth'
                    });

                    // Update URL without page jump
                    if (history.pushState) {
                        history.pushState(null, null, targetId);
                    } else {
                        location.hash = targetId;
                    }
                }
            });
        });

        const sections = document.querySelectorAll('section');
        const navLinks = document.querySelectorAll('.nav-link');

        window.addEventListener('scroll', function() {
            let current = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop - 120;
                const sectionHeight = section.clientHeight;

                if (pageYOffset >= sectionTop && pageYOffset < sectionTop + sectionHeight) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                const href = link.getAttribute('href');
                if (href && href.includes(current)) {
                    link.classList.add('active');
                }
            });
        });
        
        // Auto close navbar when clicking on mobile
        const navbarToggler = document.querySelector('.navbar-toggler');
        const navbarCollapse = document.querySelector('.navbar-collapse');

        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (navbarCollapse.classList.contains('show')) {
                    navbarToggler.click();
                }
            });
        });

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Improved mobile menu handling
        function handleMobileMenu() {
            if (window.innerWidth < 992) {
                document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
                    toggle.setAttribute('data-bs-toggle', 'dropdown');
                });
            } else {
                document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
                    toggle.removeAttribute('data-bs-toggle');
                });
            }
        }

        // Run on load and resize
        window.addEventListener('load', handleMobileMenu);
        window.addEventListener('resize', handleMobileMenu);

        // Lazy loading for images
        if ('IntersectionObserver' in window) {
            const lazyImageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.classList.remove('lazy');
                        lazyImageObserver.unobserve(lazyImage);
                    }
                });
            });

            document.querySelectorAll('img.lazy').forEach(lazyImage => {
                lazyImageObserver.observe(lazyImage);
            });
        }
    </script>
    {{-- @stack('scripts') --}}
</body>

</html>