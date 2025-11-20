<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\VitalSign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $antrianMenunggu = Pendaftaran::where('status', 'Menunggu')
            ->whereDate('tanggal_kunjungan', today())
            ->whereDoesntHave('vitalSign')
            ->count();

        $vitalSignHariIni = VitalSign::whereHas('pendaftaran', function($query) {
                $query->whereDate('tanggal_kunjungan', today());
            })
            ->count();

        $vitalSignSaya = VitalSign::where('perawat_id', Auth::id())
            ->whereHas('pendaftaran', function($query) {
                $query->whereDate('tanggal_kunjungan', today());
            })
            ->count();

        $pasienBelumVitalSign = Pendaftaran::whereDate('tanggal_kunjungan', today())
            ->whereDoesntHave('vitalSign')
            ->where('status', '!=', 'Batal')
            ->count();

        $statistikPerPoliklinik = Pendaftaran::select('poliklinik', DB::raw('count(*) as total'))
            ->whereDate('tanggal_kunjungan', today())
            ->whereHas('vitalSign')
            ->groupBy('poliklinik')
            ->get();

        $recentVitalSigns = VitalSign::with(['pendaftaran.pasien', 'perawat'])
            ->whereHas('pendaftaran', function($query) {
                $query->whereDate('tanggal_kunjungan', today());
            })
            ->latest()
            ->take(5)
            ->get();

        return view('perawat.dashboard', compact(
            'antrianMenunggu',
            'vitalSignHariIni',
            'vitalSignSaya',
            'pasienBelumVitalSign',
            'statistikPerPoliklinik',
            'recentVitalSigns'
        ));
    }
}