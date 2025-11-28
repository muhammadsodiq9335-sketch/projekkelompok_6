<?php

namespace App\Http\Controllers\Apotek;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::latest()->paginate(10);
        return view('apotek.obat.index', compact('obat'));
    }

    public function create()
    {
        return view('apotek.obat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kode_obat' => 'required|string|unique:obat,kode_obat',
            'jenis' => 'required|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required|string',
        ]);

        Obat::create($request->all());

        return redirect()->route('apotek.obat.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function edit(Obat $obat)
    {
        return view('apotek.obat.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kode_obat' => 'required|string|unique:obat,kode_obat,' . $obat->id,
            'jenis' => 'required|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required|string',
        ]);

        $obat->update($request->all());

        return redirect()->route('apotek.obat.index')->with('success', 'Obat berhasil diperbarui.');
    }

    public function destroy(Obat $obat)
    {
        $obat->delete();
        return redirect()->route('apotek.obat.index')->with('success', 'Obat berhasil dihapus.');
    }
}
