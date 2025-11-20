<?php

namespace App\Http\Controllers;

use App\Models\MasterDokter;
use App\Http\Requests\StoreMasterDokterRequest;
use App\Http\Requests\UpdateMasterDokterRequest;
use Inertia\Inertia;
use Inertia\Response;

class MasterDokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $dokters = MasterDokter::latest()->paginate(10);
        return Inertia::render('master-dokter/index', [
            'dokters' => $dokters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('master-dokter/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMasterDokterRequest $request)
    {
        MasterDokter::create($request->validated());
        return redirect()->route('master-dokter.index')
            ->with('success', 'Data dokter berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterDokter $masterDokter): Response
    {
        return Inertia::render('master-dokter/show', [
            'dokter' => $masterDokter,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterDokter $masterDokter): Response
    {
        return Inertia::render('master-dokter/edit', [
            'dokter' => $masterDokter,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMasterDokterRequest $request, MasterDokter $masterDokter)
    {
        $masterDokter->update($request->validated());
        return redirect()->route('master-dokter.index')
            ->with('success', 'Data dokter berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterDokter $masterDokter)
    {
        $masterDokter->delete();
        return redirect()->route('master-dokter.index')
            ->with('success', 'Data dokter berhasil dihapus');
    }
}
