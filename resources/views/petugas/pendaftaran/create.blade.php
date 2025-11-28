@extends('layouts.modern')

@section('title', 'Pendaftaran Pasien - Petugas')
@section('header-title', 'Pendaftaran Pasien Baru')
@section('breadcrumb', 'Pendaftaran Baru')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-custom">
                <div class="card-header-custom">
                    <i class="fas fa-edit me-2"></i>Formulir Pendaftaran
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('petugas.pendaftaran.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Pilih Pasien</label>
                            <select name="pasien_id" class="form-select select2-pasien" required>
                                <option value="">-- Cari Pasien (Nama / No RM) --</option>
                                @foreach($pasien as $p)
                                    <option value="{{ $p->id }}" {{ request('pasien_id') == $p->id ? 'selected' : '' }}>
                                        {{ $p->no_rekam_medis }} - {{ $p->nama_lengkap }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text mt-2">
                                Pasien belum terdaftar? <a href="{{ route('petugas.pasien.create') }}" class="text-decoration-none fw-bold">Tambah Pasien Baru</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Tanggal Kunjungan</label>
                                <input type="date" name="tanggal_kunjungan" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Jam Kunjungan</label>
                                <input type="time" name="jam_kunjungan" class="form-control" value="{{ date('H:i') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Jenis Kunjungan</label>
                                <select name="jenis_kunjungan" class="form-select" required>
                                    <option value="Baru">Baru</option>
                                    <option value="Lama">Lama</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Poliklinik</label>
                                <select name="poliklinik" class="form-select" required>
                                    <option value="">-- Pilih Poliklinik --</option>
                                    @foreach($poliklinik as $poli)
                                        <option value="{{ $poli }}">{{ $poli }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Dokter Tujuan</label>
                            <select name="dokter_id" class="form-select" required>
                                <option value="">-- Pilih Dokter --</option>
                                @foreach($dokter as $d)
                                    <option value="{{ $d->id }}">{{ $d->name }} ({{ $d->spesialis }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Keluhan Utama</label>
                            <textarea name="keluhan" class="form-control" rows="3" required placeholder="Contoh: Demam tinggi sejak 2 hari lalu..."></textarea>
                        </div>

                        <div class="d-flex justify-content-between pt-3 border-top">
                            <a href="{{ route('petugas.dashboard') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-check-circle me-1"></i> Daftarkan Pasien
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
                placeholder: '-- Cari Pasien (Nama / No RM) --'
            });
        });
    </script>
@endsection
