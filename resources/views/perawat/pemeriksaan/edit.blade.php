@extends('layouts.modern')

@section('title', 'Edit Tanda Vital')
@section('header-title', 'Edit Tanda Vital')
@section('breadcrumb', 'Pemeriksaan / Edit Tanda Vital')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-custom">
                <div class="card-header-custom bg-warning text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-white"><i class="fas fa-edit me-2"></i>Edit Tanda Vital (Vital Signs)</h5>
                    <a href="{{ route('perawat.pemeriksaan.index') }}" class="btn btn-outline-light btn-sm">Kembali</a>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-light border mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Nama Pasien:</strong> {{ $vitalSign->pendaftaran->pasien->nama_lengkap ?? $vitalSign->pendaftaran->pasien->nama }}<br>
                                <strong>No. RM:</strong> {{ $vitalSign->pendaftaran->pasien->no_rekam_medis ?? $vitalSign->pendaftaran->pasien->no_rm }}
                            </div>
                            <div class="col-md-6">
                                <strong>Dokter Tujuan:</strong> {{ $vitalSign->pendaftaran->dokter->name }}<br>
                                <strong>Poliklinik:</strong> {{ $vitalSign->pendaftaran->poliklinik }}
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('perawat.pemeriksaan.update', $vitalSign->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tekanan Darah (mmHg)</label>
                                <input type="text" name="tekanan_darah" class="form-control @error('tekanan_darah') is-invalid @enderror" value="{{ old('tekanan_darah', $vitalSign->tekanan_darah) }}" placeholder="Contoh: 120/80" required>
                                @error('tekanan_darah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Suhu Tubuh (°C)</label>
                                <input type="number" name="suhu" class="form-control @error('suhu') is-invalid @enderror" value="{{ old('suhu', $vitalSign->suhu) }}" step="0.1" placeholder="Contoh: 36.5" required>
                                @error('suhu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nadi (denyut/menit)</label>
                                <input type="number" name="nadi" class="form-control @error('nadi') is-invalid @enderror" value="{{ old('nadi', $vitalSign->nadi) }}" placeholder="Contoh: 80" required>
                                @error('nadi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pernapasan (napas/menit)</label>
                                <input type="number" name="pernapasan" class="form-control @error('pernapasan') is-invalid @enderror" value="{{ old('pernapasan', $vitalSign->pernapasan) }}" placeholder="Contoh: 18" required>
                                @error('pernapasan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Berat Badan (kg)</label>
                                <input type="number" name="berat_badan" class="form-control @error('berat_badan') is-invalid @enderror" value="{{ old('berat_badan', $vitalSign->berat_badan) }}" step="0.1" placeholder="0" required>
                                @error('berat_badan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tinggi Badan (cm)</label>
                                <input type="number" name="tinggi_badan" class="form-control @error('tinggi_badan') is-invalid @enderror" value="{{ old('tinggi_badan', $vitalSign->tinggi_badan) }}"  placeholder="0" required>
                                @error('tinggi_badan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catatan Pemeriksaan (opsional)</label>
                            <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="2" placeholder="Catat kondisi tambahan, atau observasi perawat...">{{ old('catatan', $vitalSign->catatan) }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning text-white btn-lg">Update Hasil Pemeriksaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
