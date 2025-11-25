<?php

use App\Http\Controllers\Api\AntrianController;
use App\Http\Controllers\Api\JadwalDokterController;
use App\Http\Controllers\Api\KunjunganController;
use App\Http\Controllers\Api\MasterPenjaminController;
use App\Http\Controllers\Api\MasterPoliController;
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
    Route::get('pasien/search/{no_rm}', [PasienController::class, 'searchByNoRM']);
    Route::apiResource('pasien', PasienController::class);

    // Kunjungan API
    Route::apiResource('kunjungan', KunjunganController::class);

    // Transaksi API
    Route::apiResource('transaksi', TransaksiController::class);

    // Jadwal Dokter API
    Route::get('jadwal-dokter', [JadwalDokterController::class, 'index']);
    Route::get('jadwal-dokter/{id}', [JadwalDokterController::class, 'show']);

    // Antrian API
    Route::get('antrian', [AntrianController::class, 'index']);
    Route::post('antrian', [AntrianController::class, 'store']);
    Route::get('antrian/{id}', [AntrianController::class, 'show']);
    Route::delete('antrian/{id}', [AntrianController::class, 'destroy']);

    // Master Poli API
    Route::get('master-poli', [MasterPoliController::class, 'index']);

    // Master Penjamin API
    Route::get('master-penjamin', [MasterPenjaminController::class, 'index']);
});

