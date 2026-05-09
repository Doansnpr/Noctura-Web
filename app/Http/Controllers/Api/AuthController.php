<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $akun = Akun::where('username', $request->username)->first();

        if (!$akun) {
            return response()->json([
                'success' => false,
                'message' => 'Username tidak ditemukan',
            ], 404);
        }

        if (!Hash::check($request->password, $akun->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password salah',
            ], 401);
        }

        // BLOKIR ADMIN LOGIN DI MOBILE
        if ($akun->role === 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Akun admin hanya dapat login melalui web',
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'user' => [
                'id' => (string) $akun->getKey(),
                'username' => $akun->username,
                'email' => $akun->email,
                'role' => $akun->role,
                'profile' => $akun->profile ?? null,
            ],
        ], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'full_name' => 'required|string',
            'gender' => 'required|string|in:L,P',
            'phone' => 'required|string',
        ]);

        $existingUsername = Akun::where('username', $request->username)->first();

        if ($existingUsername) {
            return response()->json([
                'success' => false,
                'message' => 'Username sudah digunakan',
            ], 409);
        }

        $existingEmail = Akun::where('email', $request->email)->first();

        if ($existingEmail) {
            return response()->json([
                'success' => false,
                'message' => 'Email sudah digunakan',
            ], 409);
        }

        $akun = Akun::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'profile' => [
                'full_name' => $request->full_name,
                'gender' => $request->gender,
                'phone' => $request->phone,
            ],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil',
            'user' => [
                'id' => (string) $akun->getKey(),
                'username' => $akun->username,
                'email' => $akun->email,
                'role' => $akun->role,
                'profile' => $akun->profile,
            ],
        ], 201);
    }
}
