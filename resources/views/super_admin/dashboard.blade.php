@extends('layouts.super_admin')

@section('title', 'Dashboard Super Admin')
@section('header-title', 'Overview')

@section('content')
<!-- Hero Section -->
<div class="row mb-5">
    <div class="col-12">
        <div class="card border-0 overflow-hidden text-white" style="background: linear-gradient(120deg, #667eea 0%, #764ba2 100%);">
            <div class="card-body p-5 position-relative">
                <div class="position-absolute top-0 end-0 opacity-10" style="transform: translate(20%, -20%);">
                    <i class="fas fa-hospital-alt fa-10x"></i>
                </div>
                <div class="position-relative z-1">
                    <h2 class="fw-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                    <p class="lead mb-4 opacity-75" style="max-width: 600px;">Anda memiliki akses penuh untuk mengelola seluruh data master aplikasi. Pantau statistik dan kelola pengguna dengan mudah.</p>
                    <div class="d-flex gap-3">
                        <a href="#stats" class="btn btn-light px-4 py-2 fw-semibold text-primary shadow-sm">
                            <i class="fas fa-chart-line me-2"></i>Lihat Statistik
                        </a>
                        <a href="{{ route('super_admin.dokter.create') }}" class="btn btn-outline-light px-4 py-2 fw-semibold">
                            <i class="fas fa-plus me-2"></i>Tambah Dokter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-5" id="stats">
    <div class="col-md-4">
        <div class="card h-100 border-0">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-4" style="width: 60px; height: 60px;">
                        <i class="fas fa-user-md fa-2x text-primary"></i>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                        <i class="fas fa-arrow-up me-1"></i> Aktif
                    </span>
                </div>
                <h6 class="text-muted text-uppercase fw-bold small mb-1">Total Dokter</h6>
                <h2 class="fw-bold mb-0 display-5">{{ \App\Models\User::where('role', 'dokter')->count() }}</h2>
                <div class="mt-4 pt-3 border-top">
                    <a href="{{ route('super_admin.dokter.index') }}" class="text-decoration-none fw-semibold d-flex align-items-center text-primary">
                        Kelola Dokter <i class="fas fa-arrow-right ms-auto"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card h-100 border-0">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center justify-content-center bg-info bg-opacity-10 rounded-4" style="width: 60px; height: 60px;">
                        <i class="fas fa-user-nurse fa-2x text-info"></i>
                    </div>
                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill">
                        <i class="fas fa-users me-1"></i> Medis
                    </span>
                </div>
                <h6 class="text-muted text-uppercase fw-bold small mb-1">Total Perawat</h6>
                <h2 class="fw-bold mb-0 display-5">{{ \App\Models\User::where('role', 'perawat')->count() }}</h2>
                <div class="mt-4 pt-3 border-top">
                    <a href="{{ route('super_admin.perawat.index') }}" class="text-decoration-none fw-semibold d-flex align-items-center text-info">
                        Kelola Perawat <i class="fas fa-arrow-right ms-auto"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card h-100 border-0">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center justify-content-center bg-warning bg-opacity-10 rounded-4" style="width: 60px; height: 60px;">
                        <i class="fas fa-id-card-alt fa-2x text-warning"></i>
                    </div>
                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">
                        <i class="fas fa-clipboard-check me-1"></i> Admin
                    </span>
                </div>
                <h6 class="text-muted text-uppercase fw-bold small mb-1">Total Petugas</h6>
                <h2 class="fw-bold mb-0 display-5">{{ \App\Models\User::where('role', 'petugas')->count() }}</h2>
                <div class="mt-4 pt-3 border-top">
                    <a href="{{ route('super_admin.petugas.index') }}" class="text-decoration-none fw-semibold d-flex align-items-center text-warning">
                        Kelola Petugas <i class="fas fa-arrow-right ms-auto"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <h5 class="fw-bold mb-4 text-dark">Akses Cepat</h5>
    </div>
    <div class="col-md-3 mb-4">
        <a href="{{ route('super_admin.dokter.create') }}" class="card h-100 text-decoration-none hover-scale">
            <div class="card-body p-4 text-center">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-3 shadow-sm" style="width: 50px; height: 50px;">
                    <i class="fas fa-plus"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">Tambah Dokter</h6>
                <small class="text-muted">Input Data dokter baru</small>
            </div>
        </a>
    </div>
    <div class="col-md-3 mb-4">
        <a href="{{ route('super_admin.perawat.create') }}" class="card h-100 text-decoration-none hover-scale">
            <div class="card-body p-4 text-center">
                <div class="d-inline-flex align-items-center justify-content-center bg-info text-white rounded-circle mb-3 shadow-sm" style="width: 50px; height: 50px;">
                    <i class="fas fa-plus"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">Tambah Perawat</h6>
                <small class="text-muted">Input data perawat baru</small>
            </div>
        </a>
    </div>
    <div class="col-md-3 mb-4">
        <a href="{{ route('super_admin.petugas.create') }}" class="card h-100 text-decoration-none hover-scale">
            <div class="card-body p-4 text-center">
                <div class="d-inline-flex align-items-center justify-content-center bg-warning text-white rounded-circle mb-3 shadow-sm" style="width: 50px; height: 50px;">
                    <i class="fas fa-plus"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">Tambah Petugas</h6>
                <small class="text-muted">Input data petugas baru</small>
            </div>
        </a>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100 bg-light border-dashed">
            <div class="card-body p-4 d-flex flex-column align-items-center justify-content-center text-center">
                <div class="text-muted mb-2">
                    <i class="fas fa-cog fa-2x"></i>
                </div>
                <h6 class="fw-bold text-muted mb-0">Pengaturan Sistem</h6>
                <small class="text-muted">(Segera Hadir)</small>
            </div>
        </div>
    </div>
</div>
@endsection
