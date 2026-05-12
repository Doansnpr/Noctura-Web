<?php

// routes/api_history.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PredictionHistoryController;

Route::middleware(\App\Http\Middleware\ApiAuthenticate::class)
    ->prefix('v1/predictions')
    ->group(function () {
        Route::get('/history/summary', [PredictionHistoryController::class, 'summary']);
        Route::get('/history',         [PredictionHistoryController::class, 'index']);
        Route::get('/history/{id}',    [PredictionHistoryController::class, 'show']);
        Route::delete('/history/{id}', [PredictionHistoryController::class, 'destroy']);
    });