<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;

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
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
        ]);

        Pasien::create($validated);

        return redirect()->route('petugas.pasien.index')
            ->with('success', 'Data pasien berhasil ditambahkan!');
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
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
        ]);

        $pasien->update($validated);

        return redirect()->route('petugas.pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui!');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return redirect()->route('petugas.pasien.index')
            ->with('success', 'Data pasien berhasil dihapus!');
    }
}