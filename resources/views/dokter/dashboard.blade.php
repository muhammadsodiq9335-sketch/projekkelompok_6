@extends('layouts.modern')

@section('title', 'Dashboard Dokter')
@section('header-title', 'Dashboard Dokter')
@section('breadcrumb', 'Dashboard')

@section('content')
    <div class="row g-4 mb-4">
        <!-- Card 1: Antrian Menunggu -->
        <div class="col-md-3">
            <div class="stat-card blue">
                <div class="stat-icon">
                    <i class="fas fa-user-clock"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ $antrianMenunggu->count() ?? 0 }}</h3>
                    <p> Menunggu Antrian</p>
                </div>
            </div>
        </div>
        
        <!-- Card 2: Pemeriksaan Hari Ini -->
        <div class="col-md-3">
            <div class="stat-card green">
                <div class="stat-icon">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ $pemeriksaanHariIni ?? 0 }}</h3>
                    <p>Pemeriksaan Hari Ini</p>
                </div>
            </div>
        </div>
        
        <!-- Card 3: Total Pasien Hari Ini -->
        <div class="col-md-3">
            <div class="stat-card purple">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ $totalPasienHariIni ?? 0 }}</h3>
                    <p>Total Pasien</p>
                </div>
            </div>
        </div>
        
        <!-- Card 4: Pasien Selesai -->
        <div class="col-md-3">
            <div class="stat-card orange">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ $pasienselesai ?? 0 }}</h3>
                    <p>Pasien Selesai</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Antrian Pasien -->
        <div class="col-md-8 mb-4">
            <div class="card-custom h-100">
                <div class="card-header-custom d-flex justify-content-between align-items-center">
                    <span>Antrian Pasien</span>
                    <a href="{{ route('dokter.pemeriksaan.index') }}" class="btn btn-sm btn-light text-primary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover m-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">No Antrian</th>
                                    <th class="px-4 py-3">Nama Pasien</th>
                                    <th class="px-4 py-3">No RM</th>
                                    <th class="px-4 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($antrianMenunggu as $item)
                                <tr>
                                    <td class="px-4 py-3"><span class="badge bg-secondary">{{ $item->no_antrian }}</span></td>
                                    <td class="px-4 py-3 fw-bold">{{ $item->pasien->nama_lengkap ?? $item->pasien->nama }}</td>
                                    <td class="px-4 py-3">{{ $item->pasien->no_rekam_medis ?? $item->pasien->no_rm }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('dokter.pemeriksaan.create', $item->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-stethoscope me-1"></i> Periksa
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Tidak ada antrian pasien saat ini</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Diagnosa Terbanyak -->
        <div class="col-md-4 mb-4">
            <div class="card-custom h-100">
                <div class="card-header-custom">
                    Diagnosis Terbanyak Bulan Ini
                </div>
                <div class="card-body">
                    @if($diagnosisTerbanyak->count() > 0)
                        <div class="mb-3" style="height: 250px; position: relative;">
                            <canvas id="diagnosisChart"></canvas>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($diagnosisTerbanyak as $diagnosa)
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    {{ $diagnosa->diagnosis_utama }}
                                    <span class="badge bg-primary rounded-pill">{{ $diagnosa->total }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center text-muted my-4">Belum ada data diagnosa bulan ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Riwayat Pemeriksaan Terakhir -->
        <div class="col-md-8 mb-4">
            <div class="card-custom h-100">
                <div class="card-header-custom">
                    Pemeriksaan Terakhir
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover m-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">Tanggal</th>
                                    <th class="px-4 py-3">Nama Pasien</th>
                                    <th class="px-4 py-3">Diagnosis</th>
                                    <th class="px-4 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentPemeriksaan as $pemeriksaan)
                                <tr>
                                    <td class="px-4 py-3">{{ $pemeriksaan->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-3 fw-bold">{{ $pemeriksaan->pendaftaran->pasien->nama_lengkap ?? $pemeriksaan->pendaftaran->pasien->nama }}</td>
                                    <td class="px-4 py-3">{{ Str::limit($pemeriksaan->diagnosis_utama, 30) }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('dokter.pemeriksaan.show', $pemeriksaan->id) }}" class="btn btn-sm btn-info text-white">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Belum ada pemeriksaan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Bulanan -->
        <div class="col-md-4 mb-4">
            <div class="card-custom h-100">
                <div class="card-header-custom">
                    Statistik Bulan Ini
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover m-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-2">Tanggal</th>
                                    <th class="px-4 py-2 text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($statistikBulanan as $stat)
                                <tr>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($stat->tanggal)->format('d M Y') }}</td>
                                    <td class="px-4 py-2 text-end fw-bold">{{ $stat->total }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center py-3 text-muted small">Belum ada data.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if($diagnosisTerbanyak->count() > 0)
            const ctx = document.getElementById('diagnosisChart').getContext('2d');
            const labels = {!! json_encode($diagnosisTerbanyak->pluck('diagnosis_utama')) !!};
            const data = {!! json_encode($diagnosisTerbanyak->pluck('total')) !!};
            
            // Generate random colors
            const backgroundColors = [
                '#0d6efd', '#6610f2', '#6f42c1', '#d63384', '#dc3545', 
                '#fd7e14', '#ffc107', '#198754', '#20c997', '#0dcaf0'
            ];

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgroundColors.slice(0, data.length),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });
        @endif
    });
</script>
@endsection
