<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PredictionHistoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PredictionHistoryController extends Controller
{
    public function __construct(
        private readonly PredictionHistoryService $historyService
    ) {}

    private function getUserId(Request $request): string
    {
        $user = $request->attributes->get('auth_user');

        if (!$user) {
            abort(401, 'Unauthenticated.');
        }

        return (string) $user->_id;
    }

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'page'     => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:50'],
            'filter'   => ['sometimes', 'string', 'in:all,healthy,insomnia,sleep_apnea'],
        ]);

        $userId  = $this->getUserId($request);
        $page    = (int) ($validated['page']    ?? 1);
        $perPage = (int) ($validated['per_page'] ?? 10);
        $filter  =       $validated['filter']   ?? 'all';

        $result = $this->historyService->getHistory($userId, $page, $perPage, $filter);

        return response()->json([
            'status' => 'success',
            'data'   => $result,
        ]);
    }

    public function show(Request $request, string $id): JsonResponse
    {
        $userId = $this->getUserId($request);
        $item   = $this->historyService->getDetail($userId, $id);

        if (!$item) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data prediksi tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $item,
        ]);
    }

    public function destroy(Request $request, string $id): JsonResponse
    {
        $userId  = $this->getUserId($request);
        $deleted = $this->historyService->delete($userId, $id);

        if (!$deleted) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data prediksi tidak ditemukan atau tidak dapat dihapus.',
            ], 404);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Riwayat prediksi berhasil dihapus.',
        ]);
    }

    public function summary(Request $request): JsonResponse
    {
        $userId  = $this->getUserId($request);
        $summary = $this->historyService->getSummary($userId);

        return response()->json([
            'status' => 'success',
            'data'   => $summary,
        ]);
    }
}