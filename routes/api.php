<?php

use App\Http\Controllers\Api\KunjunganController;
use App\Http\Controllers\Api\PasienController;
use App\Http\Controllers\Api\TransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public API Routes (without authentication)
Route::prefix('v1')->group(function () {
    // Pasien API
    Route::apiResource('pasien', PasienController::class);

    // Kunjungan API
    Route::apiResource('kunjungan', KunjunganController::class);

    // Transaksi API
    Route::apiResource('transaksi', TransaksiController::class);
});
