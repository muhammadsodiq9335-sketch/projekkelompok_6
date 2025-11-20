<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = today();
        $currentMonth = date('m');
        $currentYear = date('Y');

        $totalPasien = Pasien::count();
        $pasienUmum = Pasien::where('jenis_pasien', 'Umum')->count();
        $pasienBPJS = Pasien::where('jenis_pasien', 'BPJS')->count();
        
        $pendaftaranHariIni = Pendaftaran::whereDate('tanggal_kunjungan', $today)->count();
        $pendaftaranMenunggu = Pendaftaran::where('status', 'Menunggu')
            ->whereDate('tanggal_kunjungan', $today)
            ->count();
        
        $kunjunganPerPoliklinik = Pendaftaran::select('poliklinik', DB::raw('count(*) as total'))
            ->whereDate('tanggal_kunjungan', $today)
            ->groupBy('poliklinik')
            ->get();

        $pasienBaru = Pasien::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        $statistikBulanan = Pendaftaran::select(
                DB::raw('DATE(tanggal_kunjungan) as tanggal'),
                DB::raw('count(*) as total')
            )
            ->whereMonth('tanggal_kunjungan', $currentMonth)
            ->whereYear('tanggal_kunjungan', $currentYear)
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return view('petugas.dashboard', compact(
            'totalPasien',
            'pasienUmum',
            'pasienBPJS',
            'pendaftaranHariIni',
            'pendaftaranMenunggu',
            'kunjunganPerPoliklinik',
            'pasienBaru',
            'statistikBulanan'
        ));
    }
}