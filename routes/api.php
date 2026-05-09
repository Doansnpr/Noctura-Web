<?php
// routes/api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController; 
use App\Http\Controllers\Api\EdukasiController;

// ─── KODE TEMAN (JANGAN DIUBAH) ───────────────────────────
Route::get('/user', [AuthController::class, 'me']);


// API Edukasi
Route::get('edukasi/published', [EdukasiController::class, 'published']);
Route::get('edukasi/kategori/{kategori}', [EdukasiController::class, 'byCategory']);
Route::apiResource('edukasi', EdukasiController::class);

require __DIR__.'/api_jawaban.php';
require __DIR__.'/api_predict.php';
// ──────────────────────────────────────────────────────────

// ─── TAMBAHAN BARU ────────────────────────────────────────
// Pakai full class path, tidak perlu register di Kernel/bootstrap
Route::middleware(\App\Http\Middleware\ApiAuthenticate::class)->group(function () {
    Route::get('/profile',             [ProfileController::class, 'show']);
    Route::put('/profile',             [ProfileController::class, 'update']);
    Route::put('/profile/password',    [ProfileController::class, 'updatePassword']);
    Route::put('/profile/sleep-goal',  [ProfileController::class, 'updateSleepGoal']);
    Route::put('/profile/preferences', [ProfileController::class, 'updatePreferences']);
});