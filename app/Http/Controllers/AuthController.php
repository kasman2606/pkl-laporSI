<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Jika autentikasi berhasil, arahkan ke halaman dashboard
            return redirect()->route('product.index');
        }

        // Jika autentikasi gagal, kembalikan ke halaman login dengan pesan kesalahan
        return redirect()->route('login')->with('error', 'Invalid credentials.');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
