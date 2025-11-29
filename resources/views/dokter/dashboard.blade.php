@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12 d-flex justify-content-between align-items-center mb-3">
		<h1>Dashboard Dokter</h1>
		<a href="{{ route('dokter.pemeriksaan.index') }}" class="btn btn-primary">Lihat Antrian</a>
	</div>

	<div class="col-md-3 mb-3">
		<div class="card">
			<div class="card-body">
				<h6>Antrian Menunggu</h6>
				<h3>{{ $antrianMenunggu ?? 0 }}</h3>
			</div>
		</div>
	</div>

	<div class="col-md-3 mb-3">
		<div class="card">
			<div class="card-body">
				<h6>Pemeriksaan Hari Ini</h6>
				<h3>{{ $pemeriksaanHariIni ?? 0 }}</h3>
			</div>
		</div>
	</div>

	<div class="col-md-3 mb-3">
		<div class="card">
			<div class="card-body">
				<h6>Total Pasien Hari Ini</h6>
				<h3>{{ $totalPasienHariIni ?? 0 }}</h3>
			</div>
		</div>
	</div>

	<div class="col-md-3 mb-3">
		<div class="card">
			<div class="card-body">
				<h6>Pasien Selesai</h6>
				<h3>{{ $pasienSelesai ?? 0 }}</h3>
			</div>
		</div>
	</div>

	<div class="col-12 mt-4">
		<div class="row">
			<div class="col-md-6">
				<div class="card mb-3">
					<div class="card-body">
						<h5>Diagnosa Terbanyak (Bulan ini)</h5>
						<ul>
							@forelse($diagnosaTerbanyak as $d)
								<li>{{ $d->diagnosis_utama }} <span class="badge bg-secondary">{{ $d->total }}</span></li>
							@empty
								<li>Tidak ada data</li>
							@endforelse
						</ul>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card mb-3">
					<div class="card-body">
						<h5>Recent Pemeriksaan</h5>
						<ul>
							@forelse($recentPemeriksaan as $r)
								<li>
									<strong>{{ $r->pendaftaran->pasien->nama_lengkap ?? '-' }}</strong>
									<div><small>{{ optional($r->created_at)->format('Y-m-d H:i') }}</small></div>
								</li>
							@empty
								<li>Tidak ada pemeriksaan</li>
							@endforelse
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

