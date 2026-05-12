<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PredictionResult;

class VisualisasiController extends Controller
{
    public function index()
    {
        return view('visualisasi.index');
    }

    public function getChartData(Request $request)
    {
        try {
            // Ambil semua data
            $allData = PredictionResult::all();
            
            // ==================== 1. DONUT - DISTRIBUSI GANGGUAN (per prediksi) ====================
            $distribusiGangguan = PredictionResult::raw(function($collection) {
                return $collection->aggregate([
                    ['$group' => [
                        '_id' => '$prediction',
                        'count' => ['$sum' => 1]
                    ]]
                ]);
            });

            $gangguanLabels = [];
            $gangguanData = [];
            $totalPrediksi = 0;
            
            $labelMap = [
                'Healthy' => 'Tidur Sehat',
                'Insomnia' => 'Insomnia',
                'Sleep Apnea' => 'Sleep Apnea'
            ];
            
            foreach($distribusiGangguan as $item) {
                $key = $item->_id ?? 'Unknown';
                $gangguanLabels[] = $labelMap[$key] ?? $key;
                $gangguanData[] = $item->count;
                $totalPrediksi += $item->count;
            }

            // ==================== 2. LINE - TREN PREDIKSI PER BULAN (per prediksi) ====================
            $monthMap = [];
            foreach($allData as $data) {
                $date = null;
                
                if ($data->created_at) {
                    if ($data->created_at instanceof \DateTime) {
                        $date = $data->created_at->format('Y-m');
                    } elseif (is_string($data->created_at)) {
                        $date = date('Y-m', strtotime($data->created_at));
                    }
                } elseif ($data->predicted_at) {
                    if ($data->predicted_at instanceof \DateTime) {
                        $date = $data->predicted_at->format('Y-m');
                    } elseif (is_string($data->predicted_at)) {
                        $date = date('Y-m', strtotime($data->predicted_at));
                    }
                }
                
                if ($date) {
                    if (!isset($monthMap[$date])) {
                        $monthMap[$date] = 0;
                    }
                    $monthMap[$date]++;
                }
            }
            
            // Generate 6 bulan terakhir
            $labelsBulanan = [];
            $dataBulanan = [];
            for($i = 5; $i >= 0; $i--) {
                $bulan = now()->subMonths($i);
                $key = $bulan->format('Y-m');
                $labelsBulanan[] = $bulan->translatedFormat('M Y');
                $dataBulanan[] = $monthMap[$key] ?? 0;
            }

            // ==================== 3. BAR - DISTRIBUSI USIA (per user unik) ====================
            // Kumpulkan user unik berdasarkan user_id
            $uniqueUsers = [];
            foreach($allData as $data) {
                $userId = $data->user_id;
                if (!isset($uniqueUsers[$userId])) {
                    $inputData = is_string($data->input_data) ? json_decode($data->input_data, true) : $data->input_data;
                    $usia = $inputData['age'] ?? null;
                    $uniqueUsers[$userId] = $usia;
                }
            }
            
            $usiaKelompok = [
                '18-25 tahun' => 0,
                '26-35 tahun' => 0,
                '36-50 tahun' => 0,
                '>50 tahun' => 0
            ];
            
            foreach($uniqueUsers as $userId => $usia) {
                if($usia !== null) {
                    if($usia >= 18 && $usia <= 25) $usiaKelompok['18-25 tahun']++;
                    elseif($usia >= 26 && $usia <= 35) $usiaKelompok['26-35 tahun']++;
                    elseif($usia >= 36 && $usia <= 50) $usiaKelompok['36-50 tahun']++;
                    elseif($usia > 50) $usiaKelompok['>50 tahun']++;
                }
            }
            
            $usiaLabels = array_keys($usiaKelompok);
            $usiaData = array_values($usiaKelompok);

            // ==================== 4. DONUT - PERBANDINGAN GENDER (per user unik) ====================
            $uniqueUsersGender = [];
            foreach($allData as $data) {
                $userId = $data->user_id;
                if (!isset($uniqueUsersGender[$userId])) {
                    $inputData = is_string($data->input_data) ? json_decode($data->input_data, true) : $data->input_data;
                    $gender = $inputData['gender'] ?? null;
                    $uniqueUsersGender[$userId] = $gender;
                }
            }
            
            $genderCount = [
                'Laki-laki' => 0,
                'Perempuan' => 0,
            ];
            
            foreach($uniqueUsersGender as $userId => $gender) {
                if($gender == 'Male') $genderCount['Laki-laki']++;
                elseif($gender == 'Female') $genderCount['Perempuan']++;
            }

            $genderLabelsFiltered = [];
            $genderDataFiltered = [];
            foreach($genderCount as $label => $count) {
                if($count > 0) {
                    $genderLabelsFiltered[] = $label;
                    $genderDataFiltered[] = $count;
                }
            }

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
                'usia' => [
                    'labels' => $usiaLabels,
                    'data' => $usiaData,
                    'total_users' => count($uniqueUsers)
                ],
                'gender' => [
                    'labels' => $genderLabelsFiltered,
                    'data' => $genderDataFiltered,
                    'total_users' => count($uniqueUsersGender)
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