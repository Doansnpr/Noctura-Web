<?php
// routes/api_predict.php

use App\Http\Controllers\Api\SleepPredictionController;  // ← tambah Api
use Illuminate\Support\Facades\Route;

Route::post('/predict', [SleepPredictionController::class, 'predict']);
