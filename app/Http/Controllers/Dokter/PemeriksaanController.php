<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemeriksaanController extends Controller
{
    public function index()
    {
        $dokterId = Auth::id();
        $today = today();

        $antrianPasien = Pendaftaran::with(['pasien', 'vitalSign', 'petugas', 'pemeriksaan'])
            ->where('dokter_id', $dokterId)
            ->whereDate('tanggal_kunjungan', $today)
            ->whereHas('vitalSign')
            ->orderBy('jam_kunjungan')
            ->get();

        return view('dokter.pemeriksaan.index', compact('antrianPasien'));
    }

    public function create(Pendaftaran $pendaftaran)
    {
        if ($pendaftaran->pemeriksaan) {
            return redirect()->route('dokter.pemeriksaan.edit', $pendaftaran->pemeriksaan)
                ->with('info', 'Pemeriksaan sudah ada, Anda dapat mengeditnya.');
        }

        if (!$pendaftaran->vitalSign) {
            return redirect()->route('dokter.pemeriksaan.index')
                ->with('error', 'Pasien belum dilakukan pengukuran vital sign!');
        }

        return view('dokter.pemeriksaan.create', compact('pendaftaran'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'anamnesis' => 'required|string',
            'pemeriksaan_fisik' => 'required|string',
            'diagnosis_utama' => 'required|string',
            'diagnosis_tambahan' => 'nullable|string',
            'tindakan' => 'nullable|string',
            'resep_obat' => 'nullable|string',
            'catatan_dokter' => 'nullable|string',
            'rencana_tindak_lanjut' => 'nullable|in:Kontrol,Rujuk,Pulang,Rawat Inap',
            'tanggal_kontrol' => 'nullable|required_if:rencana_tindak_lanjut,Kontrol|date',
        ]);

        $validated['dokter_id'] = Auth::id();

        $pemeriksaan = Pemeriksaan::create($validated);

        Pendaftaran::where('id', $request->pendaftaran_id)->update(['status' => 'Selesai']);

        return redirect()->route('dokter.pemeriksaan.show', $pemeriksaan)
            ->with('success', 'Pemeriksaan berhasil dicatat!');
    }

    public function show(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan->load(['pendaftaran.pasien', 'pendaftaran.vitalSign', 'dokter']);
        return view('dokter.pemeriksaan.show', compact('pemeriksaan'));
    }

    public function edit(Pemeriksaan $pemeriksaan)
    {
        return view('dokter.pemeriksaan.edit', compact('pemeriksaan'));
    }

    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        $validated = $request->validate([
            'anamnesis' => 'required|string',
            'pemeriksaan_fisik' => 'required|string',
            'diagnosis_utama' => 'required|string',
            'diagnosis_tambahan' => 'nullable|string',
            'tindakan' => 'nullable|string',
            'resep_obat' => 'nullable|string',
            'catatan_dokter' => 'nullable|string',
            'rencana_tindak_lanjut' => 'nullable|in:Kontrol,Rujuk,Pulang,Rawat Inap',
            'tanggal_kontrol' => 'nullable|required_if:rencana_tindak_lanjut,Kontrol|date',
        ]);

        $pemeriksaan->update($validated);

        return redirect()->route('dokter.pemeriksaan.index')
            ->with('success', 'Pemeriksaan berhasil diupdate!');
    }

    public function destroy(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan->delete();
        
        return redirect()->route('dokter.pemeriksaan.index')
            ->with('success', 'Pemeriksaan berhasil dihapus!');
    }

    public function riwayat()
    {
        $dokterId = Auth::id();

        $pemeriksaan = Pemeriksaan::with(['pendaftaran.pasien', 'dokter'])
            ->where('dokter_id', $dokterId)
            ->latest()
            ->paginate(20);

        return view('dokter.pemeriksaan.riwayat', compact('pemeriksaan'));
    }

    public function print(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan->load(['pendaftaran.pasien', 'pendaftaran.vitalSign', 'dokter']);
        return view('dokter.pemeriksaan.print', compact('pemeriksaan'));
    }

    public function cariPasien(Request $request)
    {
        $search = $request->get('q');
        $dokterId = Auth::id();

        $pasien = Pendaftaran::with(['pasien', 'pemeriksaan'])
            ->whereHas('pasien', function($query) use ($search) {
                $query->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('no_rm', 'like', "%{$search}%");
            })
            ->where('dokter_id', $dokterId)
            ->latest()
            ->take(10)
            ->get();

        return view('dokter.pasien.index', compact('pasien', 'search'));
    }

    public function riwayatPasien(Pendaftaran $pendaftaran)
    {
        $riwayat = Pemeriksaan::whereHas('pendaftaran', function($query) use ($pendaftaran) {
                $query->where('pasien_id', $pendaftaran->pasien_id);
            })
            ->with(['pendaftaran', 'dokter'])
            ->latest()
            ->get();

        return view('dokter.pasien.riwayat', compact('pendaftaran', 'riwayat'));
    }
}