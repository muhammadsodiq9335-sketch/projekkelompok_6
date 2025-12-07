@extends('layouts.modern')

@section('title', 'Detail Pasien')
@section('header-title', 'Detail Pasien')
@section('breadcrumb', 'Detail Pasien')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card-custom">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <div class="avatar-circle bg-primary text-white mx-auto" style="width: 80px; height: 80px; font-size: 32px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                        {{ strtoupper(substr($pasien->nama_lengkap, 0, 1)) }}
                    </div>
                </div>
                <h4 class="mb-1">{{ $pasien->nama_lengkap }}</h4>
                <p class="text-muted mb-3">{{ $pasien->no_rm }}</p>
                <div class="d-grid gap-2">
                    <a href="{{ route('petugas.pasien.edit', $pasien) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Edit Data
                    </a>
                    <a href="{{ route('petugas.pasien.print-card', $pasien) }}" target="_blank" class="btn btn-info text-white">
                        <i class="fas fa-id-card me-1"></i> Cetak Kartu
                    </a>
                    <a href="{{ route('petugas.pendaftaran.create', ['pasien_id' => $pasien->id]) }}" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i> Daftar Berobat
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card-custom mb-4">
            <div class="card-header-custom">
                <i class="fas fa-user me-2"></i>Informasi Lengkap Pasien
            </div>
            <div class="card-body p-4">
                <div class="row mb-3 border-bottom pb-2">
                    <div class="col-md-4 text-muted">Nomor Rekam Medis</div>
                    <div class="col-md-8 fw-bold text-primary">{{ $pasien->no_rm }}</div>
                </div>
                <div class="row mb-3 border-bottom pb-2">
                    <div class="col-md-4 text-muted">Nomor KTP (NIK)</div>
                    <div class="col-md-8 fw-bold">{{ $pasien->no_ktp }}</div>
                </div>
                <div class="row mb-3 border-bottom pb-2">
                    <div class="col-md-4 text-muted">Jenis Kelamin</div>
                    <div class="col-md-8 fw-bold">{{ $pasien->jenis_kelamin }}</div>
                </div>
                <div class="row mb-3 border-bottom pb-2">
                    <div class="col-md-4 text-muted">Tanggal Lahir</div>
                    <div class="col-md-8 fw-bold">{{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d F Y') }} ({{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->age }} Tahun)</div>
                </div>
                <div class="row mb-3 border-bottom pb-2">
                    <div class="col-md-4 text-muted">No. Telepon</div>
                    <div class="col-md-8 fw-bold">{{ $pasien->no_telepon ?? '-' }}</div>
                </div>
                <div class="row mb-3 border-bottom pb-2">
                    <div class="col-md-4 text-muted">Alamat</div>
                    <div class="col-md-8 fw-bold">{{ $pasien->alamat }}</div>
                </div>
                <div class="row mb-3 border-bottom pb-2">
                    <div class="col-md-4 text-muted">Jenis Pasien</div>
                    <div class="col-md-8 fw-bold">
                        @if($pasien->jenis_pasien == 'BPJS')
                            <span class="badge bg-success">BPJS</span>
                        @else
                            <span class="badge bg-secondary">Umum</span>
                        @endif
                    </div>
                </div>
                @if($pasien->jenis_pasien == 'BPJS')
                <div class="row mb-3 border-bottom pb-2">
                    <div class="col-md-4 text-muted">Nomor BPJS</div>
                    <div class="col-md-8 fw-bold">{{ $pasien->no_bpjs ?? '-' }}</div>
                </div>
                @endif
                <div class="row justify-content-end mt-3">
                    <div class="col-auto">
                        <a href="{{ route('petugas.pasien.index') }}" class="btn btn-light">Kembali ke Daftar</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
