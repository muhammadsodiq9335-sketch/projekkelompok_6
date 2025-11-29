@extends('layouts.modern')

@section('title', 'Proses Pembayaran')
@section('header-title', 'Proses Pembayaran')
@section('breadcrumb', 'Kasir / Proses Pembayaran')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0">Rincian Tagihan</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Data Pasien</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="100">Nama</td>
                                <td>: <strong>{{ $pendaftaran->pasien->nama }}</strong></td>
                            </tr>
                            <tr>
                                <td>No. RM</td>
                                <td>: {{ $pendaftaran->pasien->no_rm }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: {{ $pendaftaran->pasien->alamat }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Data Kunjungan</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="100">No. Antrian</td>
                                <td>: <span class="badge bg-primary">{{ $pendaftaran->no_antrian }}</span></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>: {{ $pendaftaran->tanggal_kunjungan->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td>Dokter</td>
                                <td>: {{ $pendaftaran->dokter->name ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <h6 class="fw-bold border-bottom pb-2 mb-3">Rincian Biaya</h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Deskripsi</th>
                                <th class="text-end" width="200">Biaya (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Jasa Dokter & Tindakan</td>
                                <td class="text-end">{{ number_format($totalTindakan, 0, ',', '.') }}</td>
                            </tr>
                            @if($pendaftaran->pemeriksaan && $pendaftaran->pemeriksaan->resep)
                                @foreach($pendaftaran->pemeriksaan->resep->details as $detail)
                                <tr>
                                    <td>
                                        Obat: {{ $detail->obat->nama_obat }} 
                                        <small class="text-muted">({{ $detail->jumlah }} {{ $detail->obat->satuan }} x {{ number_format($detail->obat->harga, 0, ',', '.') }})</small>
                                    </td>
                                    <td class="text-end">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            @endif
                            <tr class="table-light fw-bold">
                                <td>Total Tagihan</td>
                                <td class="text-end fs-5 text-primary">{{ number_format($totalBayar, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0">Pembayaran</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('petugas.pembayaran.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaran->id }}">
                    <input type="hidden" name="total_tindakan" value="{{ $totalTindakan }}">
                    <input type="hidden" name="total_obat" value="{{ $totalObat }}">
                    <input type="hidden" name="total_bayar" value="{{ $totalBayar }}">

                    <div class="mb-3">
                        <label class="form-label">Total Tagihan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control fw-bold bg-light" value="{{ number_format($totalBayar, 0, ',', '.') }}" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="metode_pembayaran" class="form-select">
                            <option value="Tunai">Tunai</option>
                            <option value="Debit">Debit</option>
                            <option value="QRIS">QRIS</option>
                            <option value="Transfer">Transfer</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah Bayar</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="jumlah_bayar" class="form-control @error('jumlah_bayar') is-invalid @enderror" value="{{ old('jumlah_bayar') }}" required min="{{ $totalBayar }}">
                            @error('jumlah_bayar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="text-muted">Masukkan jumlah uang yang diterima.</small>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-1"></i> Proses Pembayaran
                        </button>
                        <a href="{{ route('petugas.pembayaran.index') }}" class="btn btn-light">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
