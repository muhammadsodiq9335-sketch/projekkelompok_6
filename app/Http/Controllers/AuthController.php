<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validated, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            
            return match ($user->role) {
                'petugas' => redirect()->route('petugas.dashboard'),
                'perawat' => redirect()->route('perawat.dashboard'),
                'dokter' => redirect()->route('dokter.dashboard'),
                'super_admin' => redirect()->route('super_admin.dashboard'),
                'apoteker' => redirect()->route('apotek.resep.index'),
                default => $this->handleInvalidRole(),
            };
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->except('password'));
    }

    private function handleInvalidRole()
    {
        Auth::logout();
        return back()->withErrors([
            'email' => 'Role tidak valid.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}