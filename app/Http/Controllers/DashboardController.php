<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        $prediksi = $this->getPredictionData();

        $totalPengguna = $this->safeCount(\App\Models\Akun::class);
        $totalPrediksi = $prediksi->count();
        $totalEdukasi  = $this->safeCount(\App\Models\Edukasi::class);

        $today = Carbon::today();

        $prediksiHariIni = $prediksi->filter(function ($item) use ($today) {
            $date = $this->toCarbon($item['tanggal_prediksi'] ?? null);
            return $date && $date->isSameDay($today);
        })->count();

        $healthy = $prediksi->where('prediction_key', 'healthy')->count();
        $insomnia = $prediksi->where('prediction_key', 'insomnia')->count();
        $sleepApnea = $prediksi->where('prediction_key', 'sleep_apnea')->count();

        $artikelPublished = $this->safeWhereCount(\App\Models\Edukasi::class, 'status_publish', true);
        $artikelDraft = max($totalEdukasi - $artikelPublished, 0);

        $kpi = [
            'total_pengguna' => $totalPengguna,
            'total_prediksi' => $totalPrediksi,
            'total_edukasi' => $totalEdukasi,
            'prediksi_hari_ini' => $prediksiHariIni,
            'healthy' => $healthy,
            'insomnia' => $insomnia,
            'sleep_apnea' => $sleepApnea,
            'indikasi_gangguan' => $insomnia + $sleepApnea,
            'artikel_published' => $artikelPublished,
            'artikel_draft' => $artikelDraft,
        ];

        $monthlyDistribution = $this->buildMonthlyDistribution($prediksi);
        $caseProfile = $this->buildCaseProfile($totalPrediksi, $healthy, $insomnia, $sleepApnea);

        $recentPredictions = $prediksi
            ->sortByDesc(function ($item) {
                $date = $this->toCarbon($item['tanggal_prediksi'] ?? null);
                return $date ? $date->timestamp : 0;
            })
            ->take(6)
            ->values();

        $recentArticles = $this->getRecentArticles();

        return view('dashboard.index', compact(
            'kpi',
            'monthlyDistribution',
            'caseProfile',
            'recentPredictions',
            'recentArticles'
        ));
    }

    private function getPredictionData(): Collection
    {
        if (!class_exists(\App\Models\Monitoring::class)) {
            return collect();
        }

        try {
            $results = \App\Models\Monitoring::raw(function ($collection) {
                return $collection->find([], [
                    'sort' => ['created_at' => -1],
                ]);
            });

            return collect($results)->map(function ($item) {
                return $this->formatPredictionItem($item);
            })->values();
        } catch (\Throwable $e) {
            return collect();
        }
    }

    private function formatPredictionItem($item): array
    {
        $item = $this->toArraySafe($item);

        $prediction = $item['prediction'] ?? '-';
        $predictionKey = $this->normalizePredictionKey($prediction);

        $confidence = $this->decodeJsonField($item['confidence'] ?? []);
        $confidenceUtama = $this->getMainConfidence($prediction, $confidence);

        $tanggal = $item['predicted_at'] ?? $item['created_at'] ?? null;

        return [
            'id' => $this->stringId($item['_id'] ?? ''),
            'user_id' => $item['user_id'] ?? '-',
            'prediction' => $this->labelPrediction($predictionKey, $prediction),
            'prediction_key' => $predictionKey,
            'label' => $item['label'] ?? '-',
            'confidence' => $confidence,
            'confidence_utama' => $confidenceUtama,
            'description' => $item['description'] ?? '-',
            'suggestions' => $this->decodeJsonField($item['suggestions'] ?? []),
            'input_data' => $this->decodeJsonField($item['input_data'] ?? []),
            'tanggal_prediksi' => $tanggal,
            'tanggal_tampil' => $this->formatDate($tanggal),
        ];
    }

    private function getRecentArticles(): Collection
    {
        if (!class_exists(\App\Models\Edukasi::class)) {
            return collect();
        }

        try {
            return \App\Models\Edukasi::orderBy('created_at', 'desc')
                ->take(5)
                ->get()
                ->map(function ($item) {
                    return [
                        'judul' => $item->judul_artikel ?? '-',
                        'kategori' => $this->labelKategoriEdukasi($item->kategori_gangguan_tidur ?? '-'),
                        'status' => ($item->status_publish ?? false) ? 'Published' : 'Draft',
                        'tanggal' => $this->formatDate($item->created_at ?? null),
                    ];
                });
        } catch (\Throwable $e) {
            return collect();
        }
    }

    private function buildMonthlyDistribution(Collection $prediksi): array
    {
        $months = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $key = $date->format('Y-m');

            $months[$key] = [
                'label' => $date->translatedFormat('M Y'),
                'healthy' => 0,
                'insomnia' => 0,
                'sleep_apnea' => 0,
            ];
        }

        foreach ($prediksi as $item) {
            $date = $this->toCarbon($item['tanggal_prediksi'] ?? null);

            if (!$date) {
                continue;
            }

            $key = $date->format('Y-m');

            if (!isset($months[$key])) {
                continue;
            }

            $predictionKey = $item['prediction_key'] ?? '-';

            if (isset($months[$key][$predictionKey])) {
                $months[$key][$predictionKey]++;
            }
        }

        return array_values($months);
    }

    private function buildCaseProfile(int $total, int $healthy, int $insomnia, int $sleepApnea): array
    {
        return [
            [
                'label' => 'Tidur Sehat',
                'key' => 'healthy',
                'count' => $healthy,
                'percent' => $total > 0 ? round(($healthy / $total) * 100, 1) : 0,
            ],
            [
                'label' => 'Insomnia',
                'key' => 'insomnia',
                'count' => $insomnia,
                'percent' => $total > 0 ? round(($insomnia / $total) * 100, 1) : 0,
            ],
            [
                'label' => 'Sleep Apnea',
                'key' => 'sleep_apnea',
                'count' => $sleepApnea,
                'percent' => $total > 0 ? round(($sleepApnea / $total) * 100, 1) : 0,
            ],
        ];
    }

    private function safeCount(string $modelClass): int
    {
        if (!class_exists($modelClass)) {
            return 0;
        }

        try {
            return $modelClass::count();
        } catch (\Throwable $e) {
            return 0;
        }
    }

    private function safeWhereCount(string $modelClass, string $field, $value): int
    {
        if (!class_exists($modelClass)) {
            return 0;
        }

        try {
            return $modelClass::where($field, $value)->count();
        } catch (\Throwable $e) {
            return 0;
        }
    }

    private function normalizePredictionKey($prediction): string
    {
        $value = strtolower(trim((string) $prediction));
        $value = str_replace(['-', ' '], '_', $value);

        if (in_array($value, ['healthy', 'normal', 'sehat'])) {
            return 'healthy';
        }

        if (str_contains($value, 'insomnia')) {
            return 'insomnia';
        }

        if (str_contains($value, 'apnea')) {
            return 'sleep_apnea';
        }

        return $value ?: '-';
    }

    private function labelPrediction(string $key, string $fallback = '-'): string
    {
        return match ($key) {
            'healthy' => 'Healthy',
            'insomnia' => 'Insomnia',
            'sleep_apnea' => 'Sleep Apnea',
            default => $fallback ?: '-',
        };
    }


    private function labelKategoriEdukasi($kategori): string
    {
        return match ($kategori) {
            'healthy' => 'Healthy',
            'insomnia' => 'Insomnia',
            'sleep_apnea' => 'Sleep Apnea',
            default => $kategori ?: '-',
        };
    }

    private function decodeJsonField($value)
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_object($value)) {
            return json_decode(json_encode($value), true) ?: [];
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return json_last_error() === JSON_ERROR_NONE ? $decoded : [];
        }

        return [];
    }

    private function getMainConfidence($prediction, $confidence): float
    {
        if (!is_array($confidence) || empty($confidence)) {
            return 0;
        }

        $possibleKeys = [
            $prediction,
            ucfirst(strtolower((string) $prediction)),
            strtolower((string) $prediction),
            str_replace('_', ' ', (string) $prediction),
            str_replace(' ', '_', (string) $prediction),
        ];

        foreach ($possibleKeys as $key) {
            if (isset($confidence[$key])) {
                return $this->toPercent($confidence[$key]);
            }
        }

        $values = array_map(function ($value) {
            return is_numeric($value) ? (float) $value : 0;
        }, $confidence);

        return $this->toPercent(max($values));
    }

    private function toPercent($value): float
    {
        $value = is_numeric($value) ? (float) $value : 0;

        if ($value <= 1) {
            $value *= 100;
        }

        return round($value, 1);
    }

    private function toArraySafe($value): array
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_object($value)) {
            return json_decode(json_encode($value), true) ?: [];
        }

        return [];
    }

    private function stringId($id): string
    {
        if (is_array($id) && isset($id['$oid'])) {
            return (string) $id['$oid'];
        }

        if (is_object($id) && method_exists($id, '__toString')) {
            return (string) $id;
        }

        return (string) $id;
    }

    private function toCarbon($date): ?Carbon
    {
        try {
            if (!$date) {
                return null;
            }

            if ($date instanceof Carbon) {
                return $date;
            }

            if ($date instanceof \DateTimeInterface) {
                return Carbon::instance($date);
            }

            if (is_object($date) && method_exists($date, 'toDateTime')) {
                return Carbon::instance($date->toDateTime());
            }

            if (is_array($date) && isset($date['$date'])) {
                if (is_array($date['$date']) && isset($date['$date']['$numberLong'])) {
                    return Carbon::createFromTimestampMs((int) $date['$date']['$numberLong']);
                }

                return Carbon::parse($date['$date']);
            }

            return Carbon::parse($date);
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function formatDate($date): string
    {
        $carbon = $this->toCarbon($date);

        if (!$carbon) {
            return '-';
        }

        return $carbon->translatedFormat('d M Y, H:i');
    }
}
