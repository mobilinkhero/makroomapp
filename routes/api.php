<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ConfigController;
use App\Http\Controllers\Api\SearchController;

Route::get('/config', [ConfigController::class, 'index']);
Route::post('/search', [SearchController::class, 'search']);

Route::get('/health', function() {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toIso8601String()
    ]);
});
