@extends('layouts.petugas')

@section('title', 'Detail Pembayaran')
@section('header-title', 'Detail Pembayaran')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center p-5">
                <div class="mb-4">
                    <i class="fas fa-check-circle text-success fa-5x"></i>
                </div>
                <h2 class="mb-3">Pembayaran Berhasil!</h2>
                <p class="text-muted mb-4">Transaksi pembayaran telah berhasil disimpan.</p>

                <div class="card bg-light border-0 mb-4 text-start">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>No. Transaksi</span>
                            <span class="fw-bold">#{{ str_pad($pembayaran->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tanggal</span>
                            <span class="fw-bold">{{ $pembayaran->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Pasien</span>
                            <span class="fw-bold">{{ $pembayaran->pendaftaran->pasien->nama }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Tagihan</span>
                            <span class="fw-bold">Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Jumlah Bayar</span>
                            <span class="fw-bold">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Kembalian</span>
                            <span class="fw-bold text-success">Rp {{ number_format($pembayaran->kembalian, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('petugas.pembayaran.print', $pembayaran->id) }}" target="_blank" class="btn btn-primary btn-lg">
                        <i class="fas fa-print me-1"></i> Cetak Struk
                    </a>
                    <a href="{{ route('petugas.pembayaran.index') }}" class="btn btn-outline-secondary">
                        Kembali ke Antrian
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
