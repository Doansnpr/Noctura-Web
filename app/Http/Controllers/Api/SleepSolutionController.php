<?php
// app/Http/Controllers/Api/SleepSolutionController.php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\PredictionResult;

class SleepSolutionController extends \App\Http\Controllers\Controller
{
    private const GEMINI_MODEL    = 'gemini-2.0-flash';
    private const GEMINI_BASE_URL = 'https://generativelanguage.googleapis.com/v1beta/models';

    private readonly string $geminiApiKey;

    public function __construct()
    {
        $this->geminiApiKey = config('services.gemini.api_key', '');
    }

    // ── POST /api/v1/predictions/{id}/solution ────────────────────────────────
    public function generate(Request $request, string $id): JsonResponse
    {
        // FIX: cari record by _id tanpa ownership check yang crash
        $record = PredictionResult::where('_id', $id)->first();

        if (!$record) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Prediksi tidak ditemukan.',
            ], 404);
        }

        // FIX: ownership check aman — hanya jika user login, bandingkan sebagai string
        // MongoDB menyimpan user_id sebagai string "69feb30030772a6beb089e12"
        // akun._id adalah ObjectId — keduanya di-cast ke string untuk perbandingan
        $user = $request->user();
        if ($user) {
            $userId       = (string) ($user->_id ?? $user->id ?? '');
            $recordUserId = (string) ($record->user_id ?? '');

            if ($userId !== $recordUserId) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Akses tidak diizinkan.',
                ], 403);
            }
        }

        // Kembalikan cache jika solusi sudah pernah digenerate
        if (!empty($record->solution)) {
            return response()->json([
                'status' => 'success',
                'cached' => true,
                'data'   => $this->buildResponse($record, $record->solution),
            ]);
        }

        try {
            $solution = $this->callGemini($record);
            $record->update(['solution' => $solution]);

            return response()->json([
                'status' => 'success',
                'cached' => false,
                'data'   => $this->buildResponse($record, $solution),
            ]);

        } catch (\Exception $e) {
            Log::error('[Solution] Gemini call failed', [
                'prediction_id' => $id,
                'error'         => $e->getMessage(),
            ]);

            $fallback = $this->fallbackSolution($record->prediction);
            return response()->json([
                'status' => 'success',
                'cached' => false,
                'data'   => $this->buildResponse($record, $fallback),
            ]);
        }
    }

    private function callGemini(PredictionResult $record): array
{
    if (empty($this->geminiApiKey)) {
        throw new \RuntimeException('GEMINI_API_KEY tidak dikonfigurasi');
    }

    $prompt = $this->buildPrompt($record);
    $url = sprintf('%s/%s:generateContent?key=%s',
        self::GEMINI_BASE_URL, self::GEMINI_MODEL, $this->geminiApiKey
    );

    // FIX: retry 2x dengan delay 3 detik jika 429
    $maxRetry = 2;
    for ($attempt = 0; $attempt <= $maxRetry; $attempt++) {
        $response = Http::timeout(25)->post($url, [
            'contents'         => [['parts' => [['text' => $prompt]]]],
            'generationConfig' => [
                'temperature'      => 0.4,
                'maxOutputTokens'  => 900,
                'responseMimeType' => 'application/json',
            ],
        ]);

        // Retry jika 429, langsung throw jika error lain
        if ($response->status() === 429 && $attempt < $maxRetry) {
            sleep(3);
            continue;
        }

        if (!$response->successful()) {
            throw new \RuntimeException("Gemini API error: {$response->status()}");
        }

        $raw     = $response->json('candidates.0.content.parts.0.text') ?? '';
        $cleaned = trim(preg_replace('/^```json|```$/m', '', $raw));
        $decoded = json_decode($cleaned, true);

        if (
            json_last_error() !== JSON_ERROR_NONE ||
            !isset($decoded['overview'], $decoded['steps'], $decoded['lifestyle'], $decoded['when_to_see_doctor'])
        ) {
            Log::warning('[Solution] Gemini response tidak valid', ['raw' => $raw]);
            throw new \RuntimeException('Gemini response tidak valid');
        }

        return $decoded;
    }

    throw new \RuntimeException('Gemini API error: 429 setelah retry');
}

    private function buildResponse(PredictionResult $record, array $solution): array
    {
        return [
            'prediction_id'      => (string) $record->_id,
            'prediction'         => $record->prediction,
            'label'              => $record->label,
            'overview'           => $solution['overview'],
            'steps'              => array_slice($solution['steps'], 0, 5),
            'lifestyle'          => array_slice($solution['lifestyle'], 0, 5),
            'when_to_see_doctor' => $solution['when_to_see_doctor'],
        ];
    }

    private function buildPrompt(PredictionResult $record): string
    {
        $inputData  = $record->input_data ?? [];
        $prediction = $record->prediction;

        $systemPrompt = <<<'PROMPT'
Kamu adalah dokter spesialis tidur berbasis literatur ilmiah terkini.
Tugasmu membuat rencana solusi terstruktur dan personal untuk pasien berdasarkan diagnosis gangguan tidur.

[LANDASAN KLINIS]
- AASM ICSD-3 (2014): CBT-I adalah first-line untuk insomnia. CPAP untuk Sleep Apnea AHI ≥5/jam.
- Morin & Benca, Lancet (2012): Sleep restriction therapy, stimulus control, sleep hygiene.
- Walker (2017) "Why We Sleep": Konsistensi jadwal tidur, aerobik 150 menit/minggu, hindari alkohol.
- Epstein & Mardon (2007): Progressive Muscle Relaxation & mindfulness turunkan arousal pre-tidur.
- Punjabi (2008): Posisi miring kurangi apnea 50%. Penurunan berat badan kurangi AHI secara signifikan.
- Grandner et al. (2012): Journaling dan manajemen stres adalah intervensi utama insomnia psikofisiologis.

[FORMAT RESPONS — JSON ONLY, tanpa markdown, tanpa backtick]
{
  "overview": "2-3 kalimat ringkasan kondisi dan pendekatan solusi secara personal",
  "steps": [
    {
      "title": "Nama langkah singkat",
      "detail": "Penjelasan praktis dan actionable, sesuaikan dengan data user",
      "source": "Nama literatur singkat"
    }
  ],
  "lifestyle": [
    "Perubahan kebiasaan 1 yang spesifik",
    "Perubahan kebiasaan 2 yang spesifik"
  ],
  "when_to_see_doctor": "Kondisi spesifik kapan user harus segera ke dokter"
}

Hasilkan tepat 4-5 steps dan 4-5 lifestyle. Gunakan bahasa Indonesia. Sesuaikan dengan data user.
PROMPT;

        $age      = $inputData['age']                     ?? '-';
        $gender   = $inputData['gender']                  ?? '-';
        $sleep    = $inputData['sleep_duration']          ?? '-';
        $quality  = $inputData['quality_of_sleep']        ?? '-';
        $stress   = $inputData['stress_level']            ?? '-';
        $activity = $inputData['physical_activity_level'] ?? '-';
        $bmi      = $inputData['bmi_category']            ?? '-';
        $hr       = $inputData['heart_rate']              ?? '-';
        $sys      = $inputData['systolic']                ?? '-';
        $dia      = $inputData['diastolic']               ?? '-';

        return $systemPrompt . "\n\n[DATA PASIEN]\n"
            . "Diagnosis: {$prediction}\n"
            . "Usia: {$age} tahun | Gender: {$gender}\n"
            . "Durasi tidur: {$sleep} jam/malam | Kualitas: {$quality}/10\n"
            . "Tingkat stres: {$stress}/10 | Aktivitas fisik: {$activity} menit/hari\n"
            . "BMI: {$bmi} | Heart rate: {$hr} bpm | Tekanan darah: {$sys}/{$dia} mmHg";
    }

    private function fallbackSolution(string $prediction): array
    {
        $data = [
            'None' => [
                'overview'           => 'Kondisi tidurmu saat ini terbilang sehat. Fokus pada mempertahankan kebiasaan baik yang sudah ada.',
                'steps'              => [
                    ['title' => 'Pertahankan Jadwal Tidur',    'detail' => 'Tidur dan bangun di jam yang sama setiap hari termasuk akhir pekan.',   'source' => 'Walker, 2017'],
                    ['title' => 'Optimalkan Lingkungan Tidur', 'detail' => 'Pastikan suhu kamar 18-20°C, gelap, dan bebas suara.',                  'source' => 'Morin & Benca, 2012'],
                    ['title' => 'Rutin Olahraga',              'detail' => 'Lakukan aerobik minimal 150 menit/minggu untuk kualitas tidur optimal.', 'source' => 'Walker, 2017'],
                ],
                'lifestyle'          => [
                    'Hindari kafein minimal 6 jam sebelum tidur.',
                    'Matikan layar 1 jam sebelum tidur.',
                    'Jaga konsistensi jadwal tidur meski akhir pekan.',
                ],
                'when_to_see_doctor' => 'Jika mulai mengalami kesulitan tidur lebih dari 3 malam/minggu selama 1 bulan.',
            ],
            'Healthy' => [
                'overview'           => 'Kondisi tidurmu saat ini terbilang sehat. Fokus pada mempertahankan kebiasaan baik yang sudah ada.',
                'steps'              => [
                    ['title' => 'Pertahankan Jadwal Tidur',    'detail' => 'Tidur dan bangun di jam yang sama setiap hari termasuk akhir pekan.',   'source' => 'Walker, 2017'],
                    ['title' => 'Optimalkan Lingkungan Tidur', 'detail' => 'Pastikan suhu kamar 18-20°C, gelap, dan bebas suara.',                  'source' => 'Morin & Benca, 2012'],
                    ['title' => 'Rutin Olahraga',              'detail' => 'Lakukan aerobik minimal 150 menit/minggu untuk kualitas tidur optimal.', 'source' => 'Walker, 2017'],
                ],
                'lifestyle'          => [
                    'Hindari kafein minimal 6 jam sebelum tidur.',
                    'Matikan layar 1 jam sebelum tidur.',
                    'Jaga konsistensi jadwal tidur meski akhir pekan.',
                ],
                'when_to_see_doctor' => 'Jika mulai mengalami kesulitan tidur lebih dari 3 malam/minggu selama 1 bulan.',
            ],
            'Insomnia' => [
                'overview'           => 'Insomnia yang kamu alami memerlukan pendekatan bertahap. CBT-I terbukti lebih efektif daripada obat tidur jangka panjang.',
                'steps'              => [
                    ['title' => 'Sleep Restriction Therapy',     'detail' => 'Batasi waktu di tempat tidur sesuai rata-rata jam tidur efektif untuk meningkatkan sleep drive.',        'source' => 'Morin & Benca, 2012'],
                    ['title' => 'Stimulus Control',              'detail' => 'Gunakan tempat tidur hanya untuk tidur. Jika tidak bisa tidur 20 menit, segera keluar kamar.',           'source' => 'AASM, 2014'],
                    ['title' => 'Journaling Malam',              'detail' => 'Tulis semua pikiran yang mengganggu selama 10 menit sebelum tidur untuk mengurangi intrusive thoughts.', 'source' => 'Grandner et al., 2012'],
                    ['title' => 'Progressive Muscle Relaxation', 'detail' => 'Lakukan PMR 15 menit sebelum tidur untuk menurunkan arousal fisik dan mental.',                         'source' => 'Epstein & Mardon, 2007'],
                ],
                'lifestyle'          => [
                    'Matikan semua layar minimal 1 jam sebelum tidur.',
                    'Hindari tidur siang lebih dari 20 menit.',
                    'Kurangi kafein dan alkohol terutama setelah jam 2 siang.',
                    'Olahraga rutin di pagi/siang hari, hindari malam hari.',
                ],
                'when_to_see_doctor' => 'Jika insomnia berlangsung lebih dari 3 bulan atau mengganggu aktivitas harian secara signifikan.',
            ],
            'Sleep Apnea' => [
                'overview'           => 'Sleep Apnea memerlukan evaluasi medis untuk menentukan tingkat keparahan. Penanganan dini mencegah komplikasi kardiovaskular.',
                'steps'              => [
                    ['title' => 'Konsultasi Dokter Segera',  'detail' => 'Minta rujukan ke sleep specialist untuk polysomnography guna mengukur AHI secara akurat.',          'source' => 'AASM, 2014'],
                    ['title' => 'Posisi Tidur Miring',       'detail' => 'Tidur posisi lateral (miring) dapat mengurangi episode apnea hingga 50% pada kasus ringan-sedang.', 'source' => 'Punjabi, 2008'],
                    ['title' => 'Manajemen Berat Badan',     'detail' => 'Penurunan berat badan 10% dapat menurunkan AHI secara signifikan pada pasien obesitas.',             'source' => 'Punjabi, 2008'],
                    ['title' => 'Hindari Alkohol & Sedatif', 'detail' => 'Alkohol dan obat penenang merelaksasi otot tenggorokan dan memperparah obstruksi saluran napas.',   'source' => 'Walker, 2017'],
                ],
                'lifestyle'          => [
                    'Tidur dengan posisi miring menggunakan bantal penyangga.',
                    'Hindari alkohol terutama 3 jam sebelum tidur.',
                    'Jaga berat badan ideal dengan diet dan olahraga teratur.',
                    'Berhenti merokok karena meningkatkan inflamasi saluran napas atas.',
                ],
                'when_to_see_doctor' => 'Segera konsultasikan jika sering terbangun tiba-tiba, mengantuk berlebihan di siang hari, atau pasangan melaporkan henti napas saat tidur.',
            ],
        ];

        return $data[$prediction] ?? $data['None'];
    }
}