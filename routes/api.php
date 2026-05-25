<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\EdukasiController;
use App\Http\Controllers\Api\MobileAuthController;
use App\Http\Controllers\Api\SleepPredictionController;
use App\Http\Controllers\Api\SleepSolutionController;
use App\Http\Controllers\Api\MobileVisualisasiController; 

// ─── KODE TEMAN (JANGAN DIUBAH) ───────────────────────────────────────────────
Route::get('/user', [AuthController::class, 'me']);

Route::get('edukasi/published', [EdukasiController::class, 'published']);
Route::get('edukasi/kategori/{kategori}', [EdukasiController::class, 'byCategory']);
Route::apiResource('edukasi', EdukasiController::class);

require __DIR__.'/api_jawaban.php';
require __DIR__.'/api_predict.php';
require __DIR__.'/api_history.php';

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/image/{path}', function ($path) {
    $fullPath = storage_path('app/public/' . $path);
    if (!file_exists($fullPath)) {
        return response()->json(['error' => 'Image not found'], 404);
    }
    return response()->file($fullPath, [
        'Access-Control-Allow-Origin' => '*',
        'Cache-Control' => 'public, max-age=86400',
    ]);
})->where('path', '.*');

// ─── TAMBAHAN BARU ────────────────────────────────────────────────────────────
Route::middleware('throttle:5,1')->post('/mobile/login', [MobileAuthController::class, 'login']);
Route::post('/mobile/logout', [MobileAuthController::class, 'logout']);

Route::middleware(\App\Http\Middleware\ApiAuthenticate::class)->group(function () {

    // Profile
    Route::get('/profile',             [ProfileController::class, 'show']);
    Route::put('/profile',             [ProfileController::class, 'update']);
    Route::put('/profile/password',    [ProfileController::class, 'updatePassword']);
    Route::put('/profile/email',       [ProfileController::class, 'updateEmail']);
    Route::put('/profile/sleep-goal',  [ProfileController::class, 'updateSleepGoal']);
    Route::put('/profile/preferences', [ProfileController::class, 'updatePreferences']);

    Route::prefix('v1')->group(function () {
        Route::prefix('predictions')->group(function () {
            Route::post('/',              [SleepPredictionController::class, 'predict']);
            Route::get('/history',        [SleepPredictionController::class, 'history']);
            Route::get('/{id}',           [SleepPredictionController::class, 'show']);
            Route::post('/{id}/solution', [SleepSolutionController::class,   'generate']);
        });
    });
    Route::get('/mobile-chart-data', [MobileVisualisasiController::class, 'getChartData']);
});

// ─── VISUALISASI MOBILE ───────────────────────────────────────────────────────
