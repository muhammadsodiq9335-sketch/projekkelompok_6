<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\VitalSign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemeriksaanController extends Controller
{
    public function index()
    {
        $today = today();
        $perawatId = Auth::id();

        $antrianMenunggu = Pendaftaran::with(['pasien', 'dokter'])
            ->whereDate('tanggal_kunjungan', $today)
            ->where('perawat_id', $perawatId)
            ->whereDoesntHave('vitalSign')
            ->where('status', '!=', 'Batal')
            ->orderBy('jam_kunjungan')
            ->get();

        return view('perawat.pemeriksaan.index', compact('antrianMenunggu'));
    }

    public function create(Pendaftaran $pendaftaran)
    {
        if ($pendaftaran->vitalSign) {
            return redirect()->route('perawat.pemeriksaan.edit', $pendaftaran->vitalSign)
                ->with('info', 'Vital sign sudah ada, Anda dapat mengeditnya.');
        }

        return view('perawat.pemeriksaan.create', compact('pendaftaran'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'tekanan_darah' => 'required|string',
            'nadi' => 'required|integer|min:40|max:200',
            'suhu' => 'required|numeric|min:35|max:42',
            'pernapasan' => 'required|integer|min:10|max:40',
            'berat_badan' => 'required|numeric|min:1|max:300',
            'tinggi_badan' => 'required|numeric|min:50|max:250',
            'catatan' => 'nullable|string',
        ]);

        $validated['perawat_id'] = Auth::id();

        $vitalSign = VitalSign::create($validated);

        Pendaftaran::where('id', $request->pendaftaran_id)->update(['status' => 'Dipanggil']);

        return redirect()->route('perawat.pemeriksaan.index')
            ->with('success', 'Vital sign berhasil dicatat!');
    }

    public function show(VitalSign $vitalSign)
    {
        $vitalSign->load(['pendaftaran.pasien', 'perawat']);
        return view('perawat.pemeriksaan.show', compact('vitalSign'));
    }

    public function edit(VitalSign $vitalSign)
    {
        return view('perawat.pemeriksaan.edit', compact('vitalSign'));
    }

    public function update(Request $request, VitalSign $vitalSign)
    {
        $validated = $request->validate([
            'tekanan_darah' => 'required|string',
            'nadi' => 'required|integer|min:40|max:200',
            'suhu' => 'required|numeric|min:35|max:42',
            'pernapasan' => 'required|integer|min:10|max:40',
            'berat_badan' => 'required|numeric|min:1|max:300',
            'tinggi_badan' => 'required|numeric|min:50|max:250',
            'catatan' => 'nullable|string',
        ]);

        $vitalSign->update($validated);

        return redirect()->route('perawat.pemeriksaan.index')
            ->with('success', 'Vital sign berhasil diupdate!');
    }

    public function destroy(VitalSign $vitalSign)
    {
        $vitalSign->delete();
        
        return redirect()->route('perawat.pemeriksaan.index')
            ->with('success', 'Vital sign berhasil dihapus!');
    }

    public function riwayat()
    {
        $perawatId = Auth::id();

        $vitalSigns = VitalSign::with(['pendaftaran.pasien', 'perawat'])
            ->where('perawat_id', $perawatId)
            ->latest()
            ->paginate(20);

        return view('perawat.pemeriksaan.riwayat', compact('vitalSigns'));
    }
}