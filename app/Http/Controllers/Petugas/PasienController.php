<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = Pasien::latest()->paginate(10);
        return view('petugas.pasien.index', compact('pasien'));
    }

    public function create()
    {
        return view('petugas.pasien.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_ktp' => 'required|string|size:16|unique:pasien,no_ktp',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'jenis_pasien' => 'required|in:Umum,BPJS',
            'no_bpjs' => 'nullable|string',
        ]);

        // Assign the currently authenticated user as the creator
        $validated['created_by'] = Auth::id();

        $pasien = Pasien::create($validated);

        return redirect()->route('petugas.pendaftaran.create', ['pasien_id' => $pasien->id])
            ->with('success', 'Data pasien berhasil ditambahkan! Silakan lanjutkan pendaftaran.');
    }

    public function show(Pasien $pasien)
    {
        return view('petugas.pasien.show', compact('pasien'));
    }

    public function edit(Pasien $pasien)
    {
        return view('petugas.pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_ktp' => 'required|string|size:16|unique:pasien,no_ktp,' . $pasien->id,
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'jenis_pasien' => 'required|in:Umum,BPJS',
            'no_bpjs' => 'nullable|string',
        ]);

        $pasien->update($validated);

        return redirect()->route('petugas.pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui!');
    }

    public function destroy(Pasien $pasien)
    {
        // Manual cascade delete to handle foreign key constraints
        // Get all pendaftaran IDs for this patient
        $pendaftaranIds = $pasien->pendaftaran()->pluck('id');

        // Delete all pemeriksaan for these pendaftaran
        \App\Models\Pemeriksaan::whereIn('pendaftaran_id', $pendaftaranIds)->delete();

        // Delete all vital signs for these pendaftaran
        \App\Models\VitalSign::whereIn('pendaftaran_id', $pendaftaranIds)->delete();
        
        // Delete all pendaftaran (although DB might handle this via cascade, it's safer to do it here if we are handling children)
        $pasien->pendaftaran()->delete();

        $pasien->delete();

        return redirect()->route('petugas.pasien.index')
            ->with('success', 'Data pasien berhasil dihapus!');
    }

    public function printCard(Pasien $pasien)
    {
        return view('petugas.pasien.print-card', compact('pasien'));
    }
}