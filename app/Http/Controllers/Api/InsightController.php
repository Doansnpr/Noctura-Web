<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PredictionResult;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class InsightController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $akun   = $request->attributes->get('auth_user');
        $userId = (string) $akun->getKey();

        Log::info('[Insight] query user_id: ' . $userId);

        $prediction = PredictionResult::where('user_id', $userId)
            ->latest('predicted_at')
            ->first();

        Log::info('[Insight] found: ' . ($prediction ? 'yes' : 'no'));

        if (!$prediction) {
            return response()->json(['data' => null], 200);
        }

        return response()->json([
            'data' => [
                'label'        => $prediction->label,
                'description'  => $prediction->description,
                'suggestions'  => $prediction->suggestions ?? [],  // sudah array
                'confidence'   => $prediction->confidence ?? [],   // sudah array
                'predicted_at' => $prediction->predicted_at,
            ],
        ]);
    }
}