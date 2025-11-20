<?php

namespace App\Http\Controllers;

use App\Models\MasterPenjamin;
use App\Http\Requests\StoreMasterPenjaminRequest;
use App\Http\Requests\UpdateMasterPenjaminRequest;
use Inertia\Inertia;
use Inertia\Response;

class MasterPenjaminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $penjamins = MasterPenjamin::latest()->paginate(10);
        return Inertia::render('master-penjamin/index', [
            'penjamins' => $penjamins,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('master-penjamin/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMasterPenjaminRequest $request)
    {
        MasterPenjamin::create($request->validated());
        return redirect()->route('master-penjamin.index')
            ->with('success', 'Data penjamin berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterPenjamin $masterPenjamin): Response
    {
        return Inertia::render('master-penjamin/show', [
            'penjamin' => $masterPenjamin,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterPenjamin $masterPenjamin): Response
    {
        return Inertia::render('master-penjamin/edit', [
            'penjamin' => $masterPenjamin,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMasterPenjaminRequest $request, MasterPenjamin $masterPenjamin)
    {
        $masterPenjamin->update($request->validated());
        return redirect()->route('master-penjamin.index')
            ->with('success', 'Data penjamin berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterPenjamin $masterPenjamin)
    {
        $masterPenjamin->delete();
        return redirect()->route('master-penjamin.index')
            ->with('success', 'Data penjamin berhasil dihapus');
    }
}
