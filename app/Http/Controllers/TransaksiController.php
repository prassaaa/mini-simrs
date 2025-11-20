<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\DetailTransaksi;
use App\Models\Kunjungan;
use App\Models\Transaksi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $transaksis = Transaksi::with(['kunjungan.pasien'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return Inertia::render('transaksi/index', [
            'transaksis' => $transaksis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        $kunjungans = Kunjungan::with('pasien')
            ->select('id', 'no_registrasi_kunjungan', 'no_rm', 'tanggal_kunjungan')
            ->orderBy('tanggal_kunjungan', 'desc')
            ->get();

        return Inertia::render('transaksi/create', [
            'kunjungans' => $kunjungans,
            'selectedKunjungan' => $request->query('no_registrasi'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransaksiRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();

            // Calculate total
            $totalHarga = 0;
            foreach ($validated['details'] as $detail) {
                $totalHarga += $detail['harga'] * $detail['qty'];
            }

            // Create transaksi
            $transaksi = Transaksi::create([
                'no_registrasi_kunjungan' => $validated['no_registrasi_kunjungan'],
                'total_harga' => $totalHarga,
            ]);

            // Create detail transaksi
            foreach ($validated['details'] as $detail) {
                DetailTransaksi::create([
                    'no_transaksi' => $transaksi->no_transaksi,
                    'nama_tindakan' => $detail['nama_tindakan'],
                    'harga' => $detail['harga'],
                    'qty' => $detail['qty'],
                    'subtotal' => $detail['harga'] * $detail['qty'],
                ]);
            }

            DB::commit();

            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal membuat transaksi: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi): Response
    {
        $transaksi->load(['kunjungan.pasien', 'details']);

        return Inertia::render('transaksi/show', [
            'transaksi' => $transaksi,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi): Response
    {
        $transaksi->load('details');

        $kunjungans = Kunjungan::with('pasien')
            ->select('id', 'no_registrasi_kunjungan', 'no_rm', 'tanggal_kunjungan')
            ->orderBy('tanggal_kunjungan', 'desc')
            ->get();

        return Inertia::render('transaksi/edit', [
            'transaksi' => $transaksi,
            'kunjungans' => $kunjungans,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();

            // Calculate total
            $totalHarga = 0;
            foreach ($validated['details'] as $detail) {
                $totalHarga += $detail['harga'] * $detail['qty'];
            }

            // Update transaksi
            $transaksi->update([
                'no_registrasi_kunjungan' => $validated['no_registrasi_kunjungan'],
                'total_harga' => $totalHarga,
            ]);

            // Delete old details
            $transaksi->details()->delete();

            // Create new details
            foreach ($validated['details'] as $detail) {
                DetailTransaksi::create([
                    'no_transaksi' => $transaksi->no_transaksi,
                    'nama_tindakan' => $detail['nama_tindakan'],
                    'harga' => $detail['harga'],
                    'qty' => $detail['qty'],
                    'subtotal' => $detail['harga'] * $detail['qty'],
                ]);
            }

            DB::commit();

            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal mengupdate transaksi: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi): RedirectResponse
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }
}
