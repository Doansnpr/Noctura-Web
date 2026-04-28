<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Auth as AkunModel;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ], [
            'email.required'    => 'Email atau nama pengguna wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $input    = trim($request->input('email'));
        $password = $request->input('password');

        // Cari user manual pakai query langsung ke collection akun
        $user = AkunModel::on('mongodb')->from('akun')
            ->where(function($q) use ($input) {
                $q->where('email', $input)
                  ->orWhere('username', $input);
            })->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Email/username atau kata sandi salah.');
        }

        // Login manual
        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();
        

        return redirect()->intended(route('dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil keluar.');
    }
}