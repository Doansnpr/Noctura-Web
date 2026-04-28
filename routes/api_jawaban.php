<?php
use App\Http\Controllers\Api\JawabanController;
use Illuminate\Support\Facades\Route;

Route::prefix('jawaban')->group(function () {
    Route::get('/',                          [JawabanController::class, 'index']);
    Route::post('/',                         [JawabanController::class, 'store']);
    Route::post('/bulk',                     [JawabanController::class, 'bulkStore']);
    Route::get('/by-pertanyaan/{pertanyaan_id}', [JawabanController::class, 'byPertanyaan']);
    Route::get('/{id}',                      [JawabanController::class, 'show']);
    Route::put('/{id}',                      [JawabanController::class, 'update']);
    Route::patch('/{id}',                    [JawabanController::class, 'update']);
    Route::delete('/{id}',                   [JawabanController::class, 'destroy']);
});