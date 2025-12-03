@extends('layouts.modern')

@section('title', 'Antrian Pemeriksaan - Perawat')
@section('header-title', 'Antrian Pemeriksaan')
@section('breadcrumb', 'Pemeriksaan')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-custom">
                <div class="card-header-custom bg-info text-white">
                    <i class="fas fa-user-nurse me-2"></i>Antrian Pasien Pemeriksaan Vital Signs
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">No. Antrian</th>
                                    <th class="px-4 py-3">Nama Pasien</th>
                                    <th class="px-4 py-3">Poliklinik</th>
                                    <th class="px-4 py-3">Dokter Tujuan</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3 text-end">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($antrianMenunggu as $item)
                                <tr>
                                    <td class="px-4 py-3"><span class="badge bg-secondary">{{ $item->no_antrian }}</span></td>
                                    <td class="px-4 py-3">
                                        <div class="fw-bold">{{ $item->pasien->nama_lengkap ?? $item->pasien->nama }}</div>
                                        <small class="text-muted">{{ $item->pasien->no_rekam_medis ?? $item->pasien->no_rm }}</small>
                                    </td>
                                    <td class="px-4 py-3">{{ $item->poliklinik }}</td>
                                    <td class="px-4 py-3">{{ $item->dokter->name }}</td>
                                    <td class="px-4 py-3"><span class="badge bg-warning text-dark">Menunggu Perawat</span></td>
                                    <td class="px-4 py-3 text-end">
                                        <a href="{{ route('perawat.pemeriksaan.create', $item) }}" class="btn btn-info btn-sm text-white">
                                            <i class="fas fa-stethoscope me-1"></i> Periksa
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <i class="fas fa-users-slash fa-3x mb-3 text-light"></i>
                                        <p>Tidak ada pasien dalam antrean saat ini</p>
                                    </td>
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
