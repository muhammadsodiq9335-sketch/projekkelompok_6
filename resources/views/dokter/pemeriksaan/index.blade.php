@extends('layouts.modern')

@section('title', 'Pemeriksaan Dokter')
@section('header-title', 'Daftar Pasien (Dari Perawat)')
@section('breadcrumb', 'Pemeriksaan')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-custom">
                <div class="card-header-custom bg-primary text-white">
                    <i class="fas fa-user-md me-2"></i>Antrian Pasien Siap Periksa
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">No Antrian</th>
                                    <th class="py-3">Nama Pasien</th>
                                    <th class="py-3">Vital Signs (Perawat)</th>
                                    <th class="py-3">Status</th>
                                    <th class="px-4 py-3 text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($antrianPasien as $item)
                                    <tr>
                                        <td class="px-4 fw-bold text-primary">{{ $item->no_antrian }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $item->pasien->nama_lengkap ?? $item->pasien->nama }}</div>
                                            <small class="text-muted">{{ $item->pasien->no_rm }}</small>
                                        </td>
                                        <td>
                                            @if($item->vitalSign)
                                                <span class="badge bg-info text-dark">
                                                    TD: {{ $item->vitalSign->tekanan_darah }} | 
                                                    S: {{ $item->vitalSign->suhu }}°C
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">Belum ada data</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-warning text-dark">Menunggu Dokter</span>
                                        </td>
                                        <td class="px-4 text-end">
                                            <a href="{{ route('dokter.pemeriksaan.create', $item->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-stethoscope me-1"></i> Periksa
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="fas fa-clipboard-check fa-3x mb-3 text-light"></i>
                                            <p>Tidak ada pasien yang menunggu pemeriksaan.</p>
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
