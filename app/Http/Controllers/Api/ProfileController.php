<?php
// app/Http/Controllers/Api/ProfileController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private function getUser(Request $request)
    {
        return $request->attributes->get('auth_user');
    }

    // GET /api/profile
    public function show(Request $request)
    {
        $user = $this->getUser($request);

        return response()->json([
            'status' => true,
            'data'   => [
                'id'       => (string) $user->_id,
                'username' => $user->username,
                'email'    => $user->email,
                'role'     => $user->role,
                'profile'  => $user->profile ?? [],
                'sleep_goal' => $user->sleep_goal ?? [
                    'target_hours'     => 8.0,
                    'target_bedtime'   => '22:00',
                    'target_wake_time' => '06:00',
                ],
                'preferences' => $user->preferences ?? [
                    'notification_enabled'  => true,
                    'ai_prediction_enabled' => true,
                ],
            ],
        ]);
    }

    // PUT /api/profile
    public function update(Request $request)
    {
        $request->validate([
            'username'       => 'sometimes|string|max:100',
            'email'          => 'sometimes|email',
            'profile'        => 'sometimes|array',
            'profile.avatar' => 'nullable|string',
            'profile.phone'  => 'nullable|string',
        ]);

        $user = $this->getUser($request);

        // Gunakan direct assignment karena fillable tidak bisa diubah
        if ($request->has('username')) $user->username = $request->username;
        if ($request->has('email'))    $user->email    = $request->email;
        if ($request->has('profile'))  $user->profile  = $request->profile;
        $user->save();

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

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'status'  => true,
            'message' => 'Kata sandi berhasil diubah.',
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

        $user = $this->getUser($request);

        $user->sleep_goal = [
            'target_hours'     => $request->target_hours,
            'target_bedtime'   => $request->target_bedtime,
            'target_wake_time' => $request->target_wake_time,
        ];
        $user->save();

        return response()->json([
            'status'  => true,
            'message' => 'Tujuan tidur berhasil disimpan.',
            'data'    => $user->sleep_goal,
        ]);
    }

    // PUT /api/profile/preferences
    public function updatePreferences(Request $request)
    {
        $request->validate([
            'notification_enabled'  => 'sometimes|boolean',
            'ai_prediction_enabled' => 'sometimes|boolean',
        ]);

        $user    = $this->getUser($request);
        $current = $user->preferences ?? [];

        // Merge supaya field lain tidak hilang
        $user->preferences = array_merge($current, array_filter(
            $request->only(['notification_enabled', 'ai_prediction_enabled']),
            fn($v) => !is_null($v)
        ));
        $user->save();

        return response()->json([
            'status'  => true,
            'message' => 'Preferensi berhasil disimpan.',
            'data'    => $user->preferences,
        ]);
    }
}