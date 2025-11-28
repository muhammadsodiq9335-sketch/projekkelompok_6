<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Super Admin - MediCare')</title>
    
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
            background-color: #dc3545; /* Red for Super Admin */
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
            <span>RME ADMIN</span>
        </div>
        
        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="{{ route('super_admin.dashboard') }}" class="menu-link {{ request()->routeIs('super_admin.dashboard') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="fas fa-tachometer-alt"></i></span>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="#menuMaster" data-bs-toggle="collapse" class="menu-link {{ request()->routeIs('super_admin.dokter.*') || request()->routeIs('super_admin.petugas.*') || request()->routeIs('super_admin.perawat.*') ? '' : 'collapsed' }}" aria-expanded="{{ request()->routeIs('super_admin.dokter.*') || request()->routeIs('super_admin.petugas.*') || request()->routeIs('super_admin.perawat.*') ? 'true' : 'false' }}">
                    <span class="menu-icon"><i class="fas fa-database"></i></span>
                    <span>Master Data</span>
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
                <div class="collapse {{ request()->routeIs('super_admin.dokter.*') || request()->routeIs('super_admin.petugas.*') || request()->routeIs('super_admin.perawat.*') ? 'show' : '' }}" id="menuMaster">
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="{{ route('super_admin.dokter.index') }}" class="submenu-link {{ request()->routeIs('super_admin.dokter.*') ? 'text-white' : '' }}">Data Dokter</a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{ route('super_admin.petugas.index') }}" class="submenu-link {{ request()->routeIs('super_admin.petugas.*') ? 'text-white' : '' }}">Data Petugas</a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{ route('super_admin.perawat.index') }}" class="submenu-link {{ request()->routeIs('super_admin.perawat.*') ? 'text-white' : '' }}">Data Perawat</a>
                        </li>
                    </ul>
                </div>
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
                    <div class="fw-bold text-dark">{{ Auth::user()->name ?? 'Super Admin' }}</div>
                    <div class="small text-muted">Administrator</div>
                </div>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fas fa-user-shield text-danger"></i>
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
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

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
