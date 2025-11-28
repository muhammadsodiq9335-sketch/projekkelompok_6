<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PerawatController extends Controller
{
    public function index()
    {
        $perawat = User::where('role', 'perawat')->get();
        return view('super_admin.perawat.index', compact('perawat'));
    }

    public function create()
    {
        return view('super_admin.perawat.create');
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
        $validated['role'] = 'perawat';

        User::create($validated);

        return redirect()->route('super_admin.perawat.index')->with('success', 'Perawat berhasil ditambahkan');
    }

    public function edit(User $perawat)
    {
        return view('super_admin.perawat.edit', compact('perawat'));
    }

    public function update(Request $request, User $perawat)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $perawat->id,
            'nip' => 'required|string|unique:users,nip,' . $perawat->id,
            'phone' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $perawat->update($validated);

        return redirect()->route('super_admin.perawat.index')->with('success', 'Data perawat berhasil diperbarui');
    }

    public function destroy(User $perawat)
    {
        $perawat->delete();
        return redirect()->route('super_admin.perawat.index')->with('success', 'Perawat berhasil dihapus');
    }
}
