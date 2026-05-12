<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\AccessToken;
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

        AccessToken::create([
            'user_id' => (string) $akun->getKey(),
            'token'   => hash('sha256', $token),
        ]);

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
        AccessToken::where('token', hash('sha256', $token))->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil keluar.',
        ]);
    }
}