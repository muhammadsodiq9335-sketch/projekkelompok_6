@extends('layouts.modern')

@section('title', 'Dashboard Dokter')
@section('header-title', 'Dashboard Dokter')
@section('breadcrumb', 'Dashboard')

@section('content')
    <div class="row g-4 mb-4">
        <!-- Card 1 -->
        <div class="col-md-4">
            <div class="stat-card blue">
                <div class="stat-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ $antrianMenunggu->count() ?? 0 }}</h3>
                    <p>Pasien Menunggu</p>
                </div>
            </div>
        </div>
        
        <!-- Card 2 -->
        <div class="col-md-4">
            <div class="stat-card orange">
                <div class="stat-icon">
                    <i class="fas fa-check-double"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ $pasienSelesai ?? 0 }}</h3>
                    <p>Selesai Diperiksa</p>
                </div>
            </div>
        </div>
        
        <!-- Card 3 -->
        <div class="col-md-4">
            <div class="stat-card purple">
                <div class="stat-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ $totalPasienHariIni ?? 0 }}</h3>
                    <p>Total Pasien Hari Ini</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card-custom mb-4">
                <div class="card-header-custom">
                    Antrian Pasien (Siap Diperiksa)
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover m-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">No Antrian</th>
                                    <th class="px-4 py-3">Nama Pasien</th>
                                    <th class="px-4 py-3">Tanda Vital</th>
                                    <th class="px-4 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($antrianMenunggu as $item)
                                <tr>
                                    <td class="px-4 py-3"><span class="badge bg-info">{{ $item->no_antrian }}</span></td>
                                    <td class="px-4 py-3">
                                        <div class="fw-bold">{{ $item->pasien->nama_lengkap ?? $item->pasien->nama }}</div>
                                        <small class="text-muted">{{ $item->pasien->no_rekam_medis ?? $item->pasien->no_rm }}</small>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($item->vitalSigns)
                                            <span class="badge bg-success">Sudah Ada</span>
                                        @else
                                            <span class="badge bg-warning">Belum Ada</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('dokter.pemeriksaan.create', $item) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-stethoscope me-1"></i> Periksa
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Tidak ada pasien menunggu.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card-custom">
                <div class="card-header-custom">
                    Diagnosa Terbanyak
                </div>
                <div class="card-body p-4">
                    <canvas id="diagnosaChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('diagnosaChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($diagnosaTerbanyak->pluck('diagnosa_utama')) !!},
            datasets: [{
                data: {!! json_encode($diagnosaTerbanyak->pluck('total')) !!},
                backgroundColor: ['#0d6efd', '#fd7e14', '#6f42c1', '#dc3545', '#20c997'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endsection
