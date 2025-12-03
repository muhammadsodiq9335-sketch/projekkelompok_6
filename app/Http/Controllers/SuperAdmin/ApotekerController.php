<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApotekerController extends Controller
{
    public function index()
    {
        $apoteker = User::where('role', 'apoteker')->get();
        return view('super_admin.apoteker.index', compact('apoteker'));
    }

    public function create()
    {
        return view('super_admin.apoteker.create');
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
        $validated['role'] = 'apoteker';

        User::create($validated);

        return redirect()->route('super_admin.apoteker.index')->with('success', 'Apoteker berhasil ditambahkan');
    }

    public function edit(User $apoteker)
    {
        return view('super_admin.apoteker.edit', compact('apoteker'));
    }

    public function update(Request $request, User $apoteker)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $apoteker->id,
            'nip' => 'required|string|unique:users,nip,' . $apoteker->id,
            'phone' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $apoteker->update($validated);

        return redirect()->route('super_admin.apoteker.index')->with('success', 'Data apoteker berhasil diperbarui');
    }

    public function destroy(User $apoteker)
    {
        $apoteker->delete();
        return redirect()->route('super_admin.apoteker.index')->with('success', 'Apoteker berhasil dihapus');
    }
}
