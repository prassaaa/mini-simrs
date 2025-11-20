<?php

namespace App\Http\Controllers;

use App\Models\MasterPoli;
use App\Http\Requests\StoreMasterPoliRequest;
use App\Http\Requests\UpdateMasterPoliRequest;
use Inertia\Inertia;
use Inertia\Response;

class MasterPoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $polis = MasterPoli::latest()->paginate(10);
        return Inertia::render('master-poli/index', [
            'polis' => $polis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('master-poli/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMasterPoliRequest $request)
    {
        MasterPoli::create($request->validated());
        return redirect()->route('master-poli.index')
            ->with('success', 'Data poli berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterPoli $masterPoli): Response
    {
        return Inertia::render('master-poli/show', [
            'poli' => $masterPoli,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterPoli $masterPoli): Response
    {
        return Inertia::render('master-poli/edit', [
            'poli' => $masterPoli,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMasterPoliRequest $request, MasterPoli $masterPoli)
    {
        $masterPoli->update($request->validated());
        return redirect()->route('master-poli.index')
            ->with('success', 'Data poli berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterPoli $masterPoli)
    {
        $masterPoli->delete();
        return redirect()->route('master-poli.index')
            ->with('success', 'Data poli berhasil dihapus');
    }
}
