<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Akun;
use Carbon\Carbon;

class ApiAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'status'  => false,
                'message' => 'Token tidak ditemukan.',
            ], 401);
        }

        // Cari user berdasarkan api_token (plain) di collection akun
        $user = Akun::on('mongodb')
            ->where('api_token', $token)
            ->first();

        if (!$user) {
            return response()->json([
                'status'  => false,
                'message' => 'Token tidak valid.',
            ], 401);
        }

        $request->attributes->set('auth_user', $user);

        return $next($request);
    }
}