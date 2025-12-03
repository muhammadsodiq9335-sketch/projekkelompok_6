<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Pasien - {{ $pasien->nama_lengkap }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .card {
            width: 85.6mm;
            height: 53.98mm;
            border: 1px solid #000;
            border-radius: 8px;
            padding: 10px;
            box-sizing: border-box;
            position: relative;
            background: #f8f9fa;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            font-size: 14px;
            color: #0d6efd;
            text-transform: uppercase;
        }
        .header p {
            margin: 2px 0 0;
            font-size: 8px;
            color: #666;
        }
        .content {
            font-size: 10px;
        }
        .row {
            display: flex;
            margin-bottom: 4px;
        }
        .label {
            width: 80px;
            font-weight: bold;
        }
        .value {
            flex: 1;
        }
        .footer {
            position: absolute;
            bottom: 10px;
            right: 10px;
            text-align: right;
            font-size: 8px;
            color: #999;
        }
        .barcode {
            position: absolute;
            bottom: 10px;
            left: 10px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 10px;
            font-weight: bold;
        }
        @media print {
            body {
                padding: 0;
                display: block;
            }
            .no-print {
                display: none;
            }
            .card {
                border: 1px solid #ccc; /* Lighter border for print */
            }
        }
        .btn-print {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-family: sans-serif;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <h2>KARTU BEROBAT</h2>
            <p>SI-KIA DEFISSA</p>
        </div>
        <div class="content">
            <div class="row">
                <div class="label">No. RM</div>
                <div class="value">: <strong>{{ $pasien->no_rekam_medis ?? $pasien->no_rm }}</strong></div>
            </div>
            <div class="row">
                <div class="label">Nama</div>
                <div class="value">: {{ $pasien->nama_lengkap ?? $pasien->nama }}</div>
            </div>
            <div class="row">
                <div class="label">Tgl Lahir</div>
                <div class="value">: {{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d/m/Y') }}</div>
            </div>
            <div class="row">
                <div class="label">Alamat</div>
                <div class="value">: {{ Str::limit($pasien->alamat, 40) }}</div>
            </div>
        </div>
        <div class="barcode">
            *{{ $pasien->no_rekam_medis ?? $pasien->no_rm }}*
        </div>
        <div class="footer">
            Harap dibawa saat berobat
        </div>
    </div>

    <a href="#" onclick="window.print()" class="btn-print no-print">Cetak Kartu</a>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
