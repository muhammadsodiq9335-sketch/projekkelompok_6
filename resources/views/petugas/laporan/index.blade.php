@extends('layouts.modern')

@section('title', 'Laporan Kunjungan')
@section('header-title', 'Laporan Kunjungan')
@section('breadcrumb', 'Laporan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <span>Data Kunjungan Pasien</span>
                <a href="{{ route('petugas.laporan.export') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-file-excel me-2"></i>Export Excel
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover m-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">No Antrian</th>
                                <th class="px-4 py-3">No RM</th>
                                <th class="px-4 py-3">Nama Pasien</th>
                                <th class="px-4 py-3">Poliklinik</th>
                                <th class="px-4 py-3">Dokter</th>
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendaftarans as $pendaftaran)
                            <tr>
                                <td class="px-4 py-3">{{ $loop->iteration + ($pendaftarans->currentPage() - 1) * $pendaftarans->perPage() }}</td>
                                <td class="px-4 py-3"><span class="badge bg-primary">{{ $pendaftaran->no_antrian }}</span></td>
                                <td class="px-4 py-3">{{ $pendaftaran->pasien->no_rm ?? '-' }}</td>
                                <td class="px-4 py-3 fw-bold">{{ $pendaftaran->pasien->nama_lengkap ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $pendaftaran->poliklinik }}</td>
                                <td class="px-4 py-3">{{ $pendaftaran->dokter->name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $pendaftaran->tanggal_kunjungan->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">
                                    @if($pendaftaran->status == 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif($pendaftaran->status == 'menunggu')
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @elseif($pendaftaran->status == 'diperiksa')
                                        <span class="badge bg-info text-dark">Diperiksa</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($pendaftaran->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada data kunjungan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-3">
                    {{ $pendaftarans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection