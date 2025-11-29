@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
	<h1>Antrian Pemeriksaan</h1>
	<a href="{{ route('dokter.pemeriksaan.riwayat') }}" class="btn btn-outline-primary">Riwayat Pemeriksaan</a>
	</div>

@if($antrianPasien->isEmpty())
	<div class="alert alert-info">Tidak ada pasien hari ini.</div>
@else
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>No. RM</th>
					<th>Nama</th>
					<th>Poliklinik</th>
					<th>Jam</th>
					<th>Vital Sign</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach($antrianPasien as $i => $p)
					<tr>
						<td>{{ $i + 1 }}</td>
						<td>{{ $p->pasien->no_rm ?? '-' }}</td>
						<td>{{ $p->pasien->nama_lengkap ?? '-' }}</td>
						<td>{{ $p->poliklinik }}</td>
						<td>{{ $p->jam_kunjungan ?? '-' }}</td>
						<td>
							@if($p->vitalSign)
								<small>TD: {{ $p->vitalSign->tekanan_darah ?? '-' }}</small><br>
								<small>Nadi: {{ $p->vitalSign->nadi ?? '-' }}</small>
							@else
								-
							@endif
						</td>
						<td>
							@if($p->pemeriksaan)
								<a href="{{ route('dokter.pemeriksaan.show', $p->pemeriksaan) }}" class="btn btn-sm btn-info">Lihat</a>
								<a href="{{ route('dokter.pemeriksaan.edit', $p->pemeriksaan) }}" class="btn btn-sm btn-warning">Edit</a>
							@else
								<a href="{{ route('dokter.pemeriksaan.create', $p) }}" class="btn btn-sm btn-primary">Periksa</a>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endif

@endsection

