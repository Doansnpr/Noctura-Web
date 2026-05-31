<?php

// Tambahkan binding ini di dalam method register() pada AppServiceProvider.php
// app/Providers/AppServiceProvider.php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Repositories\PredictionHistoryRepository;
use App\Services\PredictionHistoryService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Existing bindings...

        // Prediction History
        $this->app->singleton(PredictionHistoryRepository::class);
        $this->app->singleton(PredictionHistoryService::class);
    }

    public function boot(): void
    {
        View::composer('layouts.dashboard', function ($view) {
            $notifications = collect();
            $todayCount = 0;

            // ================= NOTIFIKASI PREDIKSI TERBARU =================
            try {
                if (class_exists(\App\Models\Monitoring::class)) {
                    $predictionResults = \App\Models\Monitoring::raw(function ($collection) {
                        return $collection->find([], [
                            'sort' => ['created_at' => -1],
                            'limit' => 5,
                        ]);
                    });

                    foreach ($predictionResults as $item) {
                        $data = json_decode(json_encode($item), true);

                        $createdAt = $this->toCarbonSafe(
                            $data['created_at'] ?? $data['predicted_at'] ?? null
                        );

                        if ($createdAt && $createdAt->isToday()) {
                            $todayCount++;
                        }

                        $prediction = $data['prediction'] ?? '-';
                        $label = $data['label'] ?? 'Hasil prediksi baru';
                        $userId = $data['user_id'] ?? '-';

                        $notifications->push([
                            'type' => 'prediction',
                            'title' => 'Prediksi baru',
                            'message' => $prediction . ' - ' . $label,
                            'meta' => 'User: ' . $userId,
                            'time' => $createdAt ? $createdAt->diffForHumans() : '-',
                            'timestamp' => $createdAt ? $createdAt->timestamp : 0,
                            'url' => route('monitoring-prediksi.index'),
                        ]);
                    }
                }
            } catch (\Throwable $e) {
                //
            }

            // ================= NOTIFIKASI USER BARU =================
            try {
                if (class_exists(\App\Models\Akun::class)) {
                    $newUsers = \App\Models\Akun::orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();

                    foreach ($newUsers as $user) {
                        $createdAt = $this->toCarbonSafe($user->created_at ?? null);

                        if ($createdAt && $createdAt->isToday()) {
                            $todayCount++;
                        }

                        $name = $user->name
                            ?? $user->username
                            ?? $user->email
                            ?? 'Pengguna baru';

                        $notifications->push([
                            'type' => 'user',
                            'title' => 'User baru',
                            'message' => $name,
                            'meta' => $user->email ?? 'Akun baru terdaftar',
                            'time' => $createdAt ? $createdAt->diffForHumans() : '-',
                            'timestamp' => $createdAt ? $createdAt->timestamp : 0,
                            'url' => route('akun.index'),
                        ]);
                    }
                }
            } catch (\Throwable $e) {
                //
            }

            $notifications = $notifications
                ->sortByDesc('timestamp')
                ->take(6)
                ->values();

            $view->with([
                'topbarNotifications' => $notifications,
                'topbarNotificationCount' => $todayCount,
            ]);
        });
    }

    private function toCarbonSafe($date): ?Carbon
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
}