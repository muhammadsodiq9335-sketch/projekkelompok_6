@extends('layouts.modern')

@section('title', 'Pendaftaran Pasien')
@section('header-title', 'Pendaftaran Pasien Baru')
@section('breadcrumb', 'Pendaftaran')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-custom">
                <div class="card-header-custom">
                    <i class="fas fa-file-medical me-2"></i>Formulir Pendaftaran
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('petugas.pendaftaran.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Pilih Pasien</label>
                                <select name="pasien_id" class="form-select select2-pasien" required>
                                    <option value="">-- Cari Nama / No RM --</option>
                                    @foreach($pasien as $p)
                                        <option value="{{ $p->id }}" {{ request('pasien_id') == $p->id ? 'selected' : '' }}>
                                            {{ $p->no_rm }} - {{ $p->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                                @if(!request('pasien_id'))
                                    <div class="form-text">
                                        Pasien belum terdaftar? <a href="{{ route('petugas.pasien.create') }}">Tambah Pasien Baru</a>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Jenis Kunjungan</label>
                                <select name="jenis_kunjungan" class="form-select" required>
                                    <option value="Baru">Pasien Baru</option>
                                    <option value="Lama">Pasien Lama</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tanggal Kunjungan</label>
                                <input type="date" name="tanggal_kunjungan" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Jam Kunjungan</label>
                                <input type="time" name="jam_kunjungan" class="form-control" value="{{ date('H:i') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Poliklinik Tujuan</label>
                                <select name="poliklinik" class="form-select" required>
                                    <option value="">-- Pilih Poliklinik --</option>
                                    @foreach($poliklinik as $poli)
                                        <option value="{{ $poli }}">{{ $poli }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Dokter Pemeriksa</label>
                                <select name="dokter_id" class="form-select" required>
                                    <option value="">-- Pilih Dokter --</option>
                                    @foreach($dokter as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Perawat Pemeriksa</label>
                                <select name="perawat_id" class="form-select" required>
                                    <option value="">-- Pilih Perawat --</option>
                                    @foreach($perawat as $pr)
                                        <option value="{{ $pr->id }}">{{ $pr->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('petugas.pendaftaran.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-save me-1"></i> Simpan
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
