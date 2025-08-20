<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MI Diponegoro 03 Karangklesem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2e7d32;
            --primary-light: #4caf50;
            --primary-lighter: #81c784;
            --primary-dark: #1b5e20;
            --secondary-color: #ffffff;
            --accent-color: #8bc34a;
            --light-bg: #f5f7fa;
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 80px;
            --header-height: 70px;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            overflow-x: hidden;
            min-height: 100vh;
            padding-top: var(--header-height);
            color: #333;
        }

        /* Header Styles */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: flex;
            align-items: center;
            padding: 0 20px;
            transition: var(--transition);
        }

        .header-brand {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .header-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .header-toggler {
            color: white;
            font-size: 1.5rem;
            margin-right: 20px;
            cursor: pointer;
            transition: var(--transition);
            background: none;
            border: none;
            padding: 5px;
        }

        .header-toggler:hover {
            transform: rotate(90deg);
            color: var(--primary-lighter);
        }

        .header-nav {
            margin-left: auto;
            display: flex;
            align-items: center;
        }

        .user-dropdown {
            position: relative;
        }

        .user-btn {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            padding: 5px 10px 5px 5px;
            color: white;
            cursor: pointer;
            transition: var(--transition);
            border: none;
        }

        .user-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .user-name {
            font-weight: 500;
            margin-right: 5px;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            margin-top: 10px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .dropdown-item {
            padding: 8px 15px;
            transition: var(--transition);
            display: flex;
            align-items: center;
        }

        .dropdown-item i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }

        .dropdown-item:hover {
            background-color: rgba(46, 125, 50, 0.1);
            color: var(--primary-color);
        }

        .dropdown-divider {
            margin: 5px 0;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: var(--header-height);
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - var(--header-height));
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            z-index: 900;
            overflow-y: auto;
        }

        .sidebar-collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-menu {
            list-style: none;
            padding: 15px 0;
            margin: 0;
        }

        .menu-title {
            padding: 10px 20px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 15px;
            transition: var(--transition);
        }

        .sidebar-collapsed .menu-title {
            opacity: 0;
            height: 0;
            padding: 0;
            margin: 0;
            overflow: hidden;
        }

        .menu-item {
            position: relative;
        }

        .menu-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #495057;
            text-decoration: none;
            transition: var(--transition);
            border-left: 3px solid transparent;
        }

        .menu-link:hover,
        .menu-link.active {
            background-color: rgba(46, 125, 50, 0.1);
            color: var(--primary-color);
            border-left-color: var(--primary-color);
        }

        .menu-icon {
            font-size: 1.2rem;
            margin-right: 15px;
            width: 24px;
            text-align: center;
            transition: var(--transition);
            color: var(--primary-color);
        }

        .sidebar-collapsed .menu-icon {
            margin-right: 0;
            font-size: 1.3rem;
        }

        .menu-text {
            transition: var(--transition);
        }

        .sidebar-collapsed .menu-text {
            opacity: 0;
            width: 0;
            height: 0;
            overflow: hidden;
        }

        .menu-badge {
            margin-left: auto;
            background-color: var(--primary-color);
            color: white;
            font-size: 0.7rem;
            padding: 3px 6px;
            border-radius: 10px;
        }

        .sidebar-collapsed .menu-badge {
            display: none;
        }

        .submenu {
            list-style: none;
            padding-left: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background-color: rgba(46, 125, 50, 0.05);
        }

        .submenu.show {
            max-height: 500px;
        }

        .submenu-item .menu-link {
            padding-left: 50px;
            font-size: 0.9rem;
        }

        .sidebar-collapsed .submenu-item .menu-link {
            padding-left: 20px;
        }

        .menu-arrow {
            margin-left: auto;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .menu-item.active .menu-arrow {
            transform: rotate(90deg);
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: var(--transition);
            min-height: calc(100vh - var(--header-height));
        }

        .sidebar-collapsed+.main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-dark);
            margin: 0;
            display: flex;
            align-items: center;
        }

        .page-title i {
            margin-right: 10px;
            color: var(--primary-color);
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .breadcrumb-item a {
            color: #6c757d;
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumb-item a:hover {
            color: var(--primary-color);
        }

        .breadcrumb-item.active {
            color: var(--primary-dark);
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: ">";
            color: #6c757d;
            padding: 0 5px;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            margin-bottom: 20px;
            transition: var(--transition);
            background-color: white;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 15px 20px;
            border-radius: 12px 12px 0 0 !important;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .card-title {
            font-weight: 600;
            margin: 0;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
        }

        .card-title i {
            margin-right: 10px;
            color: var(--primary-color);
        }

        .card-body {
            padding: 20px;
        }

        /* Stats Cards */
        .stats-card {
            text-align: center;
            padding: 25px 15px;
            border-radius: 12px;
            color: white;
            position: relative;
            overflow: hidden;
            transition: var(--transition);
            cursor: pointer;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-card::after {
            content: "";
            position: absolute;
            top: -20px;
            right: -20px;
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
        }

        .stats-card .icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            opacity: 0.9;
        }

        .stats-card .count {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stats-card .label {
            font-size: 0.9rem;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stats-card-1 {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        }

        .stats-card-2 {
            background: linear-gradient(135deg, #1b5e20, #2e7d32);
        }

        .stats-card-3 {
            background: linear-gradient(135deg, #4caf50, #81c784);
        }

        .stats-card-4 {
            background: linear-gradient(135deg, #388e3c, #43a047);
        }

        /* Progress Cards */
        .progress-card {
            padding: 20px;
            border-radius: 10px;
            background: white;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .progress-card-title {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
        }

        .progress-card-title i {
            margin-right: 10px;
            color: var(--primary-color);
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .progress {
            height: 8px;
            border-radius: 4px;
            background-color: #e9ecef;
        }

        .progress-bar {
            background-color: var(--primary-color);
            border-radius: 4px;
        }

        /* Recent Activities */
        .activity-list {
            max-height: 400px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .activity-item {
            position: relative;
            padding-left: 25px;
            margin-bottom: 20px;
        }

        .activity-item:last-child {
            margin-bottom: 0;
        }

        .activity-item::before {
            content: "";
            position: absolute;
            left: 8px;
            top: 0;
            bottom: -20px;
            width: 2px;
            background-color: rgba(46, 125, 50, 0.2);
        }

        .activity-item:last-child::before {
            display: none;
        }

        .activity-dot {
            position: absolute;
            left: 0;
            top: 5px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background-color: var(--primary-color);
            border: 3px solid white;
            z-index: 1;
        }

        .activity-content {
            background: white;
            padding: 12px 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .activity-title {
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--primary-dark);
        }

        .activity-text {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .activity-time {
            font-size: 0.8rem;
            color: #adb5bd;
        }

        /* Quick Links */
        .quick-links {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .quick-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 10px;
            background: white;
            border-radius: 10px;
            text-decoration: none;
            color: var(--primary-dark);
            transition: var(--transition);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .quick-link:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            color: var(--primary-color);
        }

        .quick-link-icon {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--primary-color);
        }

        .quick-link-text {
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* Button Styles */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 500;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-icon i {
            margin-right: 8px;
        }

        /* Footer Styles */
        .footer {
            text-align: center;
            padding: 15px;
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: auto;
            background-color: white;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-collapsed {
                width: var(--sidebar-width);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar-collapsed+.main-content {
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {
            .header-brand span {
                display: none;
            }

            .user-name {
                display: none;
            }

            .user-btn {
                padding: 5px;
            }

            .stats-card {
                padding: 20px 10px;
            }

            .stats-card .count {
                font-size: 1.5rem;
            }

            .quick-links {
                grid-template-columns: 1fr;
            }
        }

        /* Animation */
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

        .animate-fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-light);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <button class="header-toggler" id="sidebarToggler">
            <i class="fas fa-bars"></i>
        </button>

        <a href="#" class="header-brand">
            <img src="{{ asset('gambar/logobaru.png') }}" alt="MI Diponegoro 03" style="height: 50px; width: auto;">
            <span>MI Diponegoro 03 Karangklesem</span>
        </a>

        <nav class="header-nav">
            <div class="user-dropdown">
                <button class="user-btn" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name=Admin+MI&background=4caf50&color=fff" alt="User"
                        class="user-avatar">
                    <span class="user-name">Admin MI</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profil</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Pengaturan</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">

                            <a class="dropdown-item" href="{{ route('login') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <ul class="sidebar-menu">
            <li class="menu-title">Menu Utama</li>
            <li class="menu-item">
                <a href="#" class="menu-link active">
                    <i class="fas fa-tachometer-alt menu-icon"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            <li class="menu-title">Manajemen Data</li>
            <li class="menu-item">
                <a href="#pendaftaranSubmenu" class="menu-link" data-bs-toggle="collapse">
                    <i class="fas fa-user-graduate menu-icon"></i>
                    <span class="menu-text">Pendaftaran Siswa</span>
                    <i class="fas fa-angle-down menu-arrow"></i>
                </a>
                <ul class="submenu collapse show" id="pendaftaranSubmenu">
                    <li class="submenu-item">
                        <a href="{{ route('admin.datasiswa.index') }}" class="menu-link active">
                            <i class="fas fa-circle-notch me-1" style="font-size: 8px;"></i>
                            <span class="menu-text">Data Calon Siswa</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{ route('admin.seleksisiswa.index') }}" class="menu-link">
                            <i class="fas fa-circle-notch me-1" style="font-size: 8px;"></i>
                            <span class="menu-text">Seleksi Penerimaan</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{ route('admin.calonsiswa.index') }}" class="menu-link">
                            <i class="fas fa-circle-notch me-1" style="font-size: 8px;"></i>
                            <span class="menu-text">Form Pendaftaran</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.dataguru.index') }}" class="menu-link">
                    <i class="fas fa-chalkboard-teacher menu-icon"></i>
                    <span class="menu-text">Data Guru</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.saranaprasarana.index') }}" class="menu-link">
                    <i class="fas fa-school menu-icon"></i>
                    <span class="menu-text">Sarana Prasarana</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.prestasisiswa.index') }}" class="menu-link">
                    <i class="fas fa-trophy menu-icon"></i>
                    <span class="menu-text">Prestasi Siswa</span>
                </a>
            </li>

            <li class="menu-title">Informasi Madrasah</li>
            <li class="menu-item">
                <a href="{{ route('admin.visimisi.index') }}" class="menu-link">
                    <i class="fas fa-bullseye menu-icon"></i>
                    <span class="menu-text">Visi & Misi</span>
                </a>

            </li>

            <li class="menu-item">
                <a href="{{ route('admin.sejarah.index') }}" class="menu-link">
                    <i class="fas fa-history menu-icon"></i>
                    <span class="menu-text">Sejarah Madrasah</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('admin.pendidikan.index') }}" class="menu-link">
                    <i class="fas fa-graduation-cap menu-icon"></i>
                    <span class="menu-text">Pendidikan</span>
                </a>
            </li>

            <li class="menu-title">Konten Website</li>
            <li class="menu-item">
                <a href="{{ route('admin.berita.index') }}" class="menu-link">
                    <i class="fas fa-newspaper menu-icon"></i>
                    <span class="menu-text">Berita</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('admin.galerikegiatan.index') }}" class="menu-link">
                    <i class="fas fa-images menu-icon"></i>
                    <span class="menu-text">Galeri Kegiatan</span>
                </a>
            </li>

            <li class="menu-title">Lainnya</li>
            <li class="menu-item">
                <a href="{{ route('admin.kritiksaran.index') }}" class="menu-link">
                    <i class="fas fa-comment-dots menu-icon"></i>
                    <span class="menu-text">Kritik & Saran</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class="fas fa-info-circle menu-icon"></i>
                    <span class="menu-text">Info PPDB</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">
            @yield('content')
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>

            <!-- Stats Cards -->
            <div class="row animate-fade-in">
                <div class="col-md-6 col-lg-3">
                    <div class="card stats-card stats-card-1">
                        <div class="card-body">
                            <i class="fas fa-users icon"></i>
                            <div class="count">245</div>
                            <div class="label">Total Siswa</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card stats-card stats-card-2">
                        <div class="card-body">
                            <i class="fas fa-chalkboard-teacher icon"></i>
                            <div class="count">24</div>
                            <div class="label">Total Guru</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card stats-card stats-card-3">
                        <div class="card-body">
                            <i class="fas fa-trophy icon"></i>
                            <div class="count">18</div>
                            <div class="label">Prestasi</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card stats-card stats-card-4">
                        <div class="card-body">
                            <i class="fas fa-calendar-check icon"></i>
                            <div class="count">5</div>
                            <div class="label">Kegiatan Terbaru</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="row mt-4 animate-fade-in" style="animation-delay: 0.2s;">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fas fa-bolt"></i> Akses Cepat</h5>
                        </div>
                        <div class="card-body">
                            <div class="quick-links">
                                <a href="#" class="quick-link">
                                    <div class="quick-link-icon"><i class="fas fa-user-plus"></i></div>
                                    <div class="quick-link-text">Tambah Siswa</div>
                                </a>
                                <a href="#" class="quick-link">
                                    <div class="quick-link-icon"><i class="fas fa-file-invoice"></i></div>
                                    <div class="quick-link-text">Laporan Bulanan</div>
                                </a>
                                <a href="#" class="quick-link">
                                    <div class="quick-link-icon"><i class="fas fa-calendar-plus"></i></div>
                                    <div class="quick-link-text">Jadwal Baru</div>
                                </a>
                                <a href="#" class="quick-link">
                                    <div class="quick-link-icon"><i class="fas fa-bullhorn"></i></div>
                                    <div class="quick-link-text">Pengumuman</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress and Activities -->
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="card animate-fade-in" style="animation-delay: 0.3s;">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fas fa-chart-line"></i> Statistik Pendaftaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="progress-card">
                                <div class="progress-card-title"><i class="fas fa-male"></i> Pendaftar Laki-laki</div>
                                <div class="progress-info">
                                    <span>45 Siswa</span>
                                    <span>75% dari target</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 75%"></div>
                                </div>
                            </div>

                            <div class="progress-card">
                                <div class="progress-card-title"><i class="fas fa-female"></i> Pendaftar Perempuan
                                </div>
                                <div class="progress-info">
                                    <span>38 Siswa</span>
                                    <span>63% dari target</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 63%"></div>
                                </div>
                            </div>

                            <div class="progress-card">
                                <div class="progress-card-title"><i class="fas fa-check-circle"></i> Siswa Diterima
                                </div>
                                <div class="progress-info">
                                    <span>62 Siswa</span>
                                    <span>82% dari pendaftar</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 82%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card animate-fade-in" style="animation-delay: 0.4s;">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fas fa-bell"></i> Aktivitas Terkini</h5>
                        </div>
                        <div class="card-body">
                            <div class="activity-list">
                                <div class="activity-item">
                                    <div class="activity-dot"></div>
                                    <div class="activity-content">
                                        <h6 class="activity-title">Pendaftaran Baru</h6>
                                        <p class="activity-text">Ahmad Fauzi mendaftar sebagai siswa baru</p>
                                        <small class="activity-time">10 menit yang lalu</small>
                                    </div>
                                </div>

                                <div class="activity-item">
                                    <div class="activity-dot"></div>
                                    <div class="activity-content">
                                        <h6 class="activity-title">Penerimaan Siswa</h6>
                                        <p class="activity-text">Siti Aminah diterima di kelas 1</p>
                                        <small class="activity-time">1 jam yang lalu</small>
                                    </div>
                                </div>

                                <div class="activity-item">
                                    <div class="activity-dot"></div>
                                    <div class="activity-content">
                                        <h6 class="activity-title">Prestasi</h6>
                                        <p class="activity-text">Budi Santoso memenangkan lomba MTQ</p>
                                        <small class="activity-time">3 jam yang lalu</small>
                                    </div>
                                </div>

                                <div class="activity-item">
                                    <div class="activity-dot"></div>
                                    <div class="activity-content">
                                        <h6 class="activity-title">Kritik & Saran</h6>
                                        <p class="activity-text">Orang tua mengirim masukan baru</p>
                                        <small class="activity-time">5 jam yang lalu</small>
                                    </div>
                                </div>

                                <div class="activity-item">
                                    <div class="activity-dot"></div>
                                    <div class="activity-content">
                                        <h6 class="activity-title">Kegiatan Baru</h6>
                                        <p class="activity-text">Pembagian rapor semester ganjil</p>
                                        <small class="activity-time">Kemarin, 15:30</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">
            <p class="mb-0">&copy; <span id="current-year">{{ date('Y') }}</span> MI Diponegoro 03 Karangklesem.
                All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
        // Sidebar Toggle
        document.getElementById('sidebarToggler').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('sidebar-collapsed');

            // Toggle icon between bars and times
            const icon = this.querySelector('i');
            if (icon.classList.contains('fa-bars')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        // Mobile sidebar toggle
        if (window.innerWidth < 992) {
            document.getElementById('sidebar').classList.add('sidebar-collapsed');

            document.getElementById('sidebarToggler').addEventListener('click', function() {
                document.getElementById('sidebar').classList.toggle('show');
            });
        }

        // Update current year
        document.getElementById('current-year').textContent = new Date().getFullYear();

        // Submenu toggle
        const menuItems = document.querySelectorAll('.menu-item > a[data-bs-toggle="collapse"]');
        menuItems.forEach(item => {
            item.addEventListener('click', function(e) {
                if (window.innerWidth < 992) {
                    e.preventDefault();
                    const submenu = this.nextElementSibling;
                    submenu.classList.toggle('show');

                    // Toggle arrow icon
                    const arrow = this.querySelector('.menu-arrow');
                    if (submenu.classList.contains('show')) {
                        arrow.classList.remove('fa-angle-down');
                        arrow.classList.add('fa-angle-up');
                    } else {
                        arrow.classList.remove('fa-angle-up');
                        arrow.classList.add('fa-angle-down');
                    }
                }
            });
        });

        // Add active class to clicked menu item
        const menuLinks = document.querySelectorAll('.menu-link:not([data-bs-toggle="collapse"])');
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Remove active class from all menu items
                menuLinks.forEach(l => l.classList.remove('active'));

                // Add active class to clicked item
                this.classList.add('active');

                // Close sidebar on mobile after click
                if (window.innerWidth < 992) {
                    document.getElementById('sidebar').classList.remove('show');
                    document.getElementById('sidebarToggler').querySelector('i').classList.remove(
                        'fa-times');
                    document.getElementById('sidebarToggler').querySelector('i').classList.add('fa-bars');
                }
            });
        });

        // Stats card hover effect
        const statsCards = document.querySelectorAll('.stats-card');
        statsCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Quick links hover effect
        const quickLinks = document.querySelectorAll('.quick-link');
        quickLinks.forEach(link => {
            link.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.1)';
            });
            link.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 2px 10px rgba(0,0,0,0.05)';
            });
        });

        // Responsive adjustments
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                document.getElementById('sidebar').classList.remove('show');
                const icon = document.getElementById('sidebarToggler').querySelector('i');
                if (icon.classList.contains('fa-times')) {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        });
    </script>
</body>

</html>
