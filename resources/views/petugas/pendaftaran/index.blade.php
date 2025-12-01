@extends('layouts.modern')

@section('title', 'Riwayat Pendaftaran - Petugas')
@section('header-title', 'Riwayat Pendaftaran')
@section('breadcrumb', 'Riwayat Pendaftaran')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Antrian & Riwayat Pendaftaran</h2>
        <a href="{{ route('petugas.pendaftaran.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Pendaftaran Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card-custom">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover m-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">No Antrian</th>
                            <th class="px-4 py-3">Waktu</th>
                            <th class="px-4 py-3">Pasien</th>
                            <th class="px-4 py-3">Poliklinik</th>
                            <th class="px-4 py-3">Dokter</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftaran as $item)
                        <tr>
                            <td class="px-4 py-3"><span class="badge bg-secondary fs-6">{{ $item->no_antrian }}</span></td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->format('d/m/Y') }} <br> <small class="text-muted">{{ $item->jam_kunjungan }}</small></td>
                            <td class="px-4 py-3">
                                <div class="fw-bold">{{ $item->pasien->nama_lengkap ?? $item->pasien->nama }}</div>
                                <small class="text-muted">{{ $item->pasien->no_rekam_medis ?? $item->pasien->no_rm }}</small>
                            </td>
                            <td class="px-4 py-3">{{ $item->poliklinik }}</td>
                            <td class="px-4 py-3">{{ $item->dokter->name }}</td>
                            <td class="px-4 py-3">
                                @if($item->status == 'Menunggu')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @elseif($item->status == 'Dipanggil')
                                    <span class="badge bg-info">Dipanggil</span>
                                @elseif($item->status == 'Menunggu Obat')
                                    <span class="badge bg-primary">Menunggu Obat</span>
                                @elseif($item->status == 'Menunggu Pembayaran')
                                    <span class="badge bg-primary">Menunggu Pembayaran</span>
                                @elseif($item->status == 'Selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($item->status == 'Batal')
                                    <span class="badge bg-danger">Batal</span>
                                @else
                                    <span class="badge bg-secondary">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-end">
                                <a href="{{ route('petugas.pendaftaran.print', $item) }}" class="btn btn-sm btn-outline-secondary" target="_blank" title="Cetak Antrian">
                                    <i class="fas fa-print"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <div class="mb-2"><i class="fas fa-clipboard-list fa-3x opacity-25"></i></div>
                                Belum ada data pendaftaran.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-top">
                {{ $pendaftaran->links() }}
            </div>
        </div>
    </div>
@endsection
