<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class MonitoringPrediksiController extends Controller
{
    public function index()
    {
        $predictions = [
            [
                'id' => 1,
                'name' => 'Budi Santoso',
                'date' => '2026-04-01',
                'result' => 'Insomnia',
                'features' => [
                    'Gender' => 'Male',
                    'Age' => 34,
                    'Occupation' => 'Engineer',
                    'Sleep Duration' => 5.2,
                    'Quality of Sleep' => 4,
                    'Physical Activity Level' => 30,
                    'Stress Level' => 8,
                    'BMI Category' => 'Normal Weight',
                    'Steps' => 4200,
                ]
            ],
            [
                'id' => 2,
                'name' => 'Siti Rahma',
                'date' => '2026-04-03',
                'result' => 'Normal',
                'features' => [
                    'Gender' => 'Female',
                    'Age' => 28,
                    'Occupation' => 'Teacher',
                    'Sleep Duration' => 7.5,
                    'Quality of Sleep' => 8,
                    'Physical Activity Level' => 60,
                    'Stress Level' => 3,
                    'BMI Category' => 'Normal Weight',
                    'Steps' => 8700,
                ]
            ],
        ];

        return view('monitoring.index', compact('predictions'));
    }

    /**
     * Hapus data prediksi berdasarkan ID.
     * Untuk sementara hanya response sukses karena data dummy.
     * Jika sudah pakai database, ganti dengan query delete dari model.
     */
    public function destroy($id)
    {
        // Contoh jika sudah ada model Prediction
        // $prediction = Prediction::find($id);
        // if(!$prediction) {
        //     return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        // }
        // $prediction->delete();
        // return response()->json(['success' => true]);

        // Sementara karena data dummy, kita tetap balikkan sukses
        // Tapi data asli tidak akan hilang karena hanya array statis.
        // Untuk produksi, segera ganti dengan query database asli.
        return response()->json(['success' => true]);
    }
}