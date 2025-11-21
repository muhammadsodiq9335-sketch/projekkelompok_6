<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistem Rekam Medis Elektronik jurkes') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: #f8f9fa;
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: #1e293b;
        }
        
        .navbar-custom {
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 1rem 0;
        }
        
        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 20px;
            color: #1e293b;
        }
        
        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }
        
        .hero-section {
            padding: 80px 0 60px;
            text-align: center;
        }
        
        .hero-title {
            font-size: 42px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 16px;
            letter-spacing: -0.02em;
        }
        
        .hero-subtitle {
            font-size: 18px;
            color: #64748b;
            margin-bottom: 60px;
            font-weight: 400;
        }
        
        .login-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            max-width: 960px;
            margin: 0 auto;
        }
        
        .login-card {
            background: white;
            border-radius: 16px;
            padding: 32px 24px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            color: inherit;
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }
        
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .login-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
            border-color: transparent;
        }
        
        .login-card:hover::before {
            opacity: 1;
        }
        
        .login-card.petugas::before {
            background: linear-gradient(90deg, #8b5cf6 0%, #7c3aed 100%);
        }
        
        .login-card.perawat::before {
            background: linear-gradient(90deg, #10b981 0%, #059669 100%);
        }
        
        .login-card.dokter::before {
            background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%);
        }
        
        .card-icon-wrapper {
            width: 64px;
            height: 64px;
            margin: 0 auto 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            transition: transform 0.3s;
        }
        
        .login-card:hover .card-icon-wrapper {
            transform: scale(1.1);
        }
        
        .login-card.petugas .card-icon-wrapper {
            background: #f5f3ff;
            color: #8b5cf6;
        }
        
        .login-card.perawat .card-icon-wrapper {
            background: #f0fdf4;
            color: #10b981;
        }
        
        .login-card.dokter .card-icon-wrapper {
            background: #fef2f2;
            color: #ef4444;
        }
        
        .card-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #0f172a;
        }
        
        .card-description {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 24px;
            line-height: 1.5;
        }
        
        .btn-login {
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            border: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            justify-content: center;
        }
        
        .btn-petugas {
            background: #8b5cf6;
            color: white;
        }
        
        .btn-petugas:hover {
            background: #7c3aed;
            color: white;
            transform: scale(1.02);
        }
        
        .btn-perawat {
            background: #10b981;
            color: white;
        }
        
        .btn-perawat:hover {
            background: #059669;
            color: white;
            transform: scale(1.02);
        }
        
        .btn-dokter {
            background: #ef4444;
            color: white;
        }
        
        .btn-dokter:hover {
            background: #dc2626;
            color: white;
            transform: scale(1.02);
        }
        
        .features {
            background: white;
            padding: 80px 0;
            margin-top: 80px;
        }
        
        .section-title {
            font-size: 32px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 48px;
            color: #0f172a;
        }
        
        .feature-card {
            text-align: center;
            padding: 24px;
        }
        
        .feature-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 24px;
        }
        
        .feature-title {
            font-weight: 700;
            margin-bottom: 12px;
            font-size: 18px;
            color: #0f172a;
        }
        
        .feature-description {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }
        
        .footer {
            background: #0f172a;
            color: #94a3b8;
            text-align: center;
            padding: 32px 0;
            margin-top: 80px;
        }
        
        .footer p {
            margin: 0;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 32px;
            }
            
            .hero-subtitle {
                font-size: 16px;
            }
            
            .login-cards {
                grid-template-columns: 1fr;
                max-width: 400px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-custom">
        <div class="container">
            <div class="brand">
                <div class="brand-icon">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <span>MediCare System</span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container">
        <div class="hero-section">
            <h1 class="hero-title">Sistem Rekam Medis Elektronik</h1>
            <p class="hero-subtitle">Platform digital terintegrasi untuk manajemen data kesehatan yang efisien</p>
            
            <div class="login-cards">
                <!-- Card Petugas -->
                <a href="{{ route('login.petugas') }}" class="login-card petugas">
                    <div class="card-icon-wrapper">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3 class="card-title">Petugas</h3>
                    <p class="card-description">Pendaftaran dan manajemen data pasien</p>
                    <button type="button" class="btn btn-login btn-petugas">
                        <i class="fas fa-sign-in-alt"></i>
                        Masuk sebagai Petugas
                    </button>
                </a>
                
                <!-- Card Perawat -->
                <a href="{{ route('login.perawat') }}" class="login-card perawat">
                    <div class="card-icon-wrapper">
                        <i class="fas fa-user-nurse"></i>
                    </div>
                    <h3 class="card-title">Perawat</h3>
                    <p class="card-description">Pemeriksaan vital signs pasien</p>
                    <button type="button" class="btn btn-login btn-perawat">
                        <i class="fas fa-sign-in-alt"></i>
                        Masuk sebagai Perawat
                    </button>
                </a>
                
                <!-- Card Dokter -->
                <a href="{{ route('login.dokter') }}" class="login-card dokter">
                    <div class="card-icon-wrapper">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h3 class="card-title">Dokter</h3>
                    <p class="card-description">Diagnosis dan resep pengobatan</p>
                    <button type="button" class="btn btn-login btn-dokter">
                        <i class="fas fa-sign-in-alt"></i>
                        Masuk sebagai Dokter
                    </button>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Features Section -->
    <div class="features">
        <div class="container">
            <h2 class="section-title">Fitur Unggulan</h2>
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h4 class="feature-title">Data Terintegrasi</h4>
                        <p class="feature-description">Semua data pasien tersimpan dalam satu sistem terpusat</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="feature-title">Keamanan Data</h4>
                        <p class="feature-description">Sistem keamanan berlapis untuk melindungi privasi pasien</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4 class="feature-title">Analisis Data</h4>
                        <p class="feature-description">Dashboard dan laporan untuk analisis kesehatan</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4 class="feature-title">Multi Platform</h4>
                        <p class="feature-description">Akses mudah dari berbagai perangkat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Sistem Rekam Medis Elektronik. Dibuat untuk tugas kuliah.</p>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>