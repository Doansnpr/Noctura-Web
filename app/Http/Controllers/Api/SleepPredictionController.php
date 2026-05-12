<?php
// app/Http/Controllers/Api/SleepPredictionController.php

namespace App\Http\Controllers\Api; // ← FIX: tambah \Api

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\PredictionResult;

class SleepPredictionController extends \App\Http\Controllers\Controller
{
    private string $flaskBaseUrl = 'http://127.0.0.1:5000';
    private string $geminiApiKey;
    private string $geminiModel = 'gemini-2.0-flash';

    public function __construct()
    {
        $this->geminiApiKey = env('GEMINI_API_KEY', '');
    }

    private array $meta = [
        'Healthy' => [
            'label'   => 'Tidur Sehat',
            'emoji'   => '😴',
            'color'   => '#3B6D11',
            'bgColor' => '#EAF3DE',
        ],
        'Sleep Apnea' => [
            'label'   => 'Sleep Apnea',
            'emoji'   => '😮‍💨',
            'color'   => '#A32D2D',
            'bgColor' => '#FCEBEB',
        ],
        'Insomnia' => [
            'label'   => 'Insomnia',
            'emoji'   => '😶',
            'color'   => '#854F0B',
            'bgColor' => '#FAEEDB',
        ],
    ];

    private string $systemPrompt = <<<'PROMPT'
Kamu adalah asisten kesehatan tidur berbasis literatur ilmiah.
Tugasmu adalah memberikan deskripsi singkat dan saran praktis berdasarkan hasil klasifikasi gangguan tidur.

[LITERATUR DASAR]
1. American Academy of Sleep Medicine (AASM, 2014) - ICSD-3:
   - Insomnia: kesulitan memulai/mempertahankan tidur ≥3 malam/minggu selama ≥3 bulan.
     Penanganan: CBT-I adalah first-line treatment.
   - Sleep Apnea: henti napas berulang saat tidur (AHI ≥5/jam).
     Penanganan: CPAP therapy, positional therapy, weight management.
2. Morin & Benca (2012): sleep hygiene, hindari layar 1 jam sebelum tidur, batasi kafein 6 jam sebelum tidur.
3. Walker (2017): tidur 7-9 jam/malam, aerobik 150 menit/minggu.
4. Epstein & Mardon (2007): PMR dan mindfulness turunkan insomnia.
5. Punjabi (2008): tidur miring kurangi apnea 50%, obesitas tingkatkan risiko OSA 3-4x.
6. Grandner et al. (2012): journaling sebelum tidur kurangi intrusive thoughts.

[FORMAT RESPONS]
Kamu HARUS merespons hanya dalam format JSON berikut, tanpa teks tambahan, tanpa markdown, tanpa backtick:
{
  "description": "1-2 kalimat deskripsi kondisi dalam bahasa Indonesia yang mudah dipahami",
  "suggestions": [
    "Saran 1 spesifik dan actionable, sertakan sumber literatur singkat di akhir",
    "Saran 2 spesifik dan actionable, sertakan sumber literatur singkat di akhir",
    "Saran 3 spesifik dan actionable, sertakan sumber literatur singkat di akhir"
  ]
}

Gunakan bahasa Indonesia. Sesuaikan saran dengan data user (usia, BMI, stres, aktivitas fisik).
PROMPT;

    public function predict(Request $request)
    {
        $validated = $request->validate([
            'user_id'                 => 'nullable|string',
            'gender'                  => 'required|string',
            'age'                     => 'required|integer|min:1|max:120',
            'occupation'              => 'required|string',
            'sleep_duration'          => 'required|numeric|min:0|max:24',
            'quality_of_sleep'        => 'required|integer|min:1|max:10',
            'physical_activity_level' => 'required|integer|min:0|max:90',
            'stress_level'            => 'required|integer|min:1|max:10',
            'bmi_category'            => 'required|string',
            'heart_rate'              => 'required|integer|min:30|max:250',
            'daily_steps'             => 'required|integer|min:0',
            'systolic'                => 'required|integer|min:60|max:250',
            'diastolic'               => 'required|integer|min:40|max:150',
        ]);

        try {
            $flaskPayload  = collect($validated)->except('user_id')->toArray();
            $flaskResponse = Http::timeout(15)
                ->acceptJson()
                ->post("{$this->flaskBaseUrl}/predict", $flaskPayload);

            if (!$flaskResponse->successful()) {
                $errorMsg = $flaskResponse->json('message') ?? 'Flask server error';
                Log::error('Flask error', ['status' => $flaskResponse->status()]);
                return response()->json(['status' => 'error', 'message' => $errorMsg], $flaskResponse->status());
            }

            $flaskData  = $flaskResponse->json();
            $prediction = $flaskData['prediction'] ?? 'Unknown';
            $confidence = $flaskData['confidence'] ?? [];

            $meta = $this->meta[$prediction] ?? $this->meta['Healthy'];

            ['description' => $description, 'suggestions' => $suggestions]
                = $this->generateSuggestions($prediction, $validated);

            $record = PredictionResult::create([
                'user_id'      => $validated['user_id'] ?? null,
                'prediction'   => $prediction,
                'label'        => $meta['label'],
                'confidence'   => $confidence,
                'description'  => $description,
                'suggestions'  => $suggestions,
                'input_data'   => collect($validated)->except('user_id')->toArray(),
                'predicted_at' => now(),
            ]);

            return response()->json([
                'status'      => 'success',
                'id'          => (string) $record->_id,
                'prediction'  => $prediction,
                'confidence'  => $confidence,
                'label'       => $meta['label'],
                'emoji'       => $meta['emoji'],
                'color'       => $meta['color'],
                'bgColor'     => $meta['bgColor'],
                'description' => $description,
                'suggestions' => $suggestions,
            ]);

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Connection to Flask failed', ['error' => $e->getMessage()]);
            return response()->json(['status' => 'error', 'message' => 'Tidak dapat terhubung ke server analisis.'], 503);
        } catch (\Exception $e) {
            Log::error('Prediction error', ['error' => $e->getMessage()]);
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan pada server.'], 500);
        }
    }

