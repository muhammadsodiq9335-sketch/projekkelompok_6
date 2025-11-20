<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginPetugas()
    {
        return view('auth.login-petugas');
    }

    public function showLoginPerawat()
    {
        return view('auth.login-perawat');
    }

    public function showLoginDokter()
    {
        return view('auth.login-dokter');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:petugas,perawat,dokter'
        ]);

        $credentials = $request->only('email', 'password');
        $credentials['role'] = $validated['role'];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            
            return match ($user->role) {
                'petugas' => redirect()->route('petugas.dashboard'),
                'perawat' => redirect()->route('perawat.dashboard'),
                'dokter' => redirect()->route('dokter.dashboard'),
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