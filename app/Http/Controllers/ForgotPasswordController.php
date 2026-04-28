<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Auth as AkunModel;

class ForgotPasswordController extends Controller
{
    /**
     * Tampilkan halaman lupa kata sandi
     * GET /forgot-password
     */
    public function index()
    {
        return view('auth.forgot-password');
    }

    /**
     * Kirim OTP ke email
     * POST /forgot-password/send-otp
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
        ]);

        // Cek apakah email ada di MongoDB
        $user = AkunModel::on('mongodb')->from('akun')
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        // Generate OTP 6 digit
        $otp = rand(100000, 999999);

        // Simpan OTP ke collection otp_resets di MongoDB
        DB::connection('mongodb')->table('otp_resets')->where('email', $request->email)->delete();
        DB::connection('mongodb')->table('otp_resets')->insert([
            'email'      => $request->email,
            'otp'        => $otp,
            'expired_at' => now()->addMinutes(10)->toDateTimeString(),
            'created_at' => now()->toDateTimeString(),
        ]);

        // Kirim OTP ke email
        Mail::raw("Kode OTP reset kata sandi Noctura kamu adalah: $otp\n\nKode berlaku selama 10 menit.", function ($message) use ($request, $otp) {
            $message->to($request->email)
                    ->subject('Kode OTP Reset Kata Sandi - Noctura');
        });

        // Simpan email di session untuk dipakai di step berikutnya
        session(['reset_email' => $request->email]);

        return redirect()->route('forgot-password.verify')
            ->with('success', 'Kode OTP telah dikirim ke email kamu.');
    }

    /**
     * Tampilkan halaman verifikasi OTP
     * GET /forgot-password/verify
     */
    public function verifyForm()
    {
        if (!session('reset_email')) {
            return redirect()->route('forgot-password');
        }
        return view('auth.verify-otp');
    }

    /**
     * Verifikasi OTP
     * POST /forgot-password/verify
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ], [
            'otp.required' => 'Kode OTP wajib diisi.',
            'otp.digits'   => 'Kode OTP harus 6 digit.',
        ]);

        $email = session('reset_email');

        if (!$email) {
            return redirect()->route('forgot-password');
        }

        // Cek OTP di MongoDB
        $otpRecord = DB::connection('mongodb')->table('otp_resets')
            ->where('email', $email)
            ->where('otp', (int) $request->otp)
            ->first();

        if (!$otpRecord) {
            return back()->with('error', 'Kode OTP salah.');
        }

        // Cek expired
        if (now()->isAfter($otpRecord->expired_at)) {
            return back()->with('error', 'Kode OTP sudah kadaluarsa. Silakan minta ulang.');
        }

        // Tandai OTP sudah diverifikasi
        session(['otp_verified' => true]);

        return redirect()->route('forgot-password.reset');
    }

    /**
     * Tampilkan halaman reset password baru
     * GET /forgot-password/reset
     */
    public function resetForm()
    {
        if (!session('reset_email') || !session('otp_verified')) {
            return redirect()->route('forgot-password');
        }
        return view('auth.reset-password');
    }

    /**
     * Proses update password baru
     * POST /forgot-password/reset
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ], [
            'password.required'  => 'Kata sandi wajib diisi.',
            'password.min'       => 'Kata sandi minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $email = session('reset_email');

        if (!$email || !session('otp_verified')) {
            return redirect()->route('forgot-password');
        }

        // Update password di MongoDB
        DB::connection('mongodb')->table('akun')
            ->where('email', $email)
            ->update(['password' => Hash::make($request->password)]);

        // Hapus OTP dan session
        DB::connection('mongodb')->table('otp_resets')->where('email', $email)->delete();
        session()->forget(['reset_email', 'otp_verified']);

        return redirect()->route('login')
            ->with('success', 'Kata sandi berhasil diperbarui. Silakan login.');
    }
}