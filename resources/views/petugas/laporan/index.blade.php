@extends('layouts.modern')

@section('title', 'Laporan Kunjungan')
@section('header-title', 'Laporan Kunjungan Pasien')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-muted">Data Kunjungan Pasien</h5>
                <a href="{{ route('petugas.laporan.export') }}" class="btn btn-success">
                    <i class="fas fa-file-excel me-2"></i>Download Laporan
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>No Antrian</th>
                                <th>No RM</th>
                                <th>Nama Pasien</th>
                                <th>Poliklinik</th>
                                <th>Dokter</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendaftarans as $pendaftaran)
                            <tr>
                                <td>{{ $loop->iteration + ($pendaftarans->currentPage() - 1) * $pendaftarans->perPage() }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $pendaftaran->no_antrian }}</span></td>
                                <td>{{ $pendaftaran->pasien->no_rm ?? '-' }}</td>
                                <td class="fw-medium">{{ $pendaftaran->pasien->nama_lengkap ?? '-' }}</td>
                                <td>{{ $pendaftaran->poliklinik }}</td>
                                <td>{{ $pendaftaran->dokter->name ?? '-' }}</td>
                                <td>{{ $pendaftaran->tanggal_kunjungan->format('d/m/Y') }}</td>
                                <td>
                                    @if(strtolower($pendaftaran->status) == 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif(strtolower($pendaftaran->status) == 'menunggu')
                                        <span class="badge bg-warning text-dark">Dalam Antrian</span>
                                    @elseif(strtolower($pendaftaran->status) == 'diperiksa')
                                        <span class="badge bg-info text-dark">Diperiksa</span>
                                    @elseif(strtolower($pendaftaran->status) == 'menunggu obat')
                                        <span class="badge bg-primary">Menunggu Obat</span>
                                    @elseif(strtolower($pendaftaran->status) == 'menunggu pembayaran')
                                        <span class="badge bg-primary">Menunggu Pembayaran</span>
                                    @elseif(strtolower($pendaftaran->status) == 'batal')
                                        <span class="badge bg-danger">Batal</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $pendaftaran->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('petugas.pendaftaran.edit', $pendaftaran->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
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
                <div class="mt-3">
                    {{ $pendaftarans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection