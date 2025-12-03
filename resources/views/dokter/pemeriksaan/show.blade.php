@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pemeriksaan</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5>Informasi Pasien</h5>
            <p><strong>Nama:</strong> {{ $pemeriksaan->pendaftaran->pasien->nama_lengkap ?? '-' }}</p>
            <p><strong>No. RM:</strong> {{ $pemeriksaan->pendaftaran->pasien->no_rm ?? '-' }}</p>
            <p><strong>Tanggal Kunjungan:</strong> {{ optional($pemeriksaan->pendaftaran->tanggal_kunjungan)->format('Y-m-d') ?? $pemeriksaan->pendaftaran->tanggal_kunjungan }}</p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5>Hasil Pemeriksaan Dokter</h5>
            <p><strong>Anamnesis:</strong><br>{{ $pemeriksaan->anamnesis }}</p>
            <p><strong>Pemeriksaan Fisik:</strong><br>{{ $pemeriksaan->pemeriksaan_fisik }}</p>
            <p><strong>Diagnosis Utama:</strong> {{ $pemeriksaan->diagnosis_utama }}</p>
            <p><strong>Diagnosis Tambahan:</strong> {{ $pemeriksaan->diagnosis_tambahan ?? '-' }}</p>
            <p><strong>Tindakan:</strong> {{ $pemeriksaan->tindakan ?? '-' }}</p>
            <p><strong>Resep Obat:</strong><br>{{ $pemeriksaan->resep_obat ?? '-' }}</p>
            <p><strong>Catatan Dokter:</strong><br>{{ $pemeriksaan->catatan_dokter ?? '-' }}</p>
            <p><strong>Rencana Tindak Lanjut:</strong> {{ $pemeriksaan->rencana_tindak_lanjut ?? '-' }}</p>
            <p><strong>Tanggal Kontrol:</strong> {{ optional($pemeriksaan->tanggal_kontrol)->format('Y-m-d') ?? '-' }}</p>
            <p><strong>Dokter:</strong> {{ $pemeriksaan->dokter->name ?? '-' }}</p>
        </div>
    </div>

    <a href="{{ route('dokter.pemeriksaan.edit', $pemeriksaan) }}" class="btn btn-primary">Edit</a>
    <a href="{{ route('dokter.pemeriksaan.print', $pemeriksaan) }}" class="btn btn-secondary" target="_blank">Print</a>
    <a href="{{ route('dokter.pemeriksaan.index') }}" class="btn btn-light">Kembali</a>
</div>
@endsection
