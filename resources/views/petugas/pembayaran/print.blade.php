<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran #{{ str_pad($pembayaran->id, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            width: 300px; /* Ukuran struk thermal */
            margin: 0 auto;
            padding: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            font-size: 16px;
        }
        .info {
            margin-bottom: 10px;
        }
        .info table {
            width: 100%;
        }
        .items {
            width: 100%;
            margin-bottom: 10px;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
        }
        .items th {
            text-align: left;
        }
        .items td {
            vertical-align: top;
        }
        .total {
            width: 100%;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
        }
        @media print {
            @page {
                margin: 0;
            }
            body {
                margin: 0;
                padding: 10px;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h2>KLINIK MEDICARE</h2>
        <p>Jl. Sehat Selalu No. 123<br>Telp: (021) 1234567</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td>No. Transaksi</td>
                <td align="right">#{{ str_pad($pembayaran->id, 6, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td align="right">{{ $pembayaran->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td>Pasien</td>
                <td align="right">{{ $pembayaran->pendaftaran->pasien->nama }}</td>
            </tr>
            <tr>
                <td>Dokter</td>
                <td align="right">{{ $pembayaran->pendaftaran->dokter->name ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <table class="items">
        <thead>
            <tr>
                <th>Item</th>
                <th align="right">Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Jasa Dokter & Tindakan</td>
                <td align="right">{{ number_format($pembayaran->total_tindakan, 0, ',', '.') }}</td>
            </tr>
            @if($pembayaran->pendaftaran->pemeriksaan && $pembayaran->pendaftaran->pemeriksaan->resep)
                @foreach($pembayaran->pendaftaran->pemeriksaan->resep->details as $detail)
                <tr>
                    <td>{{ $detail->obat->nama_obat }} ({{ $detail->jumlah }})</td>
                    <td align="right">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <table class="total">
        <tr>
            <td><strong>Total</strong></td>
            <td align="right"><strong>{{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</strong></td>
        </tr>
        <tr>
            <td>Bayar ({{ $pembayaran->metode_pembayaran }})</td>
            <td align="right">{{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Kembali</td>
            <td align="right">{{ number_format($pembayaran->kembalian, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Terima kasih atas kunjungan Anda.<br>Semoga lekas sembuh.</p>
    </div>

</body>
</html>
