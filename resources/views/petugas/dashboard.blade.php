<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Petugas Dashboard</title>
	<style>body{font-family:Arial,Helvetica,sans-serif;margin:20px} .card{border:1px solid #ddd;padding:12px;border-radius:6px;margin-bottom:12px}</style>
</head>
<body>
	<h1>Dashboard Petugas</h1>

	<div class="card">
		<strong>Total Pasien:</strong>
		<span>{{ $totalPasien ?? '—' }}</span>
	</div>

	<div class="card">
		<strong>Pasien Umum:</strong> {{ $pasienUmum ?? '—' }}
		<br>
		<strong>Pasien BPJS:</strong> {{ $pasienBPJS ?? '—' }}
	</div>

	<div class="card">
		<strong>Pendaftaran Hari Ini:</strong> {{ $pendaftaranHariIni ?? '—' }}
		<br>
		<strong>Pendaftaran Menunggu:</strong> {{ $pendaftaranMenunggu ?? '—' }}
	</div>

	<div class="card">
		<strong>Kunjungan Per Poliklinik:</strong>
		<ul>
			@if(isset($kunjunganPerPoliklinik) && $kunjunganPerPoliklinik->count())
				@foreach($kunjunganPerPoliklinik as $k)
					<li>{{ $k->poliklinik }} — {{ $k->total }}</li>
				@endforeach
			@else
				<li>—</li>
			@endif
		</ul>
	</div>

	<div class="card">
		<strong>Pasien Baru (Bulan ini):</strong> {{ $pasienBaru ?? '—' }}
	</div>

	<div class="card">
		<strong>Statistik Bulanan:</strong>
		<ul>
			@if(isset($statistikBulanan) && $statistikBulanan->count())
				@foreach($statistikBulanan as $s)
					<li>{{ \\Illuminate\\Support\\Carbon::parse($s->tanggal)->toDateString() }} — {{ $s->total }}</li>
				@endforeach
			@else
				<li>—</li>
			@endif
		</ul>
	</div>

</body>
</html>
