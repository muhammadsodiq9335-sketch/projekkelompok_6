<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PembayaranController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::where('status', 'Menunggu Pembayaran')
            ->with(['pasien', 'dokter', 'pemeriksaan', 'pemeriksaan.resep'])
            ->latest()
            ->get();
            
        return view('petugas.pembayaran.index', compact('pendaftarans'));
    }

    public function create(Pendaftaran $pendaftaran)
    {
        // Ensure status is correct
        if ($pendaftaran->status !== 'Menunggu Pembayaran') {
            return redirect()->route('petugas.pembayaran.index')
                ->with('error', 'Status pasien tidak valid untuk pembayaran.');
        }

        $pendaftaran->load(['pasien', 'dokter', 'pemeriksaan', 'pemeriksaan.resep', 'pemeriksaan.resep.details.obat']);

        // Calculate totals
        $totalTindakan = 50000; // Flat fee for now, or calculate from master data if available
        $totalObat = 0;

        if ($pendaftaran->pemeriksaan && $pendaftaran->pemeriksaan->resep) {
            foreach ($pendaftaran->pemeriksaan->resep->details as $detail) {
                $totalObat += $detail->subtotal;
            }
        }

        $totalBayar = $totalTindakan + $totalObat;

        return view('petugas.pembayaran.create', compact('pendaftaran', 'totalTindakan', 'totalObat', 'totalBayar'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'total_tindakan' => 'required|numeric|min:0',
            'total_obat' => 'required|numeric|min:0',
            'total_bayar' => 'required|numeric|min:0',
            'jumlah_bayar' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|string',
        ]);

        $kembalian = $validated['jumlah_bayar'] - $validated['total_bayar'];

        if ($kembalian < 0) {
            return back()->withErrors(['jumlah_bayar' => 'Jumlah bayar kurang dari total tagihan.'])->withInput();
        }

        $pembayaran = Pembayaran::create([
            'pendaftaran_id' => $validated['pendaftaran_id'],
            'total_tindakan' => $validated['total_tindakan'],
            'total_obat' => $validated['total_obat'],
            'total_bayar' => $validated['total_bayar'],
            'jumlah_bayar' => $validated['jumlah_bayar'],
            'kembalian' => $kembalian,
            'metode_pembayaran' => $validated['metode_pembayaran'],
        ]);

        // Update Pendaftaran status
        $pendaftaran = Pendaftaran::find($validated['pendaftaran_id']);
        $pendaftaran->update(['status' => 'Selesai']);

        return redirect()->route('petugas.pembayaran.show', $pembayaran->id)
            ->with('success', 'Pembayaran berhasil diproses.');
    }

    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load(['pendaftaran.pasien', 'pendaftaran.dokter']);
        return view('petugas.pembayaran.show', compact('pembayaran'));
    }

    public function print(Pembayaran $pembayaran)
    {
        $pembayaran->load(['pendaftaran.pasien', 'pendaftaran.dokter', 'pendaftaran.pemeriksaan.resep.details.obat']);
        return view('petugas.pembayaran.print', compact('pembayaran'));
    }
}
