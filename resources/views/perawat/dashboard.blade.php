@extends('layouts.modern')

@section('title', 'Dashboard Perawat')
@section('header-title', 'Dashboard Perawat')
@section('breadcrumb', 'Dashboard')

@section('content')
    <div class="row g-4 mb-4">
        <!-- Card 1 -->
        <div class="col-md-4">
            <div class="stat-card blue">
                <div class="stat-icon">
                    <i class="fas fa-user-clock"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ $antrianMenunggu->count() ?? 0 }}</h3>
                    <p>Menunggu Pemeriksaan Vital Signs</p>
                </div>
            </div>
        </div>
        
        <!-- Card 2 -->
        <div class="col-md-4">
            <div class="stat-card orange">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ $sudahDiperiksa ?? 0 }}</h3>
                    <p>Sudah Diperiksa</p>
                </div>
            </div>
        </div>
        
        <!-- Card 3 -->
        <div class="col-md-4">
            <div class="stat-card purple">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ $totalPasienHariIni ?? 0 }}</h3>
                    <p>Total Pasien Hari Ini</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card-custom">
        <div class="card-header-custom">
            Antrian Pemeriksaan Vital Signs
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover m-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">No. Antrian</th>
                            <th class="px-4 py-3">Nama Pasien</th>
                            <th class="px-4 py-3">Poliklinik</th>
                            <th class="px-4 py-3">Dokter Tujuan</th>
                            <th class="px-4 py-3">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($antrianMenunggu as $item)
                        <tr>
                            <td class="px-4 py-3"><span class="badge bg-secondary">{{ $item->no_antrian }}</span></td>
                            <td class="px-4 py-3 fw-bold">{{ $item->pasien->nama_lengkap ?? $item->pasien->nama }}</td>
                            <td class="px-4 py-3">{{ $item->poliklinik }}</td>
                            <td class="px-4 py-3">{{ $item->dokter->name }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('perawat.pemeriksaan.create', $item) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-stethoscope me-1"></i> Periksa
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Tidak ada antrian pasien saat ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
