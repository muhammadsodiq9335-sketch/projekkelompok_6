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
