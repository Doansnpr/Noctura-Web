<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/kelola_pertanyaan', function () {
    return view('kelola_pertanyaan');
});
Route::get('/kelola_akun', function () {
    return view('kelola_akun');
});
Route::get('/kelola_edukasi', function () {
    return view('kelola_edukasi');
});
Route::get('/monitoring_prediksi', function () {
    return view('monitoring_prediksi');
});