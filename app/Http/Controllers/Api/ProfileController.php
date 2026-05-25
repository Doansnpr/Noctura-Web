<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Akun as AkunModel;

class ProfileController extends Controller
{
    // ── Ambil user dari middleware ApiAuthenticate ─────────────────────────
    private function getUser(Request $request): AkunModel
    {
        return $request->attributes->get('auth_user');
    }

    // ── Normalisasi nilai ke array (safe untuk semua tipe MongoDB return) ──
    private function toArray($value): array
    {
        if (is_null($value))   return [];
        if (is_array($value))  return $value;
        if (is_string($value)) return json_decode($value, true) ?? [];
        return json_decode(json_encode($value), true) ?? [];
    }

    // ── Bypass Eloquent cast, update langsung ke MongoDB ──────────────────
    // Diperlukan karena MongoDB Laravel driver kadang tidak commit
    // array field lewat ->save() jika tidak ada dirty tracking yang benar.
    private function rawUpdate(AkunModel $user, array $fields): void
    {
        AkunModel::where('_id', $user->_id)->update($fields);
    }

    // ── Default preferences — single source of truth ──────────────────────
    // Didefinisikan di satu tempat agar show() dan updatePreferences()
    // selalu konsisten. Tambah key baru di sini saja.
    private function defaultPreferences(): array
    {
        return [
            // ── Existing fields (tidak di-breaking) ───────────────────────
            'notification_enabled'  => true,
            'ai_prediction_enabled' => true,
            // ── Flutter notification toggles ──────────────────────────────
            'weekly_report'         => true,
            'sleep_reminder'        => true,
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    // GET /api/profile
    // ─────────────────────────────────────────────────────────────────────────
    public function show(Request $request): JsonResponse
    {
        $user  = $this->getUser($request);
        $attrs = $user->getAttributes();

        // Merge stored preferences dengan defaults:
        // → User lama yang belum punya weekly_report/sleep_reminder
        //   otomatis mendapat nilai default tanpa perlu update dokumen.
        $storedPrefs = $this->toArray($attrs['preferences'] ?? []);
        $preferences = array_merge($this->defaultPreferences(), $storedPrefs);

        return response()->json([
            'status' => true,
            'data'   => [
                'id'       => (string) $user->_id,
                'username' => $user->username,
                'email'    => $user->email,
                'role'     => $user->role,

                'profile' => $this->toArray($attrs['profile'] ?? []),

                'sleep_goal' => $this->toArray($attrs['sleep_goal'] ?? [
                    'target_hours'     => 8.0,
                    'target_bedtime'   => '22:00',
                    'target_wake_time' => '06:00',
                ]),

                'preferences' => $preferences,
            ],
        ]);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // PUT /api/profile
    // ─────────────────────────────────────────────────────────────────────────
    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'username'          => 'sometimes|string|max:100',
            'email'             => 'sometimes|email',
            'profile'           => 'sometimes|array',
            'profile.full_name' => 'sometimes|string',
            'profile.gender'    => 'sometimes|string|in:L,P',
            'profile.phone'     => 'sometimes|string',
        ]);

        $user   = $this->getUser($request);
        $fields = ['updated_at' => now()];

        if ($request->has('username')) $fields['username'] = $request->username;
        if ($request->has('email'))    $fields['email']    = $request->email;

        if ($request->has('profile')) {
            $current           = $this->toArray($user->getAttributes()['profile'] ?? []);
            $fields['profile'] = array_merge($current, $request->profile);
        }

        $this->rawUpdate($user, $fields);

        return response()->json([
            'status'  => true,
            'message' => 'Profil berhasil diperbarui.',
        ]);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // PUT /api/profile/password
    // ─────────────────────────────────────────────────────────────────────────
    public function updatePassword(Request $request): JsonResponse
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password'     => 'required|string|min:8|confirmed',
        ]);

        $user = $this->getUser($request);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'status'  => false,
                'message' => 'Kata sandi saat ini tidak sesuai.',
                'errors'  => [
                    'current_password' => ['Kata sandi saat ini tidak sesuai.'],
                ],
            ], 422);
        }

        $this->rawUpdate($user, [
            'password'   => Hash::make($request->new_password),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Kata sandi berhasil diubah.',
        ]);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // PUT /api/profile/email
    //
    // Security flow:
    //   1. Validasi format + uniqueness email baru
    //   2. Verifikasi current_password sebelum commit
    //      → mencegah account takeover jika sesi aktif dicuri
    // ─────────────────────────────────────────────────────────────────────────
    public function updateEmail(Request $request): JsonResponse
    {
        $user = $this->getUser($request);

        $request->validate([
            'new_email' => [
                'required',
                'email',
                Rule::unique('auths', 'email')->ignore($user->_id, '_id'),
            ],
            'current_password' => 'required|string',
        ], [
            'new_email.required'        => 'Email baru harus diisi.',
            'new_email.email'           => 'Format email tidak valid.',
            'new_email.unique'          => 'Email sudah digunakan oleh akun lain.',
            'current_password.required' => 'Kata sandi harus diisi untuk verifikasi.',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'status'  => false,
                'message' => 'Kata sandi tidak sesuai.',
                'errors'  => [
                    'current_password' => ['Kata sandi tidak sesuai.'],
                ],
            ], 422);
        }

        $this->rawUpdate($user, [
            'email'      => $request->new_email,
            'updated_at' => now(),
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Email berhasil diubah.',
            'data'    => ['email' => $request->new_email],
        ]);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // PUT /api/profile/sleep-goal
    // ─────────────────────────────────────────────────────────────────────────
    public function updateSleepGoal(Request $request): JsonResponse
    {
        $request->validate([
            'target_hours'     => 'required|numeric|min:4|max:12',
            'target_bedtime'   => 'nullable|date_format:H:i',
            'target_wake_time' => 'nullable|date_format:H:i',
        ]);

        $user      = $this->getUser($request);
        $sleepGoal = [
            'target_hours'     => $request->target_hours,
            'target_bedtime'   => $request->target_bedtime,
            'target_wake_time' => $request->target_wake_time,
        ];

        $this->rawUpdate($user, [
            'sleep_goal' => $sleepGoal,
            'updated_at' => now(),
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Tujuan tidur berhasil disimpan.',
            'data'    => $sleepGoal,
        ]);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // PUT /api/profile/preferences
    //
    // Menerima kombinasi field lama dan baru sekaligus:
    //   Field lama  : notification_enabled, ai_prediction_enabled
    //   Field baru  : weekly_report, sleep_reminder  ← dari Flutter toggle
    //
    // Strategy: array_merge berlapis
    //   defaults ← stored ← request
    //   → tidak ada field yang hilang meski client hanya kirim sebagian key
    // ─────────────────────────────────────────────────────────────────────────
    public function updatePreferences(Request $request): JsonResponse
    {
        $request->validate([
            // Field lama — tetap support agar tidak breaking
            'notification_enabled'  => 'sometimes|boolean',
            'ai_prediction_enabled' => 'sometimes|boolean',
            // Field baru dari Flutter notification toggles
            'weekly_report'         => 'sometimes|boolean',
            'sleep_reminder'        => 'sometimes|boolean',
        ]);

        $user = $this->getUser($request);

        // Layer 1: defaults (semua key dengan nilai fallback)
        $defaults = $this->defaultPreferences();

        // Layer 2: nilai yang sudah tersimpan di MongoDB
        $stored = $this->toArray($user->getAttributes()['preferences'] ?? []);

        // Layer 3: hanya key yang dikirim request (filter null agar tidak
        // menimpa stored value dengan null saat key tidak dikirim)
        $incoming = array_filter(
            $request->only([
                'notification_enabled',
                'ai_prediction_enabled',
                'weekly_report',
                'sleep_reminder',
            ]),
            fn($v) => !is_null($v)
        );

        // Merge berlapis: defaults → stored → incoming
        // Prioritas: incoming > stored > defaults
        $preferences = array_merge($defaults, $stored, $incoming);

        $this->rawUpdate($user, [
            'preferences' => $preferences,
            'updated_at'  => now(),
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Preferensi berhasil disimpan.',
            'data'    => [
                'preferences' => $preferences,
            ],
        ]);
    }
}