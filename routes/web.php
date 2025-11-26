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

    // Routes untuk Odontogram
    Route::get('kunjungan/{kunjungan}/odontogram/create', [\App\Http\Controllers\OdontogramController::class, 'create'])->name('odontogram.create');
    Route::post('kunjungan/{kunjungan}/odontogram', [\App\Http\Controllers\OdontogramController::class, 'store'])->name('odontogram.store');
    Route::get('odontogram/{odontogram}', [\App\Http\Controllers\OdontogramController::class, 'show'])->name('odontogram.show');
    Route::get('odontogram/{odontogram}/edit', [\App\Http\Controllers\OdontogramController::class, 'edit'])->name('odontogram.edit');
    Route::put('odontogram/{odontogram}', [\App\Http\Controllers\OdontogramController::class, 'update'])->name('odontogram.update');
    Route::delete('odontogram/{odontogram}', [\App\Http\Controllers\OdontogramController::class, 'destroy'])->name('odontogram.destroy');
    Route::get('odontogram/{odontogram}/export-pdf', [\App\Http\Controllers\OdontogramController::class, 'exportPdf'])->name('odontogram.exportPdf');
    Route::get('pasien/{noRm}/odontogram-history', [\App\Http\Controllers\OdontogramController::class, 'history'])->name('odontogram.history');
});

require __DIR__.'/settings.php';
