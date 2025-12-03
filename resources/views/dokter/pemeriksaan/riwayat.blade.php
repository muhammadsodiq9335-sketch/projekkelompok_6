@extends('layouts.modern')

@section('title', 'Riwayat Pemeriksaan - Dokter')
@section('header-title', 'Riwayat Pemeriksaan')
@section('breadcrumb', 'Riwayat Pemeriksaan')

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
                <div class="card-header-custom bg-white">
                    <h5 class="mb-0 text-secondary"><i class="fas fa-history me-2"></i>Riwayat Pemeriksaan</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">Tanggal</th>
                                    <th class="py-3">Pasien</th>
                                    <th class="py-3">Diagnosis Utama</th>
                                    <th class="py-3">Tindakan</th>
                                    <th class="px-4 py-3 text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pemeriksaan as $item)
                                    <tr>
                                        <td class="px-4">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $item->pendaftaran->pasien->nama_lengkap ?? $item->pendaftaran->pasien->nama }}</div>
                                            <small class="text-muted">{{ $item->pendaftaran->pasien->no_rm }}</small>
                                        </td>
                                        <td>{{ $item->diagnosis_utama }}</td>
                                        <td>{{ Str::limit($item->tindakan, 50) }}</td>
                                        <td class="px-4 text-end">
                                            <a href="{{ route('dokter.pemeriksaan.show', $item->id) }}" class="btn btn-sm btn-info text-white me-1" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('dokter.pemeriksaan.edit', $item->id) }}" class="btn btn-sm btn-warning text-white me-1" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('dokter.pemeriksaan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus riwayat pemeriksaan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="fas fa-history fa-3x mb-3 text-light"></i>
                                            <p>Belum ada riwayat pemeriksaan.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0">
                    {{ $pemeriksaan->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
