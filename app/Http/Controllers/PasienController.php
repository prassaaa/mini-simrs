<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Http\Requests\StorePasienRequest;
use App\Http\Requests\UpdatePasienRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $pasiens = Pasien::latest()->paginate(10);
        return Inertia::render('pasien/index', [
            'pasiens' => $pasiens,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('pasien/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePasienRequest $request)
    {
        Pasien::create($request->validated());

        return redirect()->route('pasien.index')
            ->with('success', 'Data pasien berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pasien $pasien): Response
    {
        return Inertia::render('pasien/show', [
            'pasien' => $pasien,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pasien $pasien): Response
    {
        return Inertia::render('pasien/edit', [
            'pasien' => $pasien,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePasienRequest $request, Pasien $pasien)
    {
        $pasien->update($request->validated());

        return redirect()->route('pasien.index')
            ->with('success', 'Data pasien berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return redirect()->route('pasien.index')
            ->with('success', 'Data pasien berhasil dihapus.');
    }
}
