<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Obat - Apotek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">Edit Obat</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('apotek.obat.update', $obat) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Kode Obat</label>
                                <input type="text" name="kode_obat" class="form-control" value="{{ $obat->kode_obat }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Obat</label>
                                <input type="text" name="nama_obat" class="form-control" value="{{ $obat->nama_obat }}" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis</label>
                                    <select name="jenis" class="form-select" required>
                                        <option value="Tablet" {{ $obat->jenis == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                                        <option value="Kapsul" {{ $obat->jenis == 'Kapsul' ? 'selected' : '' }}>Kapsul</option>
                                        <option value="Sirup" {{ $obat->jenis == 'Sirup' ? 'selected' : '' }}>Sirup</option>
                                        <option value="Salep" {{ $obat->jenis == 'Salep' ? 'selected' : '' }}>Salep</option>
                                        <option value="Injeksi" {{ $obat->jenis == 'Injeksi' ? 'selected' : '' }}>Injeksi</option>
                                        <option value="Alat Kesehatan" {{ $obat->jenis == 'Alat Kesehatan' ? 'selected' : '' }}>Alat Kesehatan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Satuan</label>
                                    <input type="text" name="satuan" class="form-control" value="{{ $obat->satuan }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Stok</label>
                                    <input type="number" name="stok" class="form-control" value="{{ $obat->stok }}" min="0" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Harga Satuan (Rp)</label>
                                    <input type="number" name="harga" class="form-control" value="{{ $obat->harga }}" min="0" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('apotek.obat.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Update Obat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
