<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
            'role' => ['required', 'in:admin,siswa'],
        ]);

        // Attempt login with role-specific validation
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password'], 'role' => $credentials['role']])) {
            $request->session()->regenerate();

            // Cek Role dan Arahkan ke Dashboard yang sesuai
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('/dashboard/admin');
            } else {
                return redirect()->intended('/dashboard/siswa');
            }
        }

        return back()->withInput($request->only('username', 'role'))
                    ->with('loginError', 'Login Gagal! Username atau Password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
