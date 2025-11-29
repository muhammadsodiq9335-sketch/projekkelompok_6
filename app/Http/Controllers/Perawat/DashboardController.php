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
        $perawatId = Auth::id();

        // 1. Antrian Menunggu (Assigned to me, Waiting, No Vital Sign)
        $antrianMenunggu = Pendaftaran::where('status', 'Menunggu')
            ->whereDate('tanggal_kunjungan', today())
            ->where('perawat_id', $perawatId)
            ->whereDoesntHave('vitalSign')
            ->get();

        // 2. Sudah Diperiksa (Vital Signs performed by me today)
        $sudahDiperiksa = VitalSign::where('perawat_id', $perawatId)
            ->whereDate('created_at', today())
            ->count();

        // 3. Total Pasien Hari Ini (Assigned to me today)
        $totalPasienHariIni = Pendaftaran::whereDate('tanggal_kunjungan', today())
            ->where('perawat_id', $perawatId)
            ->count();

        return view('perawat.dashboard', compact(
            'antrianMenunggu',
            'sudahDiperiksa',
            'totalPasienHariIni'
        ));
    }
}