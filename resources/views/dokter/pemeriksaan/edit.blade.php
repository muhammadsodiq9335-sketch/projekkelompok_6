@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pemeriksaan</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('dokter.pemeriksaan.update', $pemeriksaan) }}">
        @csrf
        @method('PUT')

        <div class="card mb-4">
            <div class="card-body">
                <h5>Informasi Pasien</h5>
                <p><strong>Nama:</strong> {{ $pemeriksaan->pendaftaran->pasien->nama_lengkap ?? '-' }}</p>
                <p><strong>No. RM:</strong> {{ $pemeriksaan->pendaftaran->pasien->no_rm ?? '-' }}</p>
                <p><strong>Tanggal Kunjungan:</strong> {{ optional($pemeriksaan->pendaftaran->tanggal_kunjungan)->format('Y-m-d') ?? $pemeriksaan->pendaftaran->tanggal_kunjungan }}</p>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="anamnesis">Anamnesis <span class="text-danger">*</span></label>
            <textarea name="anamnesis" id="anamnesis" class="form-control">{{ old('anamnesis', $pemeriksaan->anamnesis) }}</textarea>
            @error('anamnesis') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label for="pemeriksaan_fisik">Pemeriksaan Fisik <span class="text-danger">*</span></label>
            <textarea name="pemeriksaan_fisik" id="pemeriksaan_fisik" class="form-control">{{ old('pemeriksaan_fisik', $pemeriksaan->pemeriksaan_fisik) }}</textarea>
            @error('pemeriksaan_fisik') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label for="diagnosis_utama">Diagnosis Utama <span class="text-danger">*</span></label>
            <input type="text" name="diagnosis_utama" id="diagnosis_utama" class="form-control" value="{{ old('diagnosis_utama', $pemeriksaan->diagnosis_utama) }}">
            @error('diagnosis_utama') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label for="diagnosis_tambahan">Diagnosis Tambahan</label>
            <input type="text" name="diagnosis_tambahan" id="diagnosis_tambahan" class="form-control" value="{{ old('diagnosis_tambahan', $pemeriksaan->diagnosis_tambahan) }}">
            @error('diagnosis_tambahan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label for="tindakan">Tindakan</label>
            <textarea name="tindakan" id="tindakan" class="form-control">{{ old('tindakan', $pemeriksaan->tindakan) }}</textarea>
            @error('tindakan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label for="resep_obat">Resep Obat</label>
            <textarea name="resep_obat" id="resep_obat" class="form-control">{{ old('resep_obat', $pemeriksaan->resep_obat) }}</textarea>
            @error('resep_obat') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label for="catatan_dokter">Catatan Dokter</label>
            <textarea name="catatan_dokter" id="catatan_dokter" class="form-control">{{ old('catatan_dokter', $pemeriksaan->catatan_dokter) }}</textarea>
            @error('catatan_dokter') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label for="rencana_tindak_lanjut">Rencana Tindak Lanjut</label>
            <select name="rencana_tindak_lanjut" id="rencana_tindak_lanjut" class="form-control">
                <option value="" {{ old('rencana_tindak_lanjut', $pemeriksaan->rencana_tindak_lanjut)==''? 'selected' : '' }}>-- Pilih --</option>
                <option value="Kontrol" {{ old('rencana_tindak_lanjut', $pemeriksaan->rencana_tindak_lanjut)=='Kontrol'? 'selected' : '' }}>Kontrol</option>
                <option value="Rujuk" {{ old('rencana_tindak_lanjut', $pemeriksaan->rencana_tindak_lanjut)=='Rujuk'? 'selected' : '' }}>Rujuk</option>
                <option value="Pulang" {{ old('rencana_tindak_lanjut', $pemeriksaan->rencana_tindak_lanjut)=='Pulang'? 'selected' : '' }}>Pulang</option>
                <option value="Rawat Inap" {{ old('rencana_tindak_lanjut', $pemeriksaan->rencana_tindak_lanjut)=='Rawat Inap'? 'selected' : '' }}>Rawat Inap</option>
            </select>
            @error('rencana_tindak_lanjut') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3" id="tanggal_kontrol_wrapper" style="display: {{ (old('rencana_tindak_lanjut', $pemeriksaan->rencana_tindak_lanjut) == 'Kontrol') ? 'block' : 'none' }};">
            <label for="tanggal_kontrol">Tanggal Kontrol</label>
            <input type="date" name="tanggal_kontrol" id="tanggal_kontrol" class="form-control" value="{{ old('tanggal_kontrol', optional($pemeriksaan->tanggal_kontrol)->format('Y-m-d')) }}">
            @error('tanggal_kontrol') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Pemeriksaan</button>
        <a href="{{ route('dokter.pemeriksaan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var rencana = document.getElementById('rencana_tindak_lanjut');
    var tanggalWrapper = document.getElementById('tanggal_kontrol_wrapper');

    function toggleTanggal() {
        if (rencana.value === 'Kontrol') {
            tanggalWrapper.style.display = 'block';
        } else {
            tanggalWrapper.style.display = 'none';
            var t = document.getElementById('tanggal_kontrol');
            if (t) t.value = '';
        }
    }

    rencana.addEventListener('change', toggleTanggal);
});
</script>
@endsection
