<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\PredictionResult;

class MobileVisualisasiController extends Controller
{
    public function getChartData(Request $request)
    {
        try {
            $user = $request->attributes->get('auth_user');
            $userId = (string) $user->id;
            
            $allData = PredictionResult::where('user_id', $userId)->get();
            
            // Jika tidak ada data
            if ($allData->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'gangguan' => [
                        'labels' => [],
                        'data' => [],
                        'total' => 0
                    ],
                    'tren' => [
                        'labels' => [],
                        'data' => []
                    ],
                    'rank' => [
                        'items' => [],
                        'most_common' => 'Belum ada data',
                        'most_common_label' => 'Belum ada data'
                    ]
                ]);
            }
            
            // ==================== 1. DISTRIBUSI GANGGUAN ====================
            $distribusiGangguan = [];
            $totalPrediksi = 0;
            
            $labelMap = [
                'Healthy' => 'Tidur Sehat',
                'Insomnia' => 'Insomnia',
                'Sleep Apnea' => 'Sleep Apnea'
            ];
            
            foreach($allData as $data) {
                $pred = $data->prediction;
                if (!isset($distribusiGangguan[$pred])) {
                    $distribusiGangguan[$pred] = 0;
                }
                $distribusiGangguan[$pred]++;
                $totalPrediksi++;
            }
            
            $gangguanLabels = [];
            $gangguanData = [];
            foreach($distribusiGangguan as $key => $count) {
                $gangguanLabels[] = $labelMap[$key] ?? $key;
                $gangguanData[] = $count;
            }

            // ==================== 2. TREN PER BULAN ====================
            $monthMap = [];
            foreach($allData as $data) {
                $date = $data->created_at ?? $data->predicted_at;
                if ($date) {
                    $month = date('Y-m', strtotime($date));
                    if (!isset($monthMap[$month])) {
                        $monthMap[$month] = 0;
                    }
                    $monthMap[$month]++;
                }
            }
            
            $labelsBulanan = [];
            $dataBulanan = [];
            for($i = 5; $i >= 0; $i--) {
                $bulan = now()->subMonths($i);
                $key = $bulan->format('Y-m');
                $labelsBulanan[] = $bulan->translatedFormat('M Y');
                $dataBulanan[] = $monthMap[$key] ?? 0;
            }

            // ==================== 3. RANKING GANGGUAN ====================
            $rankItems = [];
            foreach($distribusiGangguan as $key => $count) {
                $rankItems[] = [
                    'label' => $labelMap[$key] ?? $key,
                    'count' => $count,
                    'percentage' => ($count / $totalPrediksi) * 100
                ];
            }
            
            usort($rankItems, function($a, $b) {
                return $b['count'] - $a['count'];
            });
            
            $mostCommonLabel = !empty($rankItems) ? $rankItems[0]['label'] : 'Belum ada data';

            return response()->json([
                'success' => true,
                'gangguan' => [
                    'labels' => $gangguanLabels,
                    'data' => $gangguanData,
                    'total' => $totalPrediksi
                ],
                'tren' => [
                    'labels' => $labelsBulanan,
                    'data' => $dataBulanan
                ],
                'rank' => [
                    'items' => $rankItems,
                    'most_common' => $mostCommonLabel,
                    'most_common_label' => $mostCommonLabel
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}