<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = User::where('role', 'dokter')->get();
        return view('super_admin.dokter.index', compact('dokters'));
    }

    public function create()
    {
        return view('super_admin.dokter.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nip' => 'required|string|unique:users',
            'spesialis' => 'required|string',
            'phone' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'dokter';

        User::create($validated);

        return redirect()->route('super_admin.dokter.index')->with('success', 'Dokter berhasil ditambahkan');
    }

    public function edit(User $dokter)
    {
        return view('super_admin.dokter.edit', compact('dokter'));
    }

    public function update(Request $request, User $dokter)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $dokter->id,
            'nip' => 'required|string|unique:users,nip,' . $dokter->id,
            'spesialis' => 'required|string',
            'phone' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $dokter->update($validated);

        return redirect()->route('super_admin.dokter.index')->with('success', 'Data dokter berhasil diperbarui');
    }

    public function destroy(User $dokter)
    {
        $dokter->delete();
        return redirect()->route('super_admin.dokter.index')->with('success', 'Dokter berhasil dihapus');
    }
}
