@extends('layouts.modern')

@section('title', 'Detail Pendaftaran')
@section('header-title', 'Detail Pendaftaran Pasien')
@section('breadcrumb', 'Detail Pendaftaran')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-custom">
                <div class="card-header-custom d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-info-circle me-2"></i>Informasi Pendaftaran
                    </div>
                    <div>
                        <a href="{{ route('petugas.pendaftaran.index') }}" class="btn btn-light btn-sm text-dark">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <a href="{{ route('petugas.pendaftaran.print', $pendaftaran->id) }}" target="_blank" class="btn btn-warning btn-sm text-dark ms-2">
                            <i class="fas fa-print me-1"></i> Cetak Antrian
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h1 class="display-4 fw-bold text-primary">{{ $pendaftaran->no_antrian }}</h1>
                        <p class="text-muted">Nomor Antrian</p>
                        <span class="badge bg-{{ $pendaftaran->status == 'Selesai' ? 'success' : ($pendaftaran->status == 'Dipanggil' ? 'warning' : 'secondary') }} fs-6 px-3 py-2">
                            Status: {{ $pendaftaran->status }}
                        </span>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small text-uppercase fw-bold">Nama Pasien</label>
                            <div class="fs-5">{{ $pendaftaran->pasien->nama_lengkap ?? $pendaftaran->pasien->nama }}</div>
                            <div class="text-muted small">{{ $pendaftaran->pasien->no_rm }}</div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <label class="text-muted small text-uppercase fw-bold">Waktu Kunjungan</label>
                            <div class="fs-5">{{ \Carbon\Carbon::parse($pendaftaran->tanggal_kunjungan)->format('d M Y') }}</div>
                            <div class="text-muted small">Pukul {{ $pendaftaran->jam_kunjungan }}</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small text-uppercase fw-bold">Poliklinik</label>
                            <div class="fs-5">{{ $pendaftaran->poliklinik }}</div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <label class="text-muted small text-uppercase fw-bold">Jenis Kunjungan</label>
                            <div class="fs-5">{{ $pendaftaran->jenis_kunjungan }}</div>
                        </div>
                    </div>

                    <div class="row mb-4 bg-light p-3 rounded mx-0">
                        <div class="col-md-6">
                            <label class="text-muted small text-uppercase fw-bold">Dokter Pemeriksa</label>
                            <div class="d-flex align-items-center mt-1">
                                <div class="avatar-circle bg-primary text-white me-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <div class="fw-bold">{{ $pendaftaran->dokter->name }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small text-uppercase fw-bold">Perawat Pemeriksa</label>
                            <div class="d-flex align-items-center mt-1">
                                <div class="avatar-circle bg-info text-white me-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                                    <i class="fas fa-user-nurse"></i>
                                </div>
                                <div class="fw-bold">{{ $pendaftaran->perawat->name ?? 'Belum ditentukan' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small text-uppercase fw-bold">Keluhan Utama</label>
                        <p class="p-3 bg-white border rounded">{{ $pendaftaran->keluhan }}</p>
                    </div>

                    <div class="text-end text-muted small mt-4">
                        Didaftarkan oleh: {{ $pendaftaran->petugas->name ?? 'Sistem' }} pada {{ $pendaftaran->created_at->format('d M Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
