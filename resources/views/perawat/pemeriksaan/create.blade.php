<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeriksaan Tanda Vital - Perawat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Input Tanda Vital (Vital Signs)</h4>
                        <a href="{{ route('perawat.pemeriksaan.index') }}" class="btn btn-outline-light btn-sm">Kembali</a>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-light border mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Nama Pasien:</strong> {{ $pendaftaran->pasien->nama_lengkap ?? $pendaftaran->pasien->nama }}<br>
                                    <strong>No. RM:</strong> {{ $pendaftaran->pasien->no_rekam_medis ?? $pendaftaran->pasien->no_rm }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Dokter Tujuan:</strong> {{ $pendaftaran->dokter->name }}<br>
                                    <strong>Poliklinik:</strong> {{ $pendaftaran->poliklinik }}
                                </div>
                            </div>
                            <hr>
                            <strong>Keluhan Utama:</strong> {{ $pendaftaran->keluhan }}
                        </div>

                        <form action="{{ route('perawat.pemeriksaan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaran->id }}">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tekanan Darah (mmHg)</label>
                                    <input type="text" name="tekanan_darah" class="form-control" placeholder="Contoh: 120/80" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Suhu Tubuh (°C)</label>
                                    <input type="number" name="suhu" class="form-control" step="0.1" placeholder="Contoh: 36.5" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nadi (x/menit)</label>
                                    <input type="number" name="nadi" class="form-control" placeholder="Contoh: 80" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pernapasan (x/menit)</label>
                                    <input type="number" name="pernapasan" class="form-control" placeholder="Contoh: 20" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Berat Badan (kg)</label>
                                    <input type="number" name="berat_badan" class="form-control" step="0.1" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tinggi Badan (cm)</label>
                                    <input type="number" name="tinggi_badan" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Catatan Tambahan (Opsional)</label>
                                <textarea name="catatan" class="form-control" rows="2"></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-info text-white btn-lg">Simpan & Lanjut ke Dokter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
