<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistem Rekam Medis Elektronik') }}</title>
    
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
            display: flex;
            flex-direction: column;
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
            padding: 100px 0 80px;
            text-align: center;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .hero-title {
            font-size: 48px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 20px;
            letter-spacing: -0.02em;
            line-height: 1.2;
        }
        
        .hero-subtitle {
            font-size: 20px;
            color: #64748b;
            margin-bottom: 48px;
            font-weight: 400;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .features {
            background: white;
            padding: 80px 0;
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
            padding: 32px 24px;
            height: 100%;
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
        }
        
        .feature-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            color: white;
            font-size: 28px;
            box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.3);
        }
        
        .feature-title {
            font-weight: 700;
            margin-bottom: 12px;
            font-size: 18px;
            color: #0f172a;
        }
        
        .feature-description {
            color: #64748b;
            font-size: 15px;
            line-height: 1.6;
        }
        
        .footer {
            background: #0f172a;
            color: #94a3b8;
            text-align: center;
            padding: 32px 0;
        }
        
        .footer p {
            margin: 0;
            font-size: 14px;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border: none;
            padding: 16px 48px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 18px;
            color: white;
            transition: all 0.3s;
            box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(59, 130, 246, 0.5);
            color: white;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 36px;
            }
            
            .hero-subtitle {
                font-size: 16px;
                padding: 0 20px;
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
    <div class="container hero-section">
        <h1 class="hero-title">Sistem Rekam Medis<br>Elektronik Terpadu</h1>
        <p class="hero-subtitle">Platform digital modern untuk manajemen data kesehatan yang efisien, aman, dan terintegrasi untuk pelayanan medis yang lebih baik.</p>
        
        <div>
            <a href="{{ route('login') }}" class="btn-primary-custom">
                <i class="fas fa-sign-in-alt"></i> Masuk ke Sistem
            </a>
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
                        <p class="feature-description">Sentralisasi data pasien untuk kemudahan akses dan pengelolaan rekam medis.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="feature-title">Keamanan Data</h4>
                        <p class="feature-description">Proteksi data medis dengan standar keamanan tinggi dan enkripsi.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4 class="feature-title">Analisis Cerdas</h4>
                        <p class="feature-description">Dashboard informatif untuk memantau statistik dan tren kesehatan.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4 class="feature-title">Akses Multi-Device</h4>
                        <p class="feature-description">Fleksibilitas akses sistem dari desktop, tablet, maupun smartphone.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Sistem Rekam Medis Elektronik. Developed with <i class="fas fa-heart text-danger"></i> for Healthcare.</p>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>