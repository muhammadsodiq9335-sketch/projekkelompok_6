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
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            overflow-x: hidden;
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background-color: #1e1e2d;
            color: #a2a3b7;
            z-index: 1000;
            transition: all 0.3s;
            overflow-y: auto;
        }
        
        .sidebar-header {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: white;
            font-weight: 700;
            font-size: 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        
        .sidebar-menu {
            padding: 1rem 0;
            list-style: none;
            margin: 0;
        }
        
        .menu-item {
            margin-bottom: 0.25rem;
        }
        
        .menu-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: #a2a3b7;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        
        .menu-link:hover {
            color: white;
            background-color: rgba(255,255,255,0.03);
        }
        
        .menu-link.active {
            background-color: #009ef7; /* Bright Blue */
            color: white;
            border-radius: 0.475rem;
            margin: 0 0.75rem;
            padding: 0.75rem 1rem;
            border-left: none;
        }
        
        .menu-icon {
            width: 1.5rem;
            margin-right: 0.75rem;
            text-align: center;
        }
        
        .menu-arrow {
            margin-left: auto;
            font-size: 0.8rem;
            transition: transform 0.2s;
        }
        
        .menu-link[aria-expanded="true"] .menu-arrow {
            transform: rotate(90deg);
        }
        
        /* Submenu */
        .submenu {
            list-style: none;
            padding-left: 0;
            margin: 0;
            background-color: rgba(0,0,0,0.1);
        }
        
        .submenu-item {
            padding-left: 0;
        }
        
        .submenu-link {
            padding: 0.5rem 1.5rem 0.5rem 3.5rem;
            display: block;
            color: #888c9f;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .submenu-link:hover {
            color: white;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .top-navbar {
            background-color: white;
            height: 70px;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .content-wrapper {
            padding: 2rem;
            flex: 1;
        }
        
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-hospital-alt"></i>
            <span>RS PROJEK WEB 6</span>
        </div>
        
        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="{{ route('petugas.dashboard') }}" class="menu-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="fas fa-th-large"></i></span>
                    <span>Beranda</span>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="#menuPendaftaran" data-bs-toggle="collapse" class="menu-link {{ request()->routeIs('petugas.pendaftaran.*') ? '' : 'collapsed' }}" aria-expanded="{{ request()->routeIs('petugas.pendaftaran.*') ? 'true' : 'false' }}">
                    <span class="menu-icon"><i class="fas fa-clipboard-list"></i></span>
                    <span>Pendaftaran</span>
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
                <div class="collapse {{ request()->routeIs('petugas.pendaftaran.*') ? 'show' : '' }}" id="menuPendaftaran">
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="{{ route('petugas.pendaftaran.create') }}" class="submenu-link">Pendaftaran Baru</a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{ route('petugas.pendaftaran.index') }}" class="submenu-link">Riwayat Pendaftaran</a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <li class="menu-item">
                <a href="#menuPasien" data-bs-toggle="collapse" class="menu-link {{ request()->routeIs('petugas.pasien.*') ? '' : 'collapsed' }}" aria-expanded="{{ request()->routeIs('petugas.pasien.*') ? 'true' : 'false' }}">
                    <span class="menu-icon"><i class="fas fa-users"></i></span>
                    <span>Pasien</span>
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
                <div class="collapse {{ request()->routeIs('petugas.pasien.*') ? 'show' : '' }}" id="menuPasien">
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="{{ route('petugas.pasien.create') }}" class="submenu-link">Tambah Pasien</a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{ route('petugas.pasien.index') }}" class="submenu-link">Data Pasien</a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Placeholder Menus from Image -->
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-id-card"></i></span>
                    <span>BPJS</span>
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-clinic-medical"></i></span>
                    <span>Poliklinik</span>
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-stethoscope"></i></span>
                    <span>Pemeriksaan</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-pills"></i></span>
                    <span>Gudang Obat</span>
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('petugas.pembayaran.index') }}" class="menu-link {{ request()->routeIs('petugas.pembayaran.*') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="fas fa-cash-register"></i></span>
                    <span>Kasir</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <button class="btn btn-link d-lg-none" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <h5 class="m-0 text-muted">@yield('header-title', 'Dashboard')</h5>
            
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-sm-block">
                    <div class="fw-bold text-dark">Petugas</div>
                    <div class="small text-muted">Admin Pendaftaran</div>
                </div>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Sign out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Sidebar Toggle for Mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
    </script>
    @yield('scripts')
</body>
</html>
