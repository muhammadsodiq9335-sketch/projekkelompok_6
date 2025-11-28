@extends('layouts.modern')

@section('title', 'Edit Pasien - Petugas')
@section('header-title', 'Edit Data Pasien')
@section('breadcrumb', 'Edit Pasien')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-custom">
                <div class="card-header-custom">
                    <i class="fas fa-user-edit me-2"></i>Formulir Edit Pasien
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('petugas.pasien.update', $pasien->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control form-control-lg" value="{{ old('nama_lengkap', $pasien->nama_lengkap) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Nomor KTP (NIK)</label>
                            <input type="text" name="no_ktp" class="form-control" value="{{ old('no_ktp', $pasien->no_ktp) }}" required maxlength="16">
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Jenis Pasien</label>
                                <select name="jenis_pasien" class="form-select" required>
                                    <option value="Umum" {{ old('jenis_pasien', $pasien->jenis_pasien) == 'Umum' ? 'selected' : '' }}>Umum</option>
                                    <option value="BPJS" {{ old('jenis_pasien', $pasien->jenis_pasien) == 'BPJS' ? 'selected' : '' }}>BPJS</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Nomor BPJS (Opsional)</label>
                                <input type="text" name="no_bpjs" class="form-control" value="{{ old('no_bpjs', $pasien->no_bpjs) }}" placeholder="Nomor BPJS jika ada">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $pasien->tanggal_lahir) }}" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">No. Telepon / WhatsApp</label>
                            <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon', $pasien->no_telepon) }}" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $pasien->alamat) }}</textarea>
                        </div>
                        
                        <div class="d-flex justify-content-between pt-3 border-top">
                            <a href="{{ route('petugas.pasien.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
