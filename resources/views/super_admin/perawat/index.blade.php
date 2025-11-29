@extends('layouts.super_admin')

@section('title', 'Data Perawat')
@section('header-title', 'Data Perawat')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Perawat</h5>
        <a href="{{ route('super_admin.perawat.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Perawat
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($perawat as $p)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name={{ $p->name }}&background=random" class="rounded-circle me-2" width="32" height="32">
                                <div>
                                    <div class="fw-bold">{{ $p->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $p->nip }}</td>
                        <td>{{ $p->email }}</td>
                        <td>{{ $p->phone ?? '-' }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('super_admin.perawat.edit', $p->id) }}" class="btn btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('super_admin.perawat.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                        <td colspan="5" class="text-center py-4 text-muted">
                            <i class="fas fa-user-nurse fa-3x mb-3 d-block"></i>
                            Belum ada data perawat
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
