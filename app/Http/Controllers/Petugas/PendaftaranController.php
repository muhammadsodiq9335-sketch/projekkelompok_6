<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftaran = Pendaftaran::with(['pasien', 'dokter', 'petugas', 'perawat'])
            ->latest()
            ->paginate(20);
        
        return view('petugas.pendaftaran.index', compact('pendaftaran'));
    }

    public function create()
    {
        $pasien = Pasien::orderBy('nama_lengkap')->get();
        $dokter = User::where('role', 'dokter')->orderBy('name')->get();
        $perawat = User::where('role', 'perawat')->orderBy('name')->get();
        
        $poliklinik = [
            'Poli Umum',
            'Poli Anak',
            'Poli Gigi',
            'Poli Mata',
            'Poli Kandungan',
            'Poli Jantung',
            'Poli Paru',
            'Poli Bedah',
            'Poli THT',
            'Poli Kulit'
        ];
        
        return view('petugas.pendaftaran.create', compact('pasien', 'dokter', 'perawat', 'poliklinik'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'tanggal_kunjungan' => 'required|date',
            'jam_kunjungan' => 'required',
            'poliklinik' => 'required|string',
            'dokter_id' => 'required|exists:users,id',
            'perawat_id' => 'required|exists:users,id',
            'keluhan' => 'required|string',
            'jenis_kunjungan' => 'required|in:Baru,Lama',
        ]);

        $validated['petugas_id'] = Auth::id();
        $validated['keluhan'] = '-'; // Default value since field is removed
        $validated['status'] = 'Menunggu';

        $pendaftaran = Pendaftaran::create($validated);

        return redirect()->route('petugas.pendaftaran.show', $pendaftaran)
            ->with('success', 'Pendaftaran berhasil! Nomor antrian: ' . $pendaftaran->no_antrian);
    }

    public function show(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load(['pasien', 'dokter', 'petugas', 'perawat', 'vitalSign', 'pemeriksaan']);
        return view('petugas.pendaftaran.show', compact('pendaftaran'));
    }

    public function edit(Pendaftaran $pendaftaran)
    {
        $pasien = Pasien::orderBy('nama_lengkap')->get();
        $dokter = User::where('role', 'dokter')->orderBy('name')->get();
        $perawat = User::where('role', 'perawat')->orderBy('name')->get();
        
        $poliklinik = [
            'Poli Umum',
            'Poli Anak',
            'Poli Gigi',
            'Poli Mata',
            'Poli Kandungan',
            'Poli Jantung',
            'Poli Paru',
            'Poli Bedah',
            'Poli THT',
            'Poli Kulit'
        ];
        
        return view('petugas.pendaftaran.edit', compact('pendaftaran', 'pasien', 'dokter', 'perawat', 'poliklinik'));
    }

    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'tanggal_kunjungan' => 'required|date',
            'jam_kunjungan' => 'required',
            'poliklinik' => 'required|string',
            'dokter_id' => 'required|exists:users,id',
            'perawat_id' => 'required|exists:users,id',
            'keluhan' => 'required|string',
            'jenis_kunjungan' => 'required|in:Baru,Lama',
            'status' => 'required|in:Menunggu,Dipanggil,Selesai,Batal'
        ]);

        $pendaftaran->update($validated);

        return redirect()->route('petugas.pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil diupdate!');
    }

    public function destroy(Pendaftaran $pendaftaran)
    {
        $pendaftaran->delete();
        
        return redirect()->route('petugas.pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil dihapus!');
    }

    public function print(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load(['pasien', 'dokter', 'perawat']);
        return view('petugas.pendaftaran.print', compact('pendaftaran'));
    }
}