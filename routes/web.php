<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\MonitoringPrediksiController;
use App\Http\Controllers\VisualisasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/pertanyaan', [PertanyaanController::class, 'index'])->name('pertanyaan')->middleware('auth');
Route::get('/jawaban', [JawabanController::class, 'index'])->name('jawaban')->middleware('auth');
Route::get('/monitoring', [MonitoringPrediksiController::class, 'index'])->name('monitoring')->middleware('auth');
Route::get('/visualisasi', [VisualisasiController::class, 'index'])->name('visualisasi')->middleware('auth');
Route::delete('/monitoring-prediksi/{id}', [MonitoringPrediksiController::class, 'destroy'])->middleware('auth');


Route::get('/auth/login', [LoginController::class, 'index'])->name('login');
Route::post('/auth/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
 

Route::get('/edukasi', [EdukasiController::class, 'index'])->name('edukasi.index')->middleware('auth');
Route::post('/edukasi', [EdukasiController::class, 'store']);
Route::put('/edukasi/{id}', [EdukasiController::class, 'update']);
Route::delete('/edukasi/{id}', [EdukasiController::class, 'destroy']);

Route::get('/akun', [AkunController::class, 'index'])->name('akun.index')->middleware('auth');
Route::post('/akun', [AkunController::class, 'store']);
Route::put('/akun/{id}', [AkunController::class, 'update']);
Route::delete('/akun/{id}', [AkunController::class, 'destroy']);

Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
Route::post('/forgot-password/send', [ForgotPasswordController::class, 'sendOtp'])->name('forgot-password.send');
Route::get('/forgot-password/verify', [ForgotPasswordController::class, 'verifyForm'])->name('forgot-password.verify');
Route::post('/forgot-password/verify', [ForgotPasswordController::class, 'verifyOtp'])->name('forgot-password.verify.post');
Route::get('/forgot-password/reset', [ForgotPasswordController::class, 'resetForm'])->name('forgot-password.reset');
Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('forgot-password.reset.post');
