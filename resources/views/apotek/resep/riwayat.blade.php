@extends('layouts.modern')

@section('title', 'Riwayat Resep')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Riwayat Resep Selesai</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No. RM</th>
                            <th>Nama Pasien</th>
                            <th>Dokter</th>
                            <th>Waktu Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($resep as $item)
                        <tr>
                            <td>{{ $item->pendaftaran->pasien->no_rm ?? '-' }}</td>
                            <td>{{ $item->pendaftaran->pasien->nama_lengkap ?? '-' }}</td>
                            <td>{{ $item->dokter->name ?? '-' }}</td>
                            <td>{{ $item->updated_at->format('d M Y H:i') }}</td>
                            <td><span class="badge bg-success">Selesai</span></td>
                            <td>
                                <a href="{{ route('apotek.resep.show', $item->id) }}" class="btn btn-info btn-sm text-white">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada riwayat resep.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $resep->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
