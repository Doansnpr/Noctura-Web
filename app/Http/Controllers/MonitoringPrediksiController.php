<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use Illuminate\Http\Request;

class MonitoringPrediksiController extends Controller
{
    public function index()
    {
        $results = Monitoring::orderBy('created_at', 'desc')->get();

        $prediksi = $results->map(function ($item) {
            return $this->formatPredictionData($item);
        })->values();

        return view('monitoring_prediksi.index', compact('prediksi'));
    }

    public function destroy($id)
    {
        try {
            $data = Monitoring::find($id);

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data prediksi tidak ditemukan.',
                ], 404);
            }

            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data prediksi berhasil dihapus.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data prediksi: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function formatPredictionData($item)
    {
        $confidence = $this->decodeJsonField($item->confidence);
        $suggestions = $this->decodeJsonField($item->suggestions);
        $inputData = $this->decodeJsonField($item->input_data);

        $prediction = $item->prediction ?? '-';
        $mainConfidence = $this->getMainConfidence($prediction, $confidence);

        return [
            'id' => (string) ($item->_id ?? ''),
            'user_id' => $item->user_id ?? '-',
            'prediction' => $prediction,
            'label' => $item->label ?? '-',
            'confidence' => $confidence,
            'confidence_utama' => $mainConfidence,
            'description' => $item->description ?? '-',
            'suggestions' => is_array($suggestions) ? $suggestions : [],
            'input_data' => is_array($inputData) ? $inputData : [],
            'predicted_at' => $item->predicted_at ?? null,
            'created_at' => $item->created_at ? $item->created_at->toDateTimeString() : null,
            'updated_at' => $item->updated_at ? $item->updated_at->toDateTimeString() : null,
        ];
    }

    private function decodeJsonField($value)
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_object($value)) {
            return json_decode(json_encode($value), true);
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
        }

        return [];
    }

    private function getMainConfidence($prediction, $confidence)
    {
        if (!is_array($confidence) || empty($confidence)) {
            return 0;
        }

        $possibleKeys = [
            $prediction,
            ucfirst(strtolower($prediction)),
            str_replace('_', ' ', $prediction),
            str_replace(' ', '_', $prediction),
        ];

        foreach ($possibleKeys as $key) {
            if (isset($confidence[$key])) {
                return $this->toPercent($confidence[$key]);
            }
        }

        $max = max(array_map(function ($value) {
            return is_numeric($value) ? (float) $value : 0;
        }, $confidence));

        return $this->toPercent($max);
    }

    private function toPercent($value)
    {
        $value = is_numeric($value) ? (float) $value : 0;

        if ($value <= 1) {
            $value *= 100;
        }

        return round($value, 1);
    }
}