    private function generateSuggestions(string $prediction, array $userData): array
    {
        if (empty($this->geminiApiKey)) {
            return $this->fallbackSuggestions($prediction);
        }

        $fullPrompt = $this->systemPrompt . "\n\n[DATA USER]\n"
            . "Hasil prediksi: {$prediction}\n"
            . "Usia: {$userData['age']} tahun\n"
            . "Gender: {$userData['gender']}\n"
            . "Durasi tidur: {$userData['sleep_duration']} jam/malam\n"
            . "Kualitas tidur (1-10): {$userData['quality_of_sleep']}\n"
            . "Tingkat stres (1-10): {$userData['stress_level']}\n"
            . "Aktivitas fisik: {$userData['physical_activity_level']} menit/hari\n"
            . "BMI kategori: {$userData['bmi_category']}\n"
            . "Heart rate: {$userData['heart_rate']} bpm\n"
            . "Tekanan darah: {$userData['systolic']}/{$userData['diastolic']} mmHg";

        try {
            $url = "https://generativelanguage.googleapis.com/v1beta/models/"
                . "{$this->geminiModel}:generateContent?key={$this->geminiApiKey}";

            $response = Http::timeout(20)->post($url, [
                'contents'         => [['parts' => [['text' => $fullPrompt]]]],
                'generationConfig' => [
                    'temperature'      => 0.3,
                    'maxOutputTokens'  => 600,
                    'responseMimeType' => 'application/json',
                ],
            ]);

            if (!$response->successful()) {
                return $this->fallbackSuggestions($prediction);
            }

            $text    = $response->json('candidates.0.content.parts.0.text') ?? '';
            $text    = trim(preg_replace('/^```json|```$/m', '', $text));
            $decoded = json_decode($text, true);

            if (
                json_last_error() === JSON_ERROR_NONE &&
                isset($decoded['description'], $decoded['suggestions']) &&
                is_array($decoded['suggestions'])
            ) {
                return [
                    'description' => $decoded['description'],
                    'suggestions' => array_slice($decoded['suggestions'], 0, 4),
                ];
            }

            return $this->fallbackSuggestions($prediction);
        } catch (\Exception $e) {
            return $this->fallbackSuggestions($prediction);
        }
    }

    private function fallbackSuggestions(string $prediction): array
    {
        $data = [
            'Healthy' => [
                'description' => 'Kualitas tidurmu baik. Tidak ditemukan indikasi gangguan tidur yang signifikan.',
                'suggestions' => [
                    'Pertahankan jadwal tidur konsisten 7-9 jam/malam (Walker, 2017).',
                    'Hindari kafein minimal 6 jam sebelum tidur (Morin & Benca, 2012).',
                    'Olahraga aerobik 150 menit/minggu untuk menjaga kualitas tidur (Walker, 2017).',
                ],
            ],
            'Insomnia' => [
                'description' => 'Terdeteksi kemungkinan Insomnia — kesulitan memulai atau mempertahankan tidur.',
                'suggestions' => [
                    'Terapkan CBT-I: batasi waktu di tempat tidur hanya saat mengantuk (AASM, 2014).',
                    'Matikan layar minimal 1 jam sebelum tidur (Morin & Benca, 2012).',
                    'Coba journaling 10 menit sebelum tidur untuk menenangkan pikiran (Grandner et al., 2012).',
                ],
            ],
            'Sleep Apnea' => [
                'description' => 'Terdeteksi kemungkinan Sleep Apnea — gangguan pernapasan berulang saat tidur.',
                'suggestions' => [
                    'Segera konsultasikan ke dokter untuk pemeriksaan lebih lanjut (AASM, 2014).',
                    'Coba tidur posisi miring — dapat mengurangi episode apnea hingga 50% (Punjabi, 2008).',
                    'Jaga berat badan ideal karena obesitas meningkatkan risiko OSA 3-4x (Punjabi, 2008).',
                ],
            ],
        ];

        return $data[$prediction] ?? $data['Healthy'];
    }

    public function history(Request $request)
    {
        $userId = $request->query('user_id');

        if (!$userId) {
            return response()->json(['status' => 'error', 'message' => 'user_id diperlukan'], 422);
        }

        $history = PredictionResult::where('user_id', $userId)
            ->orderByDesc('predicted_at')
            ->get(['prediction', 'label', 'confidence', 'description', 'suggestions', 'predicted_at']);

        return response()->json(['status' => 'success', 'history' => $history]);
    }
}