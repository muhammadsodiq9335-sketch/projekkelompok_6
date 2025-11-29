<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::with(['pasien', 'dokter', 'perawat'])
            ->latest()
            ->paginate(10);

        return view('petugas.laporan.index', compact('pendaftarans'));
    }

    public function export()
    {
        $pendaftarans = Pendaftaran::with(['pasien', 'dokter'])
            ->latest()
            ->get();

        $filename = "laporan_kunjungan_" . date('Y-m-d_H-i-s') . ".xls";

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        echo "No\tNo Antrian\tNo RM\tNama Pasien\tPoliklinik\tDokter\tTanggal Kunjungan\tStatus\n";

        foreach ($pendaftarans as $key => $pendaftaran) {
            echo ($key + 1) . "\t" .
                 $pendaftaran->no_antrian . "\t" .
                 ($pendaftaran->pasien->no_rm ?? '-') . "\t" .
                 ($pendaftaran->pasien->nama_lengkap ?? '-') . "\t" .
                 $pendaftaran->poliklinik . "\t" .
                 ($pendaftaran->dokter->name ?? '-') . "\t" .
                 $pendaftaran->tanggal_kunjungan->format('d/m/Y') . "\t" .
                 $pendaftaran->status . "\n";
        }
        exit;
    }
}
