<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\MasterDokter;
use App\Models\MasterPoli;
use App\Models\MasterPenjamin;
use App\Http\Requests\StoreKunjunganRequest;
use App\Http\Requests\UpdateKunjunganRequest;
use Inertia\Inertia;
use Inertia\Response;

class KunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $kunjungans = Kunjungan::with(['pasien', 'dokter', 'poliRelation', 'penjamin'])
            ->latest()
            ->paginate(10);

        return Inertia::render('kunjungan/index', [
            'kunjungans' => $kunjungans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $pasiens = Pasien::select('id', 'no_rm', 'nama_pasien')->get();
        $dokters = MasterDokter::select('id', 'kode_dokter', 'nama_dokter')->get();
        $polis = MasterPoli::select('id', 'kode_poli', 'nama_poli')->get();
        $penjamins = MasterPenjamin::select('id', 'kode_penjamin', 'nama_penjamin')->get();

        return Inertia::render('kunjungan/create', [
            'pasiens' => $pasiens,
            'dokters' => $dokters,
            'polis' => $polis,
            'penjamins' => $penjamins,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKunjunganRequest $request)
    {
        Kunjungan::create($request->validated());
        return redirect()->route('kunjungan.index')
            ->with('success', 'Data kunjungan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kunjungan $kunjungan): Response
    {
        $kunjungan->load(['pasien', 'dokter', 'poliRelation', 'penjamin', 'transaksi.details']);

        return Inertia::render('kunjungan/show', [
            'kunjungan' => $kunjungan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kunjungan $kunjungan): Response
    {
        $pasiens = Pasien::select('id', 'no_rm', 'nama_pasien')->get();
        $dokters = MasterDokter::select('id', 'kode_dokter', 'nama_dokter')->get();
        $polis = MasterPoli::select('id', 'kode_poli', 'nama_poli')->get();
        $penjamins = MasterPenjamin::select('id', 'kode_penjamin', 'nama_penjamin')->get();

        return Inertia::render('kunjungan/edit', [
            'kunjungan' => $kunjungan,
            'pasiens' => $pasiens,
            'dokters' => $dokters,
            'polis' => $polis,
            'penjamins' => $penjamins,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKunjunganRequest $request, Kunjungan $kunjungan)
    {
        $kunjungan->update($request->validated());
        return redirect()->route('kunjungan.index')
            ->with('success', 'Data kunjungan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kunjungan $kunjungan)
    {
        $kunjungan->delete();
        return redirect()->route('kunjungan.index')
            ->with('success', 'Data kunjungan berhasil dihapus');
    }
}
