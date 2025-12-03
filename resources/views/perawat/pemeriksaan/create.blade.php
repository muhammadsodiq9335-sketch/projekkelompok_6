@extends('layouts.modern')

@section('title', 'Pemeriksaan Tanda Vital')
@section('header-title', 'Input Tanda Vital')
@section('breadcrumb', 'Pemeriksaan / Input Tanda Vital')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-custom">
                <div class="card-header-custom bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-white"><i class="fas fa-heartbeat me-2"></i>Input Tanda Vital (Vital Signs)</h5>
                    <a href="{{ route('perawat.pemeriksaan.index') }}" class="btn btn-outline-light btn-sm">Kembali</a>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-light border mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Nama Pasien:</strong> {{ $pendaftaran->pasien->nama_lengkap ?? $pendaftaran->pasien->nama }}<br>
                                <strong>No. RM:</strong> {{ $pendaftaran->pasien->no_rekam_medis ?? $pendaftaran->pasien->no_rm }}
                            </div>
                            <div class="col-md-6">
                                <strong>Dokter Tujuan:</strong> {{ $pendaftaran->dokter->name }}<br>
                                <strong>Poliklinik:</strong> {{ $pendaftaran->poliklinik }}
                            </div>
                        </div>
                        <hr>
                        <strong>Keluhan Utama:</strong> {{ $pendaftaran->keluhan }}
                    </div>

                    <form action="{{ route('perawat.pemeriksaan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaran->id }}">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tekanan Darah (mmHg)</label>
                                <input type="text" name="tekanan_darah" class="form-control" placeholder="Contoh: 120/80" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Suhu Tubuh (°C)</label>
                                <input type="number" name="suhu" class="form-control" step="0.1" placeholder="Contoh: 36.5" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nadi (denyut/menit)</label>
                                <input type="number" name="nadi" class="form-control" placeholder="Contoh: 80" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pernapasan (napas/menit)</label>
                                <input type="number" name="pernapasan" class="form-control" placeholder="Contoh: 20" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Berat Badan (kg)</label>
                                <input type="number" name="berat_badan" class="form-control" step="0.1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tinggi Badan (cm)</label>
                                <input type="number" name="tinggi_badan" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catatan Tambahan (Opsional)</label>
                            <textarea name="catatan" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-info text-white btn-lg">Simpan & Kirim ke Dokter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
