<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Pemeriksaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $dokterId = Auth::id();
        $today = today();
        $currentMonth = date('m');
        $currentYear = date('Y');

        // CHANGED: get() instead of count() because view iterates over this
        $antrianMenunggu = Pendaftaran::where('dokter_id', $dokterId)
            ->whereDate('tanggal_kunjungan', $today)
            ->whereHas('vitalSign')
            ->whereDoesntHave('pemeriksaan')
            ->get();

        $pemeriksaanHariIni = Pemeriksaan::where('dokter_id', $dokterId)
            ->whereHas('pendaftaran', function($query) use ($today) {
                $query->whereDate('tanggal_kunjungan', $today);
            })
            ->count();

        $totalPasienHariIni = Pendaftaran::where('dokter_id', $dokterId)
            ->whereDate('tanggal_kunjungan', $today)
            ->count();

        $pasienSelesai = Pendaftaran::where('dokter_id', $dokterId)
            ->whereDate('tanggal_kunjungan', $today)
            ->where('status', 'Selesai')
            ->count();

        $diagnosisTerbanyak = Pemeriksaan::select('diagnosis_utama', DB::raw('count(*) as total'))
            ->where('dokter_id', $dokterId)
            ->whereMonth('created_at', $currentMonth)
            ->groupBy('diagnosis_utama')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $recentPemeriksaan = Pemeriksaan::with(['pendaftaran.pasien'])
            ->where('dokter_id', $dokterId)
            ->latest()
            ->take(5)
            ->get();

        $statistikBulanan = Pemeriksaan::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('count(*) as total')
            )
            ->where('dokter_id', $dokterId)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return view('dokter.dashboard', compact(
            'antrianMenunggu',
            'pemeriksaanHariIni',
            'totalPasienHariIni',
            'pasienSelesai',
            'diagnosisTerbanyak',
            'recentPemeriksaan',
            'statistikBulanan'
        ));
    }
}