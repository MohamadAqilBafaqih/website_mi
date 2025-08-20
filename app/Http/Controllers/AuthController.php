<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Proses login user
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials)) {
            // Debug cek data user
            $user = \App\Models\User::where('email', $credentials['email'])->first();

            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
                'debug' => $user ? 'User ditemukan, mungkin password salah (belum di-hash?)' : 'User tidak ditemukan',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard')->with('success', 'Login berhasil');
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil');
    }
}
