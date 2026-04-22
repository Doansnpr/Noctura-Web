<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\MonitoringPrediksiController;
use App\Http\Controllers\VisualisasiController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/akun', [AkunController::class, 'index'])->name('akun');
Route::get('/edukasi', [EdukasiController::class, 'index'])->name('edukasi');
Route::get('/pertanyaan', [PertanyaanController::class, 'index'])->name('pertanyaan');
Route::get('/jawaban', [JawabanController::class, 'index'])->name('jawaban');
Route::get('/monitoring', [MonitoringPrediksiController::class, 'index'])->name('monitoring');
Route::get('/visualisasi', [VisualisasiController::class, 'index'])->name('visualisasi');

