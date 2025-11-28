<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Pemeriksaan;
use App\Models\Obat;
use App\Models\Resep;
use App\Models\DetailResep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $obatList = Obat::where('stok', '>', 0)->orderBy('nama_obat')->get();

        return view('dokter.pemeriksaan.create', compact('pendaftaran', 'obatList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'anamnesa' => 'required|string',
            'pemeriksaan_fisik' => 'required|string',
            'diagnosis_utama' => 'required|string',
            'diagnosis_sekunder' => 'nullable|string',
            'tindakan' => 'required|string',
            'rencana_tindak_lanjut' => 'nullable|in:Kontrol,Rujuk,Pulang,Rawat Inap',
            'tanggal_kontrol' => 'nullable|date',
            // Validasi Resep
            'obat_id' => 'nullable|array',
            'obat_id.*' => 'exists:obat,id',
            'jumlah' => 'nullable|array',
            'jumlah.*' => 'numeric|min:1',
            'aturan_pakai' => 'nullable|array',
            'aturan_pakai.*' => 'string',
        ]);

        // DB::beginTransaction();

        try {
            // 1. Simpan Pemeriksaan
            $pemeriksaan = Pemeriksaan::create([
                'pendaftaran_id' => $request->pendaftaran_id,
                'dokter_id' => Auth::id(),
                'anamnesis' => $request->anamnesa,
                'pemeriksaan_fisik' => $request->pemeriksaan_fisik,
                'diagnosis_utama' => $request->diagnosis_utama,
                'diagnosis_tambahan' => $request->diagnosis_sekunder,
                'tindakan' => $request->tindakan,
                'catatan_dokter' => $request->catatan_dokter ?? null,
                'rencana_tindak_lanjut' => $request->rencana_tindak_lanjut,
                'tanggal_kontrol' => $request->tanggal_kontrol,
            ]);

            // 2. Simpan Resep jika ada obat yang dipilih
            if ($request->has('obat_id') && count($request->obat_id) > 0) {
                // Cek apakah ada obat yang dipilih (bukan null/kosong)
                $hasObat = false;
                foreach ($request->obat_id as $oid) {
                    if ($oid) $hasObat = true;
                }

                if ($hasObat) {
                    $resep = Resep::create([
                        'pendaftaran_id' => $request->pendaftaran_id,
                        'dokter_id' => Auth::id(),
                        'status' => 'menunggu',
                    ]);

                    foreach ($request->obat_id as $key => $obatId) {
                        if ($obatId && isset($request->jumlah[$key])) {
                            $obat = Obat::find($obatId);
                            DetailResep::create([
                                'resep_id' => $resep->id,
                                'obat_id' => $obatId,
                                'jumlah' => $request->jumlah[$key],
                                'aturan_pakai' => $request->aturan_pakai[$key] ?? '-',
                                'harga_satuan' => $obat->harga,
                            ]);
                        }
                    }
                }
            }

            // 3. Update Status Pendaftaran
            if (isset($hasObat) && $hasObat) {
                Pendaftaran::where('id', $request->pendaftaran_id)->update(['status' => 'Menunggu Obat']);
            } else {
                Pendaftaran::where('id', $request->pendaftaran_id)->update(['status' => 'Menunggu Pembayaran']);
            }

            // DB::commit();

            return redirect()->route('dokter.pemeriksaan.index')
                ->with('success', 'Pemeriksaan dan Resep berhasil disimpan!');

        } catch (\Exception $e) {
            // DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan->load(['pendaftaran.pasien', 'pendaftaran.vitalSign', 'dokter']);
        $resep = Resep::with('details.obat')->where('pendaftaran_id', $pemeriksaan->pendaftaran_id)->first();
        
        return view('dokter.pemeriksaan.show', compact('pemeriksaan', 'resep'));
    }

    public function edit(Pemeriksaan $pemeriksaan)
    {
        return view('dokter.pemeriksaan.edit', compact('pemeriksaan'));
    }

    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        // Implement update logic if needed
    }

    public function destroy(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan->delete();
        return redirect()->route('dokter.pemeriksaan.index')->with('success', 'Pemeriksaan berhasil dihapus!');
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