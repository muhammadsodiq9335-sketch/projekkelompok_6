<?php

namespace App\Http\Controllers\Apotek;

use App\Http\Controllers\Controller;
use App\Models\Resep;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepController extends Controller
{
    public function index()
    {
        $resep = Resep::with(['pendaftaran.pasien', 'dokter'])
            ->where('status', 'menunggu')
            ->latest()
            ->paginate(10);
            
        return view('apotek.resep.index', compact('resep'));
    }

    public function show(Resep $resep)
    {
        $resep->load(['details.obat', 'pendaftaran.pasien', 'dokter']);
        return view('apotek.resep.show', compact('resep'));
    }

    public function process(Resep $resep)
    {
        DB::beginTransaction();
        try {
            // Check stock first
            foreach ($resep->details as $detail) {
                $obat = Obat::find($detail->obat_id);
                if ($obat->stok < $detail->jumlah) {
                    throw new \Exception("Stok obat {$obat->nama_obat} tidak mencukupi (Sisa: {$obat->stok}, Butuh: {$detail->jumlah})");
                }
            }

            // Deduct stock
            foreach ($resep->details as $detail) {
                $obat = Obat::find($detail->obat_id);
                $obat->decrement('stok', $detail->jumlah);
            }

            $resep->update(['status' => 'selesai']);
            
            // Update Pendaftaran status to Menunggu Pembayaran
            $resep->pendaftaran->update(['status' => 'Menunggu Pembayaran']);

            DB::commit();
            return redirect()->route('apotek.resep.index')->with('success', 'Resep berhasil diproses. Pasien diarahkan ke kasir.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }
    
    public function riwayat()
    {
        $resep = Resep::with(['pendaftaran.pasien', 'dokter'])
            ->where('status', 'selesai')
            ->latest()
            ->paginate(10);
            
        return view('apotek.resep.riwayat', compact('resep'));
    }
}
