@extends('layouts.modern')

@section('title', 'Tambah Obat - Apotek')
@section('header-title', 'Tambah Obat Baru')
@section('breadcrumb', 'Apotek / Data Obat / Tambah')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-custom">
                <div class="card-header-custom bg-white">
                    <h5 class="mb-0 text-secondary"><i class="fas fa-plus-circle me-2"></i>Form Tambah Obat</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('apotek.obat.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kode Obat</label>
                            <input type="text" name="kode_obat" class="form-control" required placeholder="Contoh: OBT001">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Obat</label>
                            <input type="text" name="nama_obat" class="form-control" required placeholder="Contoh: Paracetamol 500mg">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jenis Obat</label>
                                <select name="jenis" class="form-select" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    <option value="Tablet">Tablet</option>
                                    <option value="Kapsul">Kapsul</option>
                                    <option value="Sirup">Sirup</option>
                                    <option value="Salep">Salep</option>
                                    <option value="Injeksi">Injeksi</option>
                                    <option value="Alat Kesehatan">Alat Kesehatan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Satuan</label>
                                <input type="text" name="satuan" class="form-control" placeholder="Contoh: Strip, Botol, Pcs" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Stok Awal</label>
                                <input type="number" name="stok" class="form-control" min="0" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Harga Satuan (Rp)</label>
                                <input type="number" name="harga" class="form-control" min="0" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between pt-3 border-top mt-3">
                            <a href="{{ route('apotek.obat.index') }}" class="btn btn-light">Kembali</a>
                            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-1"></i> Simpan Obat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
