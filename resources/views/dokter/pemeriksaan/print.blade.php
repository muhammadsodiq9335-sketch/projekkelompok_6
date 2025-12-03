<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Print Pemeriksaan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { font-size: 18px; }
        .section { margin-bottom: 12px; }
        .label { font-weight: bold; }
    </style>
    <script>
        window.onload = function() { window.print(); }
    </script>
</head>
<body onload="window.print()">

    <div class="header">
        <h2>SI-KIA DEFISSA</h2>
        <p>Jl. Mastrip,Krajan Timur, Kec. Sumber Sari<br>Telp: (021) 1234567</p>
    </div>

    <div class="info">

    <h1>Form Pemeriksaan</h1>

    <div class="section">
        <div class="label">Nama Pasien:</div>
        <div>{{ $pemeriksaan->pendaftaran->pasien->nama_lengkap ?? '-' }}</div>
    </div>

    <div class="section">
        <div class="label">No. RM:</div>
        <div>{{ $pemeriksaan->pendaftaran->pasien->no_rm ?? '-' }}</div>
    </div>

    <div class="section">
        <div class="label">Anamnesis:</div>
        <div>{{ $pemeriksaan->anamnesis }}</div>
    </div>

    <div class="section">
        <div class="label">Pemeriksaan Fisik:</div>
        <div>{{ $pemeriksaan->pemeriksaan_fisik }}</div>
    </div>

    <div class="section">
        <div class="label">Diagnosis Utama:</div>
        <div>{{ $pemeriksaan->diagnosis_utama }}</div>
    </div>

    <div class="section">
        <div class="label">Resep Obat:</div>
        <div>{{ $pemeriksaan->resep_obat ?? '-' }}</div>
    </div>

    <div class="section">
        <div class="label">Catatan Dokter:</div>
        <div>{{ $pemeriksaan->catatan_dokter ?? '-' }}</div>
    </div>

    <div class="section">
        <div class="label">Dokter:</div>
        <div>{{ $pemeriksaan->dokter->name ?? '-' }}</div>
    </div>
</body>
</html>
