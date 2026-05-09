<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EdukasiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// API Edukasi
Route::get('edukasi/published', [EdukasiController::class, 'published']);
Route::get('edukasi/kategori/{kategori}', [EdukasiController::class, 'byCategory']);
Route::apiResource('edukasi', EdukasiController::class);

require __DIR__.'/api_jawaban.php';
require __DIR__.'/api_predict.php';
