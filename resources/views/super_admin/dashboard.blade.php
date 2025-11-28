@extends('layouts.super_admin')

@section('title', 'Dashboard Super Admin')
@section('header-title', 'Dashboard')

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded">
                    <i class="fas fa-user-md fa-2x text-primary"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="text-muted mb-1">Total Dokter</h6>
                    <h3 class="mb-0">{{ \App\Models\User::where('role', 'dokter')->count() }}</h3>
                </div>
            </div>
            <div class="card-footer bg-white border-0">
                <a href="{{ route('super_admin.dokter.index') }}" class="text-decoration-none small">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-shrink-0 bg-success bg-opacity-10 p-3 rounded">
                    <i class="fas fa-user-nurse fa-2x text-success"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="text-muted mb-1">Total Perawat</h6>
                    <h3 class="mb-0">{{ \App\Models\User::where('role', 'perawat')->count() }}</h3>
                </div>
            </div>
            <div class="card-footer bg-white border-0">
                <a href="{{ route('super_admin.perawat.index') }}" class="text-decoration-none small text-success">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-shrink-0 bg-info bg-opacity-10 p-3 rounded">
                    <i class="fas fa-users fa-2x text-info"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="text-muted mb-1">Total Petugas</h6>
                    <h3 class="mb-0">{{ \App\Models\User::where('role', 'petugas')->count() }}</h3>
                </div>
            </div>
            <div class="card-footer bg-white border-0">
                <a href="{{ route('super_admin.petugas.index') }}" class="text-decoration-none small text-info">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0">Selamat Datang, Super Admin</h5>
            </div>
            <div class="card-body">
                <p>Anda memiliki akses penuh untuk mengelola data master pengguna aplikasi Rekam Medis Elektronik.</p>
                <p>Gunakan menu di sebelah kiri untuk mengelola:</p>
                <ul>
                    <li><strong>Data Dokter:</strong> Menambah, mengubah, dan menghapus data dokter.</li>
                    <li><strong>Data Petugas:</strong> Menambah, mengubah, dan menghapus data petugas pendaftaran.</li>
                    <li><strong>Data Perawat:</strong> Menambah, mengubah, dan menghapus data perawat.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
