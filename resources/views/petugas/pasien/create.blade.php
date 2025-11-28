@extends('layouts.modern')

@section('title', 'Tambah Pasien - Petugas')
@section('header-title', 'Tambah Pasien Baru')
@section('breadcrumb', 'Tambah Pasien')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-custom">
                <div class="card-header-custom">
                    <i class="fas fa-user-plus me-2"></i>Formulir Pasien Baru
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('petugas.pasien.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control form-control-lg" placeholder="Masukkan nama lengkap pasien" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Nomor KTP (NIK)</label>
                            <input type="text" name="no_ktp" class="form-control" placeholder="16 digit NIK" required maxlength="16">
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">No. Telepon / WhatsApp</label>
                            <input type="text" name="no_telepon" class="form-control" placeholder="08xxxxxxxxxx" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan..." required></textarea>
                        </div>
                        
                        <div class="d-flex justify-content-between pt-3 border-top">
                            <a href="{{ route('petugas.pasien.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-1"></i> Simpan & Lanjut Pendaftaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
