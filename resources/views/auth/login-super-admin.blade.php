<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Super Admin - RS PROJEK WEB 6</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
        
        .login-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .brand-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin: 0 auto 24px;
        }
        
        .login-title {
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            color: #1e293b;
            margin-bottom: 8px;
        }
        
        .login-subtitle {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 32px;
        }
        
        .form-label {
            font-weight: 500;
            color: #334155;
            font-size: 14px;
        }
        
        .form-control {
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            font-size: 14px;
        }
        
        .form-control:focus {
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
            margin-top: 24px;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
        }

        .alert {
            font-size: 14px;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 24px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="brand-icon">
            <i class="fas fa-user-shield"></i>
        </div>
        <h1 class="login-title">Login Super Admin</h1>
        <p class="login-subtitle">Silakan masuk sebagai Super Admin</p>
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@email.com">
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="••••••••">
            </div>
            
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label text-sm text-secondary" for="remember">Ingat saya</label>
            </div>
            
            <button type="submit" class="btn btn-primary">
                Masuk
            </button>
        </form>
        
        <div class="text-center mt-4">
            <a href="{{ url('/') }}" class="text-decoration-none text-secondary" style="font-size: 14px;">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
