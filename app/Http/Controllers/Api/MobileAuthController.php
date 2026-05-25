<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MobileAuthController extends Controller
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

        if ($akun->role === 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Akun admin hanya dapat login melalui web',
            ], 403);
        }

        $token = Str::random(60);

        // ✅ Simpan hash ke akun.api_token agar cocok dengan ApiAuthenticate
        $akun->api_token = hash('sha256', $token);
        $akun->save();

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'token'   => $token,
            'user'    => [
                'id'       => (string) $akun->getKey(),
                'username' => $akun->username,
                'email'    => $akun->email,
                'role'     => $akun->role,
                'profile'  => $akun->profile ?? null,
            ],
        ]);
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        // ✅ Hapus token dari akun langsung
        $akun = Akun::where('api_token', hash('sha256', $token))->first();
        if ($akun) {
            $akun->api_token = null;
            $akun->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil keluar.',
        ]);
    }
}