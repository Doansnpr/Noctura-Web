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
    private function getUser(Request $request): AkunModel
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
    private function rawUpdate(AkunModel $user, array $fields): void
    {
        AkunModel::where('_id', $user->_id)->update($fields);
    }
    private function defaultPreferences(): array
    {
        return [
            'notification_enabled'  => true,
            'ai_prediction_enabled' => true,
            'weekly_report'         => true,
            'sleep_reminder'        => true,
        ];
    }

    // GET /api/profile
    public function show(Request $request): JsonResponse
    {
        $user  = $this->getUser($request);
        $attrs = $user->getAttributes();
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

    // PUT /api/profile───
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

    // PUT /api/profile/password
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

    // PUT /api/profile/email
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

    // PUT /api/profile/sleep-goal
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

    // PUT /api/profile/preferences

    public function updatePreferences(Request $request): JsonResponse
    {
        $request->validate([
            'notification_enabled'  => 'sometimes|boolean',
            'ai_prediction_enabled' => 'sometimes|boolean',
            'weekly_report'         => 'sometimes|boolean',
            'sleep_reminder'        => 'sometimes|boolean',
        ]);

        $user = $this->getUser($request);
        $defaults = $this->defaultPreferences();
        $stored = $this->toArray($user->getAttributes()['preferences'] ?? []);

        $incoming = array_filter(
            $request->only([
                'notification_enabled',
                'ai_prediction_enabled',
                'weekly_report',
                'sleep_reminder',
            ]),
            fn($v) => !is_null($v)
        );
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
    public function destroy(Request $request): JsonResponse
    {
        $user = $this->getUser($request);
        AkunModel::where('_id', $user->_id)->delete(); 

        return response()->json([
            'status'  => true,
            'message' => 'Akun berhasil dihapus.',
        ]);
    }
}
