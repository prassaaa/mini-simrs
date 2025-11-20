<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        $totalPasien = \App\Models\Pasien::count();
        $totalDokter = \App\Models\MasterDokter::count();
        $totalKunjungan = \App\Models\Kunjungan::count();
        $totalTransaksi = \App\Models\Transaksi::count();

        // Kunjungan hari ini
        $kunjunganHariIni = \App\Models\Kunjungan::whereDate('tanggal_kunjungan', today())->count();

        // Total pendapatan
        $totalPendapatan = \App\Models\Transaksi::sum('total_harga');

        // Kunjungan terbaru (5 terakhir)
        $kunjunganTerbaru = \App\Models\Kunjungan::with(['pasien', 'dokter', 'poliRelation'])
            ->latest('tanggal_kunjungan')
            ->take(5)
            ->get();

        // Statistik per instalasi
        $statistikInstalasi = \App\Models\Kunjungan::selectRaw('instalasi, COUNT(*) as total')
            ->groupBy('instalasi')
            ->get();

        return Inertia::render('dashboard', [
            'stats' => [
                'totalPasien' => $totalPasien,
                'totalDokter' => $totalDokter,
                'totalKunjungan' => $totalKunjungan,
                'totalTransaksi' => $totalTransaksi,
                'kunjunganHariIni' => $kunjunganHariIni,
                'totalPendapatan' => $totalPendapatan,
            ],
            'kunjunganTerbaru' => $kunjunganTerbaru,
            'statistikInstalasi' => $statistikInstalasi,
        ]);
    })->name('dashboard');

    // Routes untuk Pasien
    Route::resource('pasien', \App\Http\Controllers\PasienController::class);

    // Routes untuk Master Data
    Route::resource('master-dokter', \App\Http\Controllers\MasterDokterController::class);
    Route::resource('master-poli', \App\Http\Controllers\MasterPoliController::class);
    Route::resource('master-penjamin', \App\Http\Controllers\MasterPenjaminController::class);

    // Routes untuk Kunjungan
    Route::resource('kunjungan', \App\Http\Controllers\KunjunganController::class);

    // Routes untuk Transaksi
    Route::resource('transaksi', \App\Http\Controllers\TransaksiController::class);
});

require __DIR__.'/settings.php';
