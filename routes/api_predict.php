<?php

use App\Http\Controllers\SleepPredictionController;
use Illuminate\Support\Facades\Route;

Route::post('/predict', [SleepPredictionController::class, 'predict']);