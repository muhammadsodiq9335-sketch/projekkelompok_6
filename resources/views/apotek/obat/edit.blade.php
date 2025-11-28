@extends('layouts.modern')

@section('title', 'Edit Obat - Apotek')
@section('header-title', 'Edit Data Obat')
@section('breadcrumb', 'Apotek / Data Obat / Edit')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-custom">
                <div class="card-header-custom bg-white">
                    <h5 class="mb-0 text-secondary"><i class="fas fa-edit me-2"></i>Form Edit Obat</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('apotek.obat.update', $obat) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kode Obat</label>
                            <input type="text" name="kode_obat" class="form-control" value="{{ $obat->kode_obat }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Obat</label>
                            <input type="text" name="nama_obat" class="form-control" value="{{ $obat->nama_obat }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jenis</label>
                                <select name="jenis" class="form-select" required>
                                    <option value="Tablet" {{ $obat->jenis == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                                    <option value="Kapsul" {{ $obat->jenis == 'Kapsul' ? 'selected' : '' }}>Kapsul</option>
                                    <option value="Sirup" {{ $obat->jenis == 'Sirup' ? 'selected' : '' }}>Sirup</option>
                                    <option value="Salep" {{ $obat->jenis == 'Salep' ? 'selected' : '' }}>Salep</option>
                                    <option value="Injeksi" {{ $obat->jenis == 'Injeksi' ? 'selected' : '' }}>Injeksi</option>
                                    <option value="Alat Kesehatan" {{ $obat->jenis == 'Alat Kesehatan' ? 'selected' : '' }}>Alat Kesehatan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Satuan</label>
                                <input type="text" name="satuan" class="form-control" value="{{ $obat->satuan }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Stok</label>
                                <input type="number" name="stok" class="form-control" value="{{ $obat->stok }}" min="0" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Harga Satuan (Rp)</label>
                                <input type="number" name="harga" class="form-control" value="{{ $obat->harga }}" min="0" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between pt-3 border-top mt-3">
                            <a href="{{ route('apotek.obat.index') }}" class="btn btn-light">Kembali</a>
                            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-1"></i> Update Obat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
