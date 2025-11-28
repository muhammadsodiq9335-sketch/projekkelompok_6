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
        // 1. Antrian Menunggu (Collection for Table & Count)
        $antrianMenunggu = Pendaftaran::where('status', 'Menunggu')
            ->whereDate('tanggal_kunjungan', today())
            ->whereDoesntHave('vitalSign')
            ->get();

        // 2. Sudah Diperiksa (Count of patients with vital signs today)
        $sudahDiperiksa = VitalSign::whereHas('pendaftaran', function($query) {
                $query->whereDate('tanggal_kunjungan', today());
            })
            ->count();

        // 3. Total Pasien Hari Ini (Count of all registrations today)
        $totalPasienHariIni = Pendaftaran::whereDate('tanggal_kunjungan', today())
            ->count();

        return view('perawat.dashboard', compact(
            'antrianMenunggu',
            'sudahDiperiksa',
            'totalPasienHariIni'
        ));
    }
}