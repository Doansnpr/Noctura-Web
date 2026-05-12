<?php
// app/Http/Middleware/ApiAuthenticate.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AccessToken;
use App\Models\Auth as AkunModel;

class ApiAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['status' => false, 'message' => 'Token tidak ditemukan.'], 401);
        }

        $accessToken = AccessToken::where('token', hash('sha256', $token))->first();

        if (!$accessToken) {
            return response()->json(['status' => false, 'message' => 'Token tidak valid.'], 401);
        }

        // ── Cek expired (7 hari) ──────────────────────────────
        $createdAt = \Carbon\Carbon::parse($accessToken->created_at);
        if ($createdAt->addDays(7)->isPast()) {
            $accessToken->delete(); // Hapus token expired
            return response()->json([
                'status'  => false,
                'message' => 'Token sudah kadaluarsa, silakan login ulang.',
            ], 401);
        }
        // ─────────────────────────────────────────────────────

        $user = AkunModel::on('mongodb')->from('akun')
            ->where('_id', $accessToken->user_id)
            ->first();

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User tidak ditemukan.'], 404);
        }

        $request->attributes->set('auth_user', $user);

        return $next($request);
    }
}
