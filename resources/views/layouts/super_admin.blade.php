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
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --sidebar-width: 280px;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: 1px solid rgba(255, 255, 255, 0.2);
            --card-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            overflow-x: hidden;
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--primary-gradient);
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
            box-shadow: 4px 0 24px rgba(0,0,0,0.1);
        }
        
        .sidebar-header {
            padding: 2rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            color: white;
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: -0.5px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
        }
        
        .sidebar-menu {
            padding: 1.5rem 1rem;
            list-style: none;
            margin: 0;
        }
        
        .menu-item {
            margin-bottom: 0.5rem;
        }
        
        .menu-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.25rem;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 12px;
            font-size: 0.95rem;
        }
        
        .menu-link:hover {
            color: white;
            background-color: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        
        .menu-link.active {
            background-color: white;
            color: #764ba2;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .menu-icon {
            width: 1.5rem;
            margin-right: 0.75rem;
            text-align: center;
            font-size: 1.1rem;
        }
        
        .menu-arrow {
            margin-left: auto;
            font-size: 0.8rem;
            transition: transform 0.3s;
            opacity: 0.7;
        }
        
        .menu-link[aria-expanded="true"] .menu-arrow {
            transform: rotate(90deg);
            opacity: 1;
        }
        
        /* Submenu */
        .submenu {
            list-style: none;
            padding-left: 0;
            margin: 0.5rem 0 1rem 0;
            background-color: rgba(0,0,0,0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        
        .submenu-link {
            padding: 0.75rem 1.5rem 0.75rem 3.5rem;
            display: block;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        
        .submenu-link:hover {
            color: white;
            background: rgba(255,255,255,0.05);
            padding-left: 3.75rem;
        }

        .submenu-link.active {
            color: white;
            font-weight: 600;
            background: rgba(255,255,255,0.1);
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f8fafc;
        }
        
        .top-navbar {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            height: 80px;
            padding: 0 2.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 900;
            border-bottom: var(--glass-border);
        }
        
        .content-wrapper {
            padding: 2.5rem;
            flex: 1;
        }

        /* Card Styles */
        .card {
            background: white;
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.1);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1.5rem;
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
            <span>SI-KIA DEFISSA</span>
        </div>
        
        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="{{ route('super_admin.dashboard') }}" class="menu-link {{ request()->routeIs('super_admin.dashboard') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="fas fa-tachometer-alt"></i></span>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="#menuMaster" data-bs-toggle="collapse" class="menu-link {{ request()->routeIs('super_admin.dokter.*') || request()->routeIs('super_admin.petugas.*') || request()->routeIs('super_admin.perawat.*') || request()->routeIs('super_admin.apoteker.*') ? '' : 'collapsed' }}" aria-expanded="{{ request()->routeIs('super_admin.dokter.*') || request()->routeIs('super_admin.petugas.*') || request()->routeIs('super_admin.perawat.*') || request()->routeIs('super_admin.apoteker.*') ? 'true' : 'false' }}">
                    <span class="menu-icon"><i class="fas fa-database"></i></span>
                    <span>Master Data</span>
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
                <div class="collapse {{ request()->routeIs('super_admin.dokter.*') || request()->routeIs('super_admin.petugas.*') || request()->routeIs('super_admin.perawat.*') || request()->routeIs('super_admin.apoteker.*') ? 'show' : '' }}" id="menuMaster">
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
                        <li class="submenu-item">
                            <a href="{{ route('super_admin.apoteker.index') }}" class="submenu-link {{ request()->routeIs('super_admin.apoteker.*') ? 'text-white' : '' }}">Data Apoteker</a>
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
                        <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
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
