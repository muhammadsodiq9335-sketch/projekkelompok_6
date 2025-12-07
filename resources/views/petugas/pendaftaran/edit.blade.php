@extends('layouts.modern')

@section('title', 'Edit Pendaftaran')
@section('header-title', 'Edit Pendaftaran')
@section('breadcrumb', 'Edit Pendaftaran')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-custom">
                <div class="card-header-custom">
                    <i class="fas fa-edit me-2"></i>Edit Data Pendaftaran
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('petugas.pendaftaran.update', $pendaftaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Pasien</label>
                                <select name="pasien_id" class="form-select select2-pasien" required>
                                    <option value="">-- Cari Nama Pasien / No RM --</option>
                                    @foreach($pasien as $p)
                                        <option value="{{ $p->id }}" {{ (old('pasien_id', $pendaftaran->pasien_id) == $p->id) ? 'selected' : '' }}>
                                            {{ $p->no_rm }} - {{ $p->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Jenis Kunjungan</label>
                                <select name="jenis_kunjungan" class="form-select" required>
                                    <option value="Baru" {{ (old('jenis_kunjungan', $pendaftaran->jenis_kunjungan) == 'Baru') ? 'selected' : '' }}>Pasien Baru</option>
                                    <option value="Lama" {{ (old('jenis_kunjungan', $pendaftaran->jenis_kunjungan) == 'Lama') ? 'selected' : '' }}>Pasien Lama</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tanggal Kunjungan</label>
                                <input type="date" name="tanggal_kunjungan" class="form-control" value="{{ old('tanggal_kunjungan', $pendaftaran->tanggal_kunjungan) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Jam Kunjungan</label>
                                <input type="time" name="jam_kunjungan" class="form-control" value="{{ old('jam_kunjungan', $pendaftaran->jam_kunjungan) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Poliklinik Tujuan</label>
                                <select name="poliklinik" class="form-select" required>
                                    <option value="">-- Pilih Poliklinik --</option>
                                    @foreach($poliklinik as $poli)
                                        <option value="{{ $poli }}" {{ (old('poliklinik', $pendaftaran->poliklinik) == $poli) ? 'selected' : '' }}>{{ $poli }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Dokter Pemeriksa</label>
                                <select name="dokter_id" class="form-select" required>
                                    <option value="">-- Pilih Dokter --</option>
                                    @foreach($dokter as $d)
                                        <option value="{{ $d->id }}" {{ (old('dokter_id', $pendaftaran->dokter_id) == $d->id) ? 'selected' : '' }}>{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Perawat Pemeriksa</label>
                                <select name="perawat_id" class="form-select" required>
                                    <option value="">-- Pilih Perawat --</option>
                                    @foreach($perawat as $pr)
                                        <option value="{{ $pr->id }}" {{ (old('perawat_id', $pendaftaran->perawat_id) == $pr->id) ? 'selected' : '' }}>{{ $pr->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="Menunggu" {{ (old('status', $pendaftaran->status) == 'Menunggu') ? 'selected' : '' }}>Menunggu</option>
                                    <option value="Dipanggil" {{ (old('status', $pendaftaran->status) == 'Dipanggil') ? 'selected' : '' }}>Dipanggil</option>
                                    <option value="Selesai" {{ (old('status', $pendaftaran->status) == 'Selesai') ? 'selected' : '' }}>Selesai</option>
                                    <option value="Batal" {{ (old('status', $pendaftaran->status) == 'Batal') ? 'selected' : '' }}>Batal</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('petugas.pendaftaran.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-save me-1"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select2-pasien').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: '-- Cari Nama / No RM --'
            });
        });
    </script>
@endsection
