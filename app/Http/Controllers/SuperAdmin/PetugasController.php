<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = User::where('role', 'petugas')->get();
        return view('super_admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('super_admin.petugas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nip' => 'required|string|unique:users',
            'phone' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'petugas';

        User::create($validated);

        return redirect()->route('super_admin.petugas.index')->with('success', 'Petugas berhasil ditambahkan');
    }

    public function edit(User $petugas)
    {
        return view('super_admin.petugas.edit', compact('petugas'));
    }

    public function update(Request $request, User $petugas)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $petugas->id,
            'nip' => 'required|string|unique:users,nip,' . $petugas->id,
            'phone' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $petugas->update($validated);

        return redirect()->route('super_admin.petugas.index')->with('success', 'Data petugas berhasil diperbarui');
    }

    public function destroy(User $petugas)
    {
        $petugas->delete();
        return redirect()->route('super_admin.petugas.index')->with('success', 'Petugas berhasil dihapus');
    }
}
