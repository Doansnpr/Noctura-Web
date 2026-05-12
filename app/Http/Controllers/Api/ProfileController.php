<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Auth as AkunModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    private function getUser(Request $request)
    {
        return $request->attributes->get('auth_user');
    }

    private function toArray($value): array
    {
        if (is_null($value))   return [];
        if (is_array($value))  return $value;
        if (is_string($value)) return json_decode($value, true) ?? [];
        return json_decode(json_encode($value), true) ?? [];
    }

    // Bypass Eloquent cast, update langsung ke MongoDB
    private function rawUpdate(AkunModel $user, array $fields): void
    {
        AkunModel::where('_id', $user->_id)->update($fields);
    }

    // GET /api/profile
    public function show(Request $request)
    {
        $user  = $this->getUser($request);
        $attrs = $user->getAttributes();

        return response()->json([
            'status' => true,
            'data'   => [
                'id'       => (string) $user->_id,
                'username' => $user->username,
                'email'    => $user->email,
                'role'     => $user->role,
                'profile'     => $this->toArray($attrs['profile'] ?? []),
                'sleep_goal'  => $this->toArray($attrs['sleep_goal'] ?? [
                    'target_hours'     => 8.0,
                    'target_bedtime'   => '22:00',
                    'target_wake_time' => '06:00',
                ]),
                'preferences' => $this->toArray($attrs['preferences'] ?? [
                    'notification_enabled'  => true,
                    'ai_prediction_enabled' => true,
                ]),
            ],
        ]);
    }

    // PUT /api/profile
    public function update(Request $request)
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
            $current          = $this->toArray($user->getAttributes()['profile'] ?? []);
            $fields['profile'] = array_merge($current, $request->profile);
        }

        $this->rawUpdate($user, $fields);

        return response()->json([
            'status'  => true,
            'message' => 'Profil berhasil diperbarui.',
        ]);
    }

    // PUT /api/profile/password
    public function updatePassword(Request $request)
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

    // ─── NEW ─────────────────────────────────────────────────────────────────
    // PUT /api/profile/email
    //
    // Flow keamanan:
    //   1. Validasi format + uniqueness email baru
    //   2. Verifikasi current_password sebelum commit perubahan
    //      → mencegah account takeover jika sesi aktif dicuri
    //   3. rawUpdate bypass Eloquent cast (sama dengan endpoint lain)
    // ─────────────────────────────────────────────────────────────────────────
    public function updateEmail(Request $request)
    {
        $user = $this->getUser($request);

        $request->validate([
            'new_email' => [
                'required',
                'email',
                // Uniqueness check: pastikan email belum dipakai akun lain.
                // Exclude _id user sendiri agar tidak false-positive jika
                // user submit email yang sama dengan email saat ini.
                Rule::unique('auths', 'email')->ignore($user->_id, '_id'),
            ],
            'current_password' => 'required|string',
        ], [
            'new_email.required' => 'Email baru harus diisi.',
            'new_email.email'    => 'Format email tidak valid.',
            'new_email.unique'   => 'Email sudah digunakan oleh akun lain.',
            'current_password.required' => 'Kata sandi harus diisi untuk verifikasi.',
        ]);

        // Verifikasi identitas via password sebelum mengubah kredensial utama
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'status'  => false,
                'message' => 'Kata sandi tidak sesuai.',
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

    // PUT /api/profile/sleep-goal
    public function updateSleepGoal(Request $request)
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

    // PUT /api/profile/preferences
    public function updatePreferences(Request $request)
    {
        $request->validate([
            'notification_enabled'  => 'sometimes|boolean',
            'ai_prediction_enabled' => 'sometimes|boolean',
        ]);

        $user        = $this->getUser($request);
        $current     = $this->toArray($user->getAttributes()['preferences'] ?? []);
        $preferences = array_merge($current, array_filter(
            $request->only(['notification_enabled', 'ai_prediction_enabled']),
            fn($v) => !is_null($v)
        ));

        $this->rawUpdate($user, [
            'preferences' => $preferences,
            'updated_at'  => now(),
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Preferensi berhasil disimpan.',
            'data'    => $preferences,
        ]);
    }
}


