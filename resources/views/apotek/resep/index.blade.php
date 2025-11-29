@extends('layouts.modern')

@section('title', 'Antrian Resep - Apotek')
@section('header-title', 'Antrian Resep')
@section('breadcrumb', 'Apotek / Antrian Resep')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-custom">
                <div class="card-header-custom bg-primary text-white">
                    <i class="fas fa-prescription-bottle-alt me-2"></i>Antrian Resep Masuk
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">No. RM</th>
                                    <th class="px-4 py-3">Nama Pasien</th>
                                    <th class="px-4 py-3">Dokter</th>
                                    <th class="px-4 py-3">Waktu</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3 text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($resep as $item)
                                <tr>
                                    <td class="px-4 py-3">{{ $item->pendaftaran->pasien->no_rekam_medis }}</td>
                                    <td class="px-4 py-3">{{ $item->pendaftaran->pasien->nama }}</td>
                                    <td class="px-4 py-3">{{ $item->dokter->name }}</td>
                                    <td class="px-4 py-3">{{ $item->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-4 py-3"><span class="badge bg-warning">Menunggu</span></td>
                                    <td class="px-4 py-3 text-end">
                                        <a href="{{ route('apotek.resep.show', $item) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye me-1"></i> Lihat & Proses
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <i class="fas fa-clipboard-check fa-3x mb-3 text-light"></i>
                                        <p>Tidak ada antrian resep saat ini</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0">
                    {{ $resep->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
