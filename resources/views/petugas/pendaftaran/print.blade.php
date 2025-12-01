<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Nomor Antrian - {{ $pendaftaran->no_antrian }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .header {
            text-align: center;
            border-bottom: 2px dashed #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }
        .subtitle {
            font-size: 12px;
            margin: 5px 0;
        }
        .content {
            text-align: center;
            margin: 20px 0;
        }
        .antrian-label {
            font-size: 14px;
            margin-bottom: 5px;
        }
        .antrian-number {
            font-size: 42px;
            font-weight: bold;
            margin: 10px 0;
        }
        .poli {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .info {
            font-size: 12px;
            text-align: left;
            margin-top: 20px;
            border-top: 1px dashed #000;
            padding-top: 10px;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 20px;
        }
        @media print {
            body {
                border: none;
                width: 100%;
            }
            .no-print {
                display: none;
            }
        }
        .btn-print {
            display: block;
            width: 100%;
            padding: 10px;
            background: #0d6efd;
            color: white;
            text-align: center;
            text-decoration: none;
            margin-top: 20px;
            border-radius: 5px;
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">RS PROJEK WEB 6</h1>
        <p class="subtitle">Jl. Raya Kesehatan No. 123, Kota Sehat</p>
    </div>

    <div class="content">
        <div class="antrian-label">NOMOR ANTRIAN ANDA</div>
        <div class="antrian-number">{{ $pendaftaran->no_antrian }}</div>
        <div class="poli">{{ $pendaftaran->poliklinik }}</div>
        <div>{{ $pendaftaran->dokter->name }}</div>
    </div>

    <div class="info">
        <table>
            <tr>
                <td width="80">No RM</td>
                <td>: {{ $pendaftaran->pasien->no_rekam_medis ?? $pendaftaran->pasien->no_rm }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>: {{ $pendaftaran->pasien->nama_lengkap ?? $pendaftaran->pasien->nama }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: {{ \Carbon\Carbon::parse($pendaftaran->tanggal_kunjungan)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Jam</td>
                <td>: {{ $pendaftaran->jam_kunjungan }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Silakan menunggu panggilan.</p>
        <p>Terima kasih atas kunjungan Anda.</p>
        <small>{{ date('d/m/Y H:i:s') }}</small>
    </div>

    <a href="#" onclick="window.print()" class="btn-print no-print">Cetak Struk</a>
    <a href="{{ route('petugas.pendaftaran.index') }}" class="btn-print no-print" style="background: #6c757d;">Kembali</a>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
