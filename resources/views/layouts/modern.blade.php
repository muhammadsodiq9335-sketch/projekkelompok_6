<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MediCare')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
            overflow-x: hidden;
        }
        
        /* Header */
        .main-header {
            background-color: #0d6efd; /* Blue Primary */
            color: white;
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .brand-logo {
            font-weight: 700;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            width: 250px;
        }
        
        /* Sidebar */
        .main-sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            bottom: 0;
            width: 250px;
            background-color: #ffffff;
            border-right: 1px solid #dee2e6;
            overflow-y: auto;
            z-index: 1020;
            padding-top: 1rem;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .menu-header {
            padding: 0.75rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .menu-item {
            margin-bottom: 0.25rem;
        }
        
        .menu-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: #495057;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        
        .menu-link:hover {
            background-color: #f8f9fa;
            color: #0d6efd;
        }
        
        .menu-link.active {
            background-color: #e7f1ff;
            color: #0d6efd;
            border-left-color: #0d6efd;
        }
        
        .menu-icon {
            width: 1.5rem;
            margin-right: 0.5rem;
            text-align: center;
            font-size: 1.1rem;
        }
        
        /* Content */
        .content-wrapper {
            margin-top: 60px;
            margin-left: 250px;
            padding: 2rem;
            min-height: calc(100vh - 60px);
        }
        
        .page-header {
            margin-bottom: 2rem;
        }
        
        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #0d6efd;
            margin-bottom: 0.25rem;
        }
        
        .breadcrumb {
            font-size: 0.875rem;
            color: #6c757d;
            margin-bottom: 0;
        }
        
        /* Cards */
        .stat-card {
            background: white;
            border-radius: 4px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            height: 100%;
            border-left: 4px solid transparent;
        }
        
        .stat-card.blue { border-left-color: #0d6efd; }
        .stat-card.orange { border-left-color: #fd7e14; }
        .stat-card.purple { border-left-color: #6f42c1; }
        .stat-card.red { border-left-color: #dc3545; }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 1rem;
            color: white;
        }
        
        .stat-card.blue .stat-icon { background-color: #0d6efd; }
        .stat-card.orange .stat-icon { background-color: #fd7e14; }
        .stat-card.purple .stat-icon { background-color: #6f42c1; }
        .stat-card.red .stat-icon { background-color: #dc3545; }
        
        .stat-details h3 {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
            line-height: 1;
        }
        
        .stat-details p {
            margin: 0;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        /* Table Card */
        .card-custom {
            background: white;
            border: none;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border-radius: 4px;
        }
        
        .card-header-custom {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #f0f0f0;
            background: white;
            font-weight: 600;
            color: #495057;
        }
        
        @media (max-width: 991.98px) {
            .main-sidebar { transform: translateX(-100%); transition: transform 0.3s; }
            .main-sidebar.show { transform: translateX(0); }
            .content-wrapper { margin-left: 0; }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <div class="brand-logo">
            <i class="fas fa-hospital-symbol"></i> RS PROJEK WEB 6
        </div>
        <button class="btn btn-link text-white d-lg-none me-auto" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <div class="ms-auto d-flex align-items-center gap-3">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'User' }}&background=random" class="rounded-circle me-2" width="32" height="32">
                    <span class="d-none d-sm-inline">{{ Auth::user()->name ?? 'User' }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="main-sidebar" id="mainSidebar">
        <div class="user-panel px-3 mb-3 d-flex align-items-center">
            <div class="image me-3">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'User' }}&background=random" class="rounded-circle" width="40" height="40">
            </div>
            <div class="info">
                <div class="d-block fw-bold text-dark">{{ Auth::user()->name ?? 'User' }}</div>
                <small class="text-muted text-uppercase">{{ Auth::user()->role ?? 'Role' }}</small>
            </div>
        </div>
        
        <ul class="sidebar-menu">
            <li class="menu-header">UTAMA</li>
            
            @if(Auth::user()->role == 'petugas')
                <li class="menu-item">
                    <a href="{{ route('petugas.dashboard') }}" class="menu-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt menu-icon"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('petugas.pendaftaran.index') }}" class="menu-link {{ request()->routeIs('petugas.pendaftaran.*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list menu-icon"></i>
                        <span>Pendaftaran</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('petugas.pasien.index') }}" class="menu-link {{ request()->routeIs('petugas.pasien.*') ? 'active' : '' }}">
                        <i class="fas fa-users menu-icon"></i>
                        <span>Data Pasien</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('petugas.laporan.index') }}" class="menu-link {{ request()->routeIs('petugas.laporan.*') ? 'active' : '' }}">
                        <i class="fas fa-file-alt menu-icon"></i>
                        <span>Laporan</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('petugas.pembayaran.index') }}" class="menu-link {{ request()->routeIs('petugas.pembayaran.*') ? 'active' : '' }}">
                        <i class="fas fa-cash-register menu-icon"></i>
                        <span>Kasir</span>
                    </a>
                </li>
            @elseif(Auth::user()->role == 'perawat')
                <li class="menu-item">
                    <a href="{{ route('perawat.dashboard') }}" class="menu-link {{ request()->routeIs('perawat.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt menu-icon"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('perawat.pemeriksaan.index') }}" class="menu-link {{ request()->routeIs('perawat.pemeriksaan.*') ? 'active' : '' }}">
                        <i class="fas fa-user-nurse menu-icon"></i>
                        <span>Antrian Pemeriksaan</span>
                    </a>
                </li>
            @elseif(Auth::user()->role == 'dokter')
                <li class="menu-item">
                    <a href="{{ route('dokter.dashboard') }}" class="menu-link {{ request()->routeIs('dokter.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt menu-icon"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('dokter.pemeriksaan.index') }}" class="menu-link {{ request()->routeIs('dokter.pemeriksaan.*') ? 'active' : '' }}">
                        <i class="fas fa-stethoscope menu-icon"></i>
                        <span>Pemeriksaan</span>
                    </a>
                </li>
            @elseif(Auth::user()->role == 'apoteker')
                <li class="menu-item">
                    <a href="{{ route('apotek.resep.index') }}" class="menu-link {{ request()->routeIs('apotek.resep.*') ? 'active' : '' }}">
                        <i class="fas fa-prescription-bottle-alt menu-icon"></i>
                        <span>Antrian Resep</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('apotek.obat.index') }}" class="menu-link {{ request()->routeIs('apotek.obat.*') ? 'active' : '' }}">
                        <i class="fas fa-pills menu-icon"></i>
                        <span>Data Obat</span>
                    </a>
                </li>
            @endif

            <li class="menu-header">LAINNYA</li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class="fas fa-calendar-alt menu-icon"></i>
                    <span>Jadwal Kegiatan</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="content-wrapper">
        <div class="page-header">
            <h1 class="page-title">@yield('header-title', 'Dashboard')</h1>
            <div class="breadcrumb">
                Home <i class="fas fa-chevron-right mx-2 small"></i> @yield('breadcrumb', 'Dashboard')
            </div>
        </div>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('mainSidebar').classList.toggle('show');
        });
    </script>
    @yield('scripts')
</body>
</html>
