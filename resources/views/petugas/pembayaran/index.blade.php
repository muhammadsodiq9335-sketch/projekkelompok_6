@extends('layouts.modern')

@section('title', 'Kasir / Pembayaran')
@section('header-title', 'Kasir / Pembayaran')
@section('breadcrumb', 'Kasir')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="card-title mb-0">Antrian Pembayaran</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No. Antrian</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftarans as $p)
                    <tr>
                        <td><span class="badge bg-primary">{{ $p->no_antrian }}</span></td>
                        <td>
                            <div class="fw-bold">{{ $p->pasien->nama }}</div>
                            <small class="text-muted">{{ $p->pasien->no_rm }}</small>
                        </td>
                        <td>{{ $p->dokter->name ?? '-' }}</td>
                        <td><span class="badge bg-warning text-dark">{{ $p->status }}</span></td>
                        <td>
                            <a href="{{ route('petugas.pembayaran.create', $p->id) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-cash-register me-1"></i> Proses Bayar
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            <i class="fas fa-check-circle fa-3x mb-3 d-block text-success"></i>
                            Tidak ada antrian pembayaran
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
