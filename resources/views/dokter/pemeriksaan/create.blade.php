@extends('layouts.app')

@section('title', 'Pemeriksaan Pasien')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pemeriksaan Pasien</h1>
    </div>

    <div class="row">
        <!-- Patient Info & Vital Signs -->
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pasien</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <td width="35%">No. RM</td>
                                <td width="5%">:</td>
                                <td><strong>{{ $pendaftaran->pasien->no_rm }}</strong></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $pendaftaran->pasien->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td>Usia</td>
                                <td>:</td>
                                <td>{{ \Carbon\Carbon::parse($pendaftaran->pasien->tanggal_lahir)->age }} Tahun</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>{{ $pendaftaran->pasien->jenis_kelamin }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Vital Signs (Perawat)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tr>
                                <td>Tekanan Darah</td>
                                <td>: {{ $pendaftaran->vitalSign->tekanan_darah }} mmHg</td>
                            </tr>
                            <tr>
                                <td>Suhu</td>
                                <td>: {{ $pendaftaran->vitalSign->suhu_tubuh }} °C</td>
                            </tr>
                            <tr>
                                <td>Nadi</td>
                                <td>: {{ $pendaftaran->vitalSign->nadi }} x/menit</td>
                            </tr>
                            <tr>
                                <td>Frekuensi Nafas</td>
                                <td>: {{ $pendaftaran->vitalSign->pernapasan }} x/menit</td>
                            </tr>
                            <tr>
                                <td>Berat Badan/Tinggi Baadan</td>
                                <td>: {{ $pendaftaran->vitalSign->berat_badan }} kg / {{ $pendaftaran->vitalSign->tinggi_badan }} cm</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="pt-2"><strong>Keluhan Utama:</strong><br>
                                {{ $pendaftaran->keluhan }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Examination Form -->
        <div class="col-md-8">
            <form action="{{ route('dokter.pemeriksaan.store') }}" method="POST">
                @csrf
                <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaran->id }}">

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Hasil Pemeriksaan</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Anamnesa (S)</label>
                            <textarea name="anamnesa" class="form-control" rows="3" required>{{ old('anamnesa') }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Pemeriksaan Fisik (O)</label>
                            <textarea name="pemeriksaan_fisik" class="form-control" rows="3" required>{{ old('pemeriksaan_fisik') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Diagnosis Utama (A)</label>
                                <input type="text" name="diagnosis_utama" class="form-control" value="{{ old('diagnosis_utama') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Diagnosis Sekunder</label>
                                <input type="text" name="diagnosis_sekunder" class="form-control" value="{{ old('diagnosis_sekunder') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tindakan / Terapi (P)</label>
                            <textarea name="tindakan" class="form-control" rows="3" required>{{ old('tindakan') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rencana Tindak Lanjut</label>
                                <select name="rencana_tindak_lanjut" class="form-select" id="rencana_tindak_lanjut">
                                    <option value="Pulang">Pulang</option>
                                    <option value="Kontrol">Kontrol</option>
                                    <option value="Rujuk">Rujuk</option>

                                </select>
                            </div>
                            <div class="col-md-6 mb-3" id="tanggal_kontrol_wrapper" style="display: none;">
                                <label class="form-label">Tanggal Kontrol</label>
                                <input type="date" name="tanggal_kontrol" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Prescription -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Resep Obat</h6>
                        <button type="button" class="btn btn-sm btn-success" id="add-obat">
                            <i class="fas fa-plus"></i> Tambah Obat
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="obat-container">
                            <!-- Obat items will be added here -->
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 mb-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save me-2"></i> Simpan Pemeriksaan & Resep
                    </button>
                    <a href="{{ route('dokter.pemeriksaan.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<template id="obat-template">
    <div class="row mb-3 obat-item">
        <div class="col-md-5">
            <select name="obat_id[]" class="form-select select2-obat">
                <option value="">Pilih Obat</option>
                @foreach($obatList as $obat)
                    <option value="{{ $obat->id }}">{{ $obat->nama_obat }} (Stok: {{ $obat->stok }})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="jumlah[]" class="form-control" placeholder="Jml" min="1">
        </div>
        <div class="col-md-4">
            <input type="text" name="aturan_pakai[]" class="form-control" placeholder="Aturan Pakai (ex: 3x1)">
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger btn-sm remove-obat">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
</template>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('obat-container');
        const template = document.getElementById('obat-template');
        const addButton = document.getElementById('add-obat');
        const rtlSelect = document.getElementById('rencana_tindak_lanjut');
        const tglKontrolWrapper = document.getElementById('tanggal_kontrol_wrapper');

        // Toggle Tanggal Kontrol
        rtlSelect.addEventListener('change', function() {
            if (this.value === 'Kontrol') {
                tglKontrolWrapper.style.display = 'block';
            } else {
                tglKontrolWrapper.style.display = 'none';
            }
        });

        // Add Obat
        addButton.addEventListener('click', function() {
            const clone = template.content.cloneNode(true);
            container.appendChild(clone);
        });

        // Remove Obat
        container.addEventListener('click', function(e) {
            if (e.target.closest('.remove-obat')) {
                e.target.closest('.obat-item').remove();
            }
        });

        // Add initial row
        addButton.click();
    });
</script>
@endsection
@endsection
