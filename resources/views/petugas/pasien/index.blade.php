@extends('layouts.modern')

@section('title', 'Data Pasien - Petugas')
@section('header-title', 'Data Pasien')
@section('breadcrumb', 'Data Pasien')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Pasien</h2>
        <a href="{{ route('petugas.pasien.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus me-1"></i> Tambah Pasien
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
                    <thead class="bg-blue-100">
                        <tr>
                            <th class="px-4 py-3">No RM</th>
                            <th class="px-4 py-3">Nama Lengkap</th>
                            <th class="px-4 py-3">Jenis Kelamin</th>
                            <th class="px-4 py-3">Tanggal Lahir</th>
                            <th class="px-4 py-3">No Telepon</th>
                            <th class="px-4 py-3">Alamat</th>
                            <th class="px-4 py-3 text-end">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pasien as $p)
                        <tr>
                            <td class="px-4 py-3"><span class="badge bg-light text-dark border">{{ $p->no_rekam_medis ?? $p->no_rm }}</span></td>
                            <td class="px-4 py-3 fw-bold">{{ $p->nama_lengkap ?? $p->nama }}</td>
                            <td class="px-4 py-3">{{ $p->jenis_kelamin }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">{{ $p->no_telepon }}</td>
                            <td class="px-4 py-3 text-muted small">{{ Str::limit($p->alamat, 30) }}</td>
                            <td class="px-4 py-3 text-end">
                                <a href="{{ route('petugas.pasien.show', $p) }}" class="btn btn-sm btn-light text-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('petugas.pasien.edit', $p) }}" class="btn btn-sm btn-light text-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('petugas.pasien.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data pasien ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light text-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <div class="mb-2"><i class="fas fa-users fa-3x opacity-25"></i></div>
                                Belum ada data pasien
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-top">
                {{ $pasien->links() }}
            </div>
        </div>
    </div>
@endsection
