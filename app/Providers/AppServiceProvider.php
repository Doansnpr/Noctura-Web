<?php

// Tambahkan binding ini di dalam method register() pada AppServiceProvider.php
// app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        //
    }
}