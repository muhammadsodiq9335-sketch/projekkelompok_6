@extends('layouts.super_admin')

@section('title', 'Data Dokter')
@section('header-title', 'Data Dokter')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Dokter</h5>
        <a href="{{ route('super_admin.dokter.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Dokter
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Spesialis</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dokters as $dokter)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name={{ $dokter->name }}&background=random" class="rounded-circle me-2" width="32" height="32">
                                <div>
                                    <div class="fw-bold">{{ $dokter->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $dokter->nip }}</td>
                        <td><span class="badge bg-info bg-opacity-10 text-info">{{ $dokter->spesialis }}</span></td>
                        <td>{{ $dokter->email }}</td>
                        <td>{{ $dokter->phone ?? '-' }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('super_admin.dokter.edit', $dokter->id) }}" class="btn btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('super_admin.dokter.destroy', $dokter->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="fas fa-user-md fa-3x mb-3 d-block"></i>
                            Belum ada data dokter
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
