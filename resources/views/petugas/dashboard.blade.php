<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas - MediCare</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
        }
        
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            padding: 0.75rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .nav-link {
            color: #4b5563;
            font-weight: 500;
        }
        
        .nav-link:hover {
            color: #2563eb;
        }
        
        .main-content {
            padding: 2rem 0;
        }
        
        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.5rem;
        }
        
        .page-subtitle {
            color: #6b7280;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            height: 100%;
            transition: transform 0.2s;
            border: 1px solid #f3f4f6;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .stat-label {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }
        
        .stat-value {
            color: #111827;
            font-size: 1.875rem;
            font-weight: 700;
        }
        
        .chart-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            height: 100%;
        }
        
        .card-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .card-title-custom {
            font-size: 1.125rem;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }
        
        .list-group-item {
            border: none;
            padding: 1rem 0;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .list-group-item:last-child {
            border-bottom: none;
        }
        
        .badge-custom {
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 600;
            border-radius: 0.375rem;
        }
        
        /* Colors for icons */
        .bg-blue-soft { background-color: #eff6ff; color: #3b82f6; }
        .bg-green-soft { background-color: #f0fdf4; color: #22c55e; }
        .bg-purple-soft { background-color: #f5f3ff; color: #8b5cf6; }
        .bg-orange-soft { background-color: #fff7ed; color: #f97316; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-heartbeat text-primary"></i>
                <span>MediCare</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <span class="nav-link">Halo, {{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-4">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container main-content">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h1 class="page-title">Dashboard Overview</h1>
                <p class="page-subtitle m-0">Ringkasan aktivitas dan statistik pendaftaran hari ini.</p>
            </div>
            <div class="text-end text-muted small">
                <i class="far fa-calendar-alt me-1"></i> {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row g-4 mb-4">
            <!-- Total Pasien -->
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-soft">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-label">Total Pasien Terdaftar</div>
                    <div class="stat-value">{{ $totalPasien ?? 0 }}</div>
                </div>
            </div>
            
            <!-- Pendaftaran Hari Ini -->
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-green-soft">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div class="stat-label">Pendaftaran Hari Ini</div>
                    <div class="stat-value">{{ $pendaftaranHariIni ?? 0 }}</div>
                </div>
            </div>
            
            <!-- Menunggu -->
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-orange-soft">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-label">Pasien Menunggu</div>
                    <div class="stat-value">{{ $pendaftaranMenunggu ?? 0 }}</div>
                </div>
            </div>
            
            <!-- Pasien Baru -->
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-purple-soft">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="stat-label">Pasien Baru (Bulan Ini)</div>
                    <div class="stat-value">{{ $pasienBaru ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Column: Charts & Stats -->
            <div class="col-lg-8">
                <!-- Monthly Chart -->
                <div class="chart-card mb-4">
                    <div class="card-header-custom">
                        <h5 class="card-title-custom">Statistik Kunjungan Bulanan</h5>
                    </div>
                    <canvas id="monthlyChart" height="300"></canvas>
                </div>
            </div>

            <!-- Right Column: Details -->
            <div class="col-lg-4">
                <!-- Patient Types -->
                <div class="chart-card mb-4">
                    <div class="card-header-custom">
                        <h5 class="card-title-custom">Tipe Pasien</h5>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary p-2 me-3 text-white">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <div class="small text-muted">Umum</div>
                                <div class="fw-bold fs-5">{{ $pasienUmum ?? 0 }}</div>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-primary rounded-pill">
                                {{ ($totalPasien > 0) ? round(($pasienUmum / $totalPasien) * 100) : 0 }}%
                            </span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-success p-2 me-3 text-white">
                                <i class="fas fa-address-card"></i>
                            </div>
                            <div>
                                <div class="small text-muted">BPJS</div>
                                <div class="fw-bold fs-5">{{ $pasienBPJS ?? 0 }}</div>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-success rounded-pill">
                                {{ ($totalPasien > 0) ? round(($pasienBPJS / $totalPasien) * 100) : 0 }}%
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Polyclinic Visits -->
                <div class="chart-card">
                    <div class="card-header-custom">
                        <h5 class="card-title-custom">Kunjungan Poliklinik</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        @if(isset($kunjunganPerPoliklinik) && $kunjunganPerPoliklinik->count())
                            @foreach($kunjunganPerPoliklinik as $k)
                                <div class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 text-secondary">
                                            <i class="fas fa-clinic-medical"></i>
                                        </div>
                                        <span class="fw-medium">{{ $k->poliklinik }}</span>
                                    </div>
                                    <span class="badge bg-light text-dark border rounded-pill px-3">
                                        {{ $k->total }}
                                    </span>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted py-3">Belum ada data kunjungan</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Data for Chart
        const ctx = document.getElementById('monthlyChart').getContext('2d');
        
        // Prepare data from PHP
        const labels = {!! json_encode($statistikBulanan->pluck('tanggal')->map(function($date) { return \Carbon\Carbon::parse($date)->format('d M'); })) !!};
        const data = {!! json_encode($statistikBulanan->pluck('total')) !!};

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Kunjungan',
                    data: data,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#3b82f6',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        padding: 12,
                        titleFont: { size: 13 },
                        bodyFont: { size: 13 },
                        cornerRadius: 8,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [2, 4],
                            color: '#f3f4f6',
                            drawBorder: false
                        },
                        ticks: {
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
