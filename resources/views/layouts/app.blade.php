<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Projek Kelompok</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	@yield('styles')
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
		<div class="container-fluid">
			<a class="navbar-brand" href="{{ url('/') }}">ProjekKelompok</a>
			<div class="collapse navbar-collapse">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item"><a class="nav-link" href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
				</ul>
				<form method="POST" action="{{ route('logout') }}" class="d-flex">
					@csrf
					<button class="btn btn-outline-secondary" type="submit">Logout</button>
				</form>
			</div>
		</div>
	</nav>

	<div class="container">
		@if(session('success'))
			<div class="alert alert-success">{{ session('success') }}</div>
		@endif
		@if(session('error'))
			<div class="alert alert-danger">{{ session('error') }}</div>
		@endif
		@if(session('info'))
			<div class="alert alert-info">{{ session('info') }}</div>
		@endif

		@yield('content')
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	@yield('scripts')
</body>
</html>
