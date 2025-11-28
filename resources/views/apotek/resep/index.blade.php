<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian Resep - Apotek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-clinic-medical me-2"></i>Apotek MediCare</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('apotek.resep.index') }}">Antrian Resep</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('apotek.obat.index') }}">Stok Obat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('apotek.resep.riwayat') }}">Riwayat</a>
                    </li>
                </ul>
            </div>
            <div class="ms-auto">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-4">Antrian Resep Masuk</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No. RM</th>
                                <th>Nama Pasien</th>
                                <th>Dokter</th>
                                <th>Waktu</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($resep as $item)
                            <tr>
                                <td>{{ $item->pendaftaran->pasien->no_rekam_medis }}</td>
                                <td>{{ $item->pendaftaran->pasien->nama }}</td>
                                <td>{{ $item->dokter->name }}</td>
                                <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                <td><span class="badge bg-warning">Menunggu</span></td>
                                <td>
                                    <a href="{{ route('apotek.resep.show', $item) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i> Lihat & Proses
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Tidak ada antrian resep saat ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $resep->links() }}
            </div>
        </div>
    </div>
</body>
</html>
