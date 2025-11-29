@extends('layouts.modern')

@section('title', 'Manajemen Obat - Apotek')
@section('header-title', 'Data Obat')
@section('breadcrumb', 'Apotek / Data Obat')

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
                <div class="card-header-custom d-flex justify-content-between align-items-center bg-white">
                    <h5 class="mb-0 text-secondary"><i class="fas fa-pills me-2"></i>Daftar Obat</h5>
                    <a href="{{ route('apotek.obat.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i> Tambah Obat
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">Kode</th>
                                    <th class="px-4 py-3">Nama Obat</th>
                                    <th class="px-4 py-3">Jenis</th>
                                    <th class="px-4 py-3">Stok</th>
                                    <th class="px-4 py-3">Harga</th>
                                    <th class="px-4 py-3">Satuan</th>
                                    <th class="px-4 py-3 text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($obat as $item)
                                <tr>
                                    <td class="px-4 py-3 font-monospace">{{ $item->kode_obat }}</td>
                                    <td class="px-4 py-3 fw-bold">{{ $item->nama_obat }}</td>
                                    <td class="px-4 py-3">{{ $item->jenis }}</td>
                                    <td class="px-4 py-3">
                                        <span class="badge {{ $item->stok < 10 ? 'bg-danger' : 'bg-success' }}">
                                            {{ $item->stok }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3">{{ $item->satuan }}</td>
                                    <td class="px-4 py-3 text-end">
                                        <a href="{{ route('apotek.obat.edit', $item) }}" class="btn btn-sm btn-warning text-white me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('apotek.obat.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">
                                        <i class="fas fa-box-open fa-3x mb-3 text-light"></i>
                                        <p>Belum ada data obat</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0">
                    {{ $obat->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
