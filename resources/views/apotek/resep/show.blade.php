<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Resep - Apotek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Resep</h5>
                        <span class="badge bg-light text-primary">{{ $resep->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-muted">Pasien</h6>
                                <p class="fw-bold mb-0">{{ $resep->pendaftaran->pasien->nama }}</p>
                                <small>{{ $resep->pendaftaran->pasien->no_rekam_medis }}</small>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <h6 class="text-muted">Dokter Penanggung Jawab</h6>
                                <p class="fw-bold mb-0">{{ $resep->dokter->name }}</p>
                            </div>
                        </div>

                        <h6 class="text-muted mb-3">Daftar Obat</h6>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Obat</th>
                                        <th>Jumlah</th>
                                        <th>Aturan Pakai</th>
                                        <th>Stok Tersedia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($resep->details as $detail)
                                    <tr class="{{ $detail->obat->stok < $detail->jumlah ? 'table-danger' : '' }}">
                                        <td>{{ $detail->obat->nama_obat }}</td>
                                        <td>{{ $detail->jumlah }} {{ $detail->obat->satuan }}</td>
                                        <td>{{ $detail->aturan_pakai }}</td>
                                        <td>
                                            {{ $detail->obat->stok }}
                                            @if($detail->obat->stok < $detail->jumlah)
                                                <span class="text-danger fw-bold">(Kurang)</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('apotek.resep.index') }}" class="btn btn-secondary">Kembali</a>
                            <form action="{{ route('apotek.resep.process', $resep) }}" method="POST" onsubmit="return confirm('Proses resep ini? Stok obat akan berkurang.')">
                                @csrf
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-check-circle me-1"></i> Proses & Selesai
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
