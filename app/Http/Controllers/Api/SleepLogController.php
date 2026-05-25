<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SleepLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SleepLogController extends Controller
{
    private function getUser(Request $request)
    {
        return $request->attributes->get('auth_user');
    }

    // ── Hitung durasi dalam menit ─────────────────────────────────────────
    private function calcDuration(string $bedTime, string $wakeTime): int
    {
        [$bh, $bm] = array_map('intval', explode(':', $bedTime));
        [$wh, $wm] = array_map('intval', explode(':', $wakeTime));

        $bedMinutes  = $bh * 60 + $bm;
        $wakeMinutes = $wh * 60 + $wm;

        // Handle overnight (bed > wake, e.g. 22:00 → 06:00)
        if ($wakeMinutes <= $bedMinutes) {
            $wakeMinutes += 24 * 60;
        }

        return $wakeMinutes - $bedMinutes;
    }

    // ── GET /api/sleep-logs ───────────────────────────────────────────────
    public function index(Request $request)
    {
        $user  = $this->getUser($request);
        $limit = (int) $request->query('limit', 7);
        $page  = (int) $request->query('page', 1);

        $logs = SleepLog::where('user_id', (string) $user->_id)
            ->orderBy('tanggal', 'desc')
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'status' => true,
            'data'   => $logs->items(),
            'meta'   => [
                'total'        => $logs->total(),
                'current_page' => $logs->currentPage(),
                'last_page'    => $logs->lastPage(),
            ],
        ]);
    }

    // ── GET /api/sleep-logs/latest ────────────────────────────────────────
    public function latest(Request $request)
    {
        $user = $this->getUser($request);

        $log = SleepLog::where('user_id', (string) $user->_id)
            ->orderBy('tanggal', 'desc')
            ->first();

        return response()->json([
            'status' => true,
            'data'   => $log,
        ]);
    }

    // ── GET /api/sleep-logs/summary ───────────────────────────────────────
    public function summary(Request $request)
    {
        $user = $this->getUser($request);
        $days = (int) $request->query('days', 7);

        $from = Carbon::now()->subDays($days - 1)->startOfDay()->toDateString();

        $logs = SleepLog::where('user_id', (string) $user->_id)
            ->where('tanggal', '>=', $from)
            ->orderBy('tanggal', 'asc')
            ->get();

        // ── FIX: pakai nama field sesuai $fillable model ('durasi', 'kualitas')
        $totalDuration = $logs->sum('durasi');
        $avgDuration   = $logs->count() > 0
            ? (int) round($totalDuration / $logs->count())
            : 0;
        $avgQuality    = $logs->count() > 0
            ? round($logs->avg('kualitas'), 1)
            : 0;

        return response()->json([
            'status' => true,
            'data'   => [
                'logs'         => $logs->values(),
                'total_days'   => $logs->count(),
                'avg_duration' => $avgDuration,
                'avg_quality'  => $avgQuality,
            ],
        ]);
    }

    // ── POST /api/sleep-logs ──────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'    => 'required|date_format:Y-m-d',
            'jam_tidur'  => 'required|date_format:H:i',
            'jam_bangun' => 'required|date_format:H:i',
            'kualitas'   => 'required|integer|min:1|max:5',
            'notes'      => 'nullable|string|max:500',
        ], [
            'tanggal.required'    => 'Tanggal harus diisi.',
            'jam_tidur.required'  => 'Jam tidur harus diisi.',
            'jam_bangun.required' => 'Jam bangun harus diisi.',
            'kualitas.required'   => 'Kualitas tidur harus diisi.',
            'kualitas.min'        => 'Kualitas minimal 1 bintang.',
            'kualitas.max'        => 'Kualitas maksimal 5 bintang.',
        ]);

        $user    = $this->getUser($request);
        $durasi  = $this->calcDuration($request->jam_tidur, $request->jam_bangun);

        // Cek apakah sudah ada log untuk tanggal yang sama
        $existing = SleepLog::where('user_id', (string) $user->_id)
            ->where('tanggal', $request->tanggal)
            ->first();

        if ($existing) {
            return response()->json([
                'status'  => false,
                'message' => 'Log tidur untuk tanggal ini sudah ada.',
            ], 422);
        }

        $log = SleepLog::create([
            'user_id'    => (string) $user->_id,
            'tanggal'    => $request->tanggal,
            'jam_tidur'  => $request->jam_tidur,
            'jam_bangun' => $request->jam_bangun,
            'durasi'     => $durasi,     // ← FIX: 'durasi' bukan 'duration'
            'kualitas'   => $request->kualitas,
            'notes'      => $request->notes ?? null,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Log tidur berhasil disimpan.',
            'data'    => array_merge(
                ['_id' => (string) $log->getKey()],
                $log->toArray()
            ),
        ], 201);
    }

    // ── PUT /api/sleep-logs/{id} ──────────────────────────────────────────
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jam_tidur'  => 'sometimes|date_format:H:i',
            'jam_bangun' => 'sometimes|date_format:H:i',
            'kualitas'   => 'sometimes|integer|min:1|max:5',
            'notes'      => 'nullable|string|max:500',
        ]);

        $user = $this->getUser($request);
        $log  = SleepLog::where('_id', $id)
            ->where('user_id', (string) $user->_id)
            ->first();

        if (!$log) {
            return response()->json([
                'status'  => false,
                'message' => 'Log tidak ditemukan.',
            ], 404);
        }

        $jamTidur  = $request->jam_tidur  ?? $log->jam_tidur;
        $jamBangun = $request->jam_bangun ?? $log->jam_bangun;
        $durasi    = $this->calcDuration($jamTidur, $jamBangun);

        $log->update([
            'jam_tidur'  => $jamTidur,
            'jam_bangun' => $jamBangun,
            'durasi'     => $durasi,     // ← FIX: 'durasi' bukan 'duration'
            'kualitas'   => $request->kualitas ?? $log->kualitas,
            'notes'      => $request->has('notes') ? $request->notes : $log->notes,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Log tidur berhasil diperbarui.',
            'data'    => $log->fresh(),
        ]);
    }

    // ── DELETE /api/sleep-logs/{id} ───────────────────────────────────────
    public function destroy(Request $request, string $id)
    {
        $user = $this->getUser($request);
        $log  = SleepLog::where('_id', $id)
            ->where('user_id', (string) $user->_id)
            ->first();

        if (!$log) {
            return response()->json([
                'status'  => false,
                'message' => 'Log tidak ditemukan.',
            ], 404);
        }

        $log->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Log tidur berhasil dihapus.',
        ]);
    }
}