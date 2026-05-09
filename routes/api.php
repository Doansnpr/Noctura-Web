<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

require __DIR__.'/api_jawaban.php';
require __DIR__.'/api_predict.php';

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);