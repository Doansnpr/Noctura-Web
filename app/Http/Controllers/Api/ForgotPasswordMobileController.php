<?php
// app/Http/Controllers/Api/ForgotPasswordMobileController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Auth as AkunModel;

class ForgotPasswordMobileController extends Controller
{
    /**
     * POST /api/mobile/forgot-password/send-otp
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
        ]);

        $user = AkunModel::on('mongodb')->from('akun')
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak ditemukan.',
            ], 404);
        }

        $otp = rand(100000, 999999);

        DB::connection('mongodb')->table('otp_resets')
            ->where('email', $request->email)->delete();

        DB::connection('mongodb')->table('otp_resets')->insert([
            'email'      => $request->email,
            'otp'        => $otp,
            'expired_at' => now()->addMinutes(10)->toDateTimeString(),
            'created_at' => now()->toDateTimeString(),
        ]);

        Mail::raw(
            "Kode OTP reset kata sandi Noctura kamu adalah: $otp\n\nKode berlaku selama 10 menit.",
            function ($message) use ($request) {
                $message->to($request->email)
                        ->subject('Kode OTP Reset Kata Sandi - Noctura');
            }
        );

        return response()->json([
            'success' => true,
            'message' => 'Kode OTP telah dikirim ke email kamu.',
        ]);
    }

    /**
     * POST /api/mobile/forgot-password/verify-otp
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|digits:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'otp.required'   => 'Kode OTP wajib diisi.',
            'otp.digits'     => 'Kode OTP harus 6 digit.',
        ]);

        $otpRecord = DB::connection('mongodb')->table('otp_resets')
            ->where('email', $request->email)
            ->where('otp', (int) $request->otp)
            ->first();

        if (!$otpRecord) {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP salah.',
            ], 422);
        }

        if (now()->isAfter($otpRecord->expired_at)) {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP sudah kadaluarsa. Silakan minta ulang.',
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'OTP valid.',
        ]);
    }

    /**
     * POST /api/mobile/forgot-password/reset
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ], [
            'email.required'     => 'Email wajib diisi.',
            'password.required'  => 'Kata sandi wajib diisi.',
            'password.min'       => 'Kata sandi minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $otpRecord = DB::connection('mongodb')->table('otp_resets')
            ->where('email', $request->email)
            ->first();

        if (!$otpRecord) {
            return response()->json([
                'success' => false,
                'message' => 'Sesi reset tidak valid. Ulangi dari awal.',
            ], 403);
        }

        DB::connection('mongodb')->table('akun')
            ->where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        // Hapus OTP setelah berhasil — sama dengan web
        DB::connection('mongodb')->table('otp_resets')
            ->where('email', $request->email)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kata sandi berhasil diperbarui. Silakan login.',
        ]);
    }
}