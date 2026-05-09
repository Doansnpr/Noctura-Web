<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Auth as AkunModel;
use App\Models\AccessToken;
use MongoDB\BSON\ObjectId; 

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);

        $input = trim($request->input('email'));

        $user = AkunModel::on('mongodb')->from('akun')
            ->where(function ($q) use ($input) {
                $q->where('email', $input)
                  ->orWhere('username', $input);
            })->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email/username atau kata sandi salah.',
            ], 401);
        }

        $token = Str::random(60);

        AccessToken::create([
            'user_id' => (string) $user->_id,
            'token'   => hash('sha256', $token),
        ]);

        return response()->json([
            'message' => 'Login berhasil.',
            'token'   => $token,
            'user'    => [
                'id'       => (string) $user->_id,
                'username' => $user->username,
                'email'    => $user->email,
                'role'     => $user->role,
                'profile'  => $user->profile,
            ],
        ], 200);
    }

    public function me(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $accessToken = AccessToken::where('token', hash('sha256', $token))->first();

        if (!$accessToken) {
            return response()->json(['message' => 'Token tidak valid.'], 401);
        }

        $user = AkunModel::on('mongodb')->from('akun')
            ->where('_id', $accessToken->user_id)
            ->first();

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan.'], 404);
        }

        return response()->json([
            'status' => true,
            'user'   => [
                'id'       => (string) $user->_id,
                'username' => $user->username,
                'email'    => $user->email,
                'role'     => $user->role,
                'profile'  => $user->profile,
            ],
        ]);
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        AccessToken::where('token', hash('sha256', $token))->delete();

        return response()->json([
            'message' => 'Berhasil keluar.',
        ], 200);
    }
}