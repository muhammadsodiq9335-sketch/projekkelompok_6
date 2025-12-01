@extends('layouts.modern')

@section('title', 'Dashboard Petugas')
@section('header-title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
    <div class="row g-4 mb-4">
        <!-- Card 1 -->
        <div class="col-md-3">
            <div class="stat-card blue">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ $pendaftaranHariIni ?? 0 }}</h3>
                    <p>Antrian Hari Ini</p>
                </div>
            </div>
        </div>
        
        <!-- Card 2 -->
        <div class="col-md-3">
            <div class="stat-card orange">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ $totalPasien ?? 0 }}</h3>
                    <p>Total Pasien</p>
                </div>
            </div>
        </div>
        
        <!-- Card 3 -->
        <div class="col-md-3">
            <div class="stat-card purple">
                <div class="stat-icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ $poliklinikCount ?? 5 }}</h3>
                    <p>Total Poli</p>
                </div>
            </div>
        </div>
        
        <!-- Card 4 -->
        <div class="col-md-3">
            <div class="stat-card red">
                <div class="stat-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ $pendaftaranMenunggu ?? 0 }}</h3>
                    <p>Pasien Menunggu</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card-custom">
                <div class="card-header-custom">
                    <i class="fas fa-chart-bar me-2"></i>10 Besar Penyakit ({{ date('F Y') }})
                </div>
                <div class="card-body p-4">
                    <canvas id="topDiseasesChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card-custom">
        <div class="card-header-custom">
            Antrian Hari Ini
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover m-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">No Antrian</th>
                            <th class="px-4 py-3">Nama Pasien</th>
                            <th class="px-4 py-3">No RM</th>
                            <th class="px-4 py-3">Poliklinik</th>
                            <th class="px-4 py-3">Dokter</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($pendaftaran) && count($pendaftaran) > 0)
                            @foreach($pendaftaran as $item)
                            <tr>
                                <td class="px-4 py-3"><span class="badge bg-primary">{{ $item->no_antrian }}</span></td>
                                <td class="px-4 py-3 fw-bold">{{ $item->pasien->nama_lengkap ?? $item->pasien->nama }}</td>
                                <td class="px-4 py-3">{{ $item->pasien->no_rekam_medis ?? $item->pasien->no_rm }}</td>
                                <td class="px-4 py-3">{{ $item->poliklinik }}</td>
                                <td class="px-4 py-3">{{ $item->dokter->name }}</td>
                                <td class="px-4 py-3">
                                    @if($item->status == 'Menunggu')
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @elseif($item->status == 'Dipanggil')
                                        <span class="badge bg-info">Dipanggil</span>
                                    @elseif($item->status == 'Selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No data available in table</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('topDiseasesChart').getContext('2d');
            
            const labels = @json($topPenyakit->pluck('diagnosis_utama'));
            const data = @json($topPenyakit->pluck('total'));
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Kasus',
                        data: data,
                        backgroundColor: '#36a2eb',
                        borderColor: '#36a2eb',
                        borderWidth: 1,
                        barThickness: 30,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: '10 Besar Penyakit Bulan Ini',
                            font: {
                                size: 16
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
