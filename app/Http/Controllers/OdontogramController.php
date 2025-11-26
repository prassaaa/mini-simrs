<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOdontogramRequest;
use App\Http\Requests\UpdateOdontogramRequest;
use App\Models\Kunjungan;
use App\Models\Odontogram;
use App\Models\OdontogramGigi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class OdontogramController extends Controller
{
    // Kode poli yang diizinkan untuk fitur odontogram
    const ALLOWED_POLI_CODES = ['POLI-GIGI'];

    /**
     * Check if kunjungan is eligible for odontogram (Poli Gigi only)
     */
    private function isPoliGigi(Kunjungan $kunjungan): bool
    {
        $kunjungan->load('poliRelation');
        return $kunjungan->poliRelation &&
               in_array($kunjungan->poliRelation->kode_poli, self::ALLOWED_POLI_CODES);
    }

    /**
     * Show the form for creating a new odontogram.
     */
    public function create(Kunjungan $kunjungan): Response
    {
        $kunjungan->load(['pasien', 'dokter', 'poliRelation', 'penjamin']);

        // Check if kunjungan is from Poli Gigi
        if (!$this->isPoliGigi($kunjungan)) {
            abort(403, 'Odontogram hanya tersedia untuk kunjungan di Poli Gigi');
        }

        // Check if odontogram already exists
        if ($kunjungan->odontogram) {
            return redirect()->route('odontogram.edit', $kunjungan->odontogram);
        }

        // Get previous odontogram for this patient (if any)
        $previousOdontogram = Odontogram::whereHas('kunjungan', function ($query) use ($kunjungan) {
            $query->where('no_rm', $kunjungan->no_rm)
                  ->where('id', '!=', $kunjungan->id);
        })
        ->with('gigiList')
        ->latest()
        ->first();

        return Inertia::render('odontogram/create', [
            'kunjungan' => $kunjungan,
            'previousOdontogram' => $previousOdontogram,
            'kondisiGigi' => Odontogram::KONDISI_GIGI,
            'gigiDewasa' => Odontogram::GIGI_DEWASA,
            'gigiSusu' => Odontogram::GIGI_SUSU,
        ]);
    }

    /**
     * Store a newly created odontogram in storage.
     */
    public function store(StoreOdontogramRequest $request, Kunjungan $kunjungan): RedirectResponse
    {
        // Check if kunjungan is from Poli Gigi
        if (!$this->isPoliGigi($kunjungan)) {
            abort(403, 'Odontogram hanya tersedia untuk kunjungan di Poli Gigi');
        }

        DB::beginTransaction();

        try {
            $validated = $request->validated();

            // Create odontogram
            $odontogram = Odontogram::create([
                'kunjungan_id' => $kunjungan->id,
                'pemeriksaan_ekstra_oral' => $validated['pemeriksaan_ekstra_oral'] ?? null,
                'pemeriksaan_intra_oral' => $validated['pemeriksaan_intra_oral'] ?? null,
                'occlusi' => $validated['occlusi'] ?? 'normal_bite',
                'torus_palatinus' => $validated['torus_palatinus'] ?? 'tidak_ada',
                'torus_mandibularis' => $validated['torus_mandibularis'] ?? 'tidak_ada',
                'palatum' => $validated['palatum'] ?? 'sedang',
                'diastema' => $validated['diastema'] ?? false,
                'gigi_anomali' => $validated['gigi_anomali'] ?? false,
                'status_d' => $validated['status_d'] ?? 0,
                'status_m' => $validated['status_m'] ?? 0,
                'status_f' => $validated['status_f'] ?? 0,
                'hasil_pemeriksaan_penunjang' => $validated['hasil_pemeriksaan_penunjang'] ?? null,
                'diagnosa' => $validated['diagnosa'] ?? null,
                'planning' => $validated['planning'] ?? null,
                'edukasi' => $validated['edukasi'] ?? null,
            ]);

            // Create gigi records
            if (isset($validated['gigi']) && is_array($validated['gigi'])) {
                foreach ($validated['gigi'] as $nomorGigi => $gigiData) {
                    OdontogramGigi::create([
                        'odontogram_id' => $odontogram->id,
                        'nomor_gigi' => $nomorGigi,
                        'kondisi' => $gigiData['kondisi'] ?? 'sou',
                        'dinding_atas' => $gigiData['dinding_atas'] ?? null,
                        'dinding_bawah' => $gigiData['dinding_bawah'] ?? null,
                        'dinding_kiri' => $gigiData['dinding_kiri'] ?? null,
                        'dinding_kanan' => $gigiData['dinding_kanan'] ?? null,
                        'dinding_tengah' => $gigiData['dinding_tengah'] ?? null,
                        'keterangan' => $gigiData['keterangan'] ?? null,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('odontogram.show', $odontogram)
                ->with('success', 'Data odontogram berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menyimpan odontogram: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified odontogram.
     */
    public function show(Odontogram $odontogram): Response
    {
        $odontogram->load(['kunjungan.pasien', 'kunjungan.dokter', 'kunjungan.poliRelation', 'gigiList']);

        return Inertia::render('odontogram/show', [
            'odontogram' => $odontogram,
            'kondisiGigi' => Odontogram::KONDISI_GIGI,
        ]);
    }

    /**
     * Show the form for editing the specified odontogram.
     */
    public function edit(Odontogram $odontogram): Response
    {
        $odontogram->load(['kunjungan.pasien', 'kunjungan.dokter', 'kunjungan.poliRelation', 'gigiList']);

        return Inertia::render('odontogram/edit', [
            'odontogram' => $odontogram,
            'kondisiGigi' => Odontogram::KONDISI_GIGI,
            'gigiDewasa' => Odontogram::GIGI_DEWASA,
            'gigiSusu' => Odontogram::GIGI_SUSU,
        ]);
    }

    /**
     * Update the specified odontogram in storage.
     */
    public function update(UpdateOdontogramRequest $request, Odontogram $odontogram): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();

            // Update odontogram
            $odontogram->update([
                'pemeriksaan_ekstra_oral' => $validated['pemeriksaan_ekstra_oral'] ?? null,
                'pemeriksaan_intra_oral' => $validated['pemeriksaan_intra_oral'] ?? null,
                'occlusi' => $validated['occlusi'] ?? 'normal_bite',
                'torus_palatinus' => $validated['torus_palatinus'] ?? 'tidak_ada',
                'torus_mandibularis' => $validated['torus_mandibularis'] ?? 'tidak_ada',
                'palatum' => $validated['palatum'] ?? 'sedang',
                'diastema' => $validated['diastema'] ?? false,
                'gigi_anomali' => $validated['gigi_anomali'] ?? false,
                'status_d' => $validated['status_d'] ?? 0,
                'status_m' => $validated['status_m'] ?? 0,
                'status_f' => $validated['status_f'] ?? 0,
                'hasil_pemeriksaan_penunjang' => $validated['hasil_pemeriksaan_penunjang'] ?? null,
                'diagnosa' => $validated['diagnosa'] ?? null,
                'planning' => $validated['planning'] ?? null,
                'edukasi' => $validated['edukasi'] ?? null,
            ]);

            // Delete existing gigi records and create new ones
            $odontogram->gigiList()->delete();

            if (isset($validated['gigi']) && is_array($validated['gigi'])) {
                foreach ($validated['gigi'] as $nomorGigi => $gigiData) {
                    OdontogramGigi::create([
                        'odontogram_id' => $odontogram->id,
                        'nomor_gigi' => $nomorGigi,
                        'kondisi' => $gigiData['kondisi'] ?? 'sou',
                        'dinding_atas' => $gigiData['dinding_atas'] ?? null,
                        'dinding_bawah' => $gigiData['dinding_bawah'] ?? null,
                        'dinding_kiri' => $gigiData['dinding_kiri'] ?? null,
                        'dinding_kanan' => $gigiData['dinding_kanan'] ?? null,
                        'dinding_tengah' => $gigiData['dinding_tengah'] ?? null,
                        'keterangan' => $gigiData['keterangan'] ?? null,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('odontogram.show', $odontogram)
                ->with('success', 'Data odontogram berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal mengupdate odontogram: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified odontogram from storage.
     */
    public function destroy(Odontogram $odontogram): RedirectResponse
    {
        $kunjunganId = $odontogram->kunjungan_id;
        $odontogram->delete();

        return redirect()->route('kunjungan.show', $kunjunganId)
            ->with('success', 'Data odontogram berhasil dihapus');
    }

    /**
     * Get odontogram history for a patient.
     */
    public function history(string $noRm): Response
    {
        $odontograms = Odontogram::whereHas('kunjungan', function ($query) use ($noRm) {
            $query->where('no_rm', $noRm);
        })
        ->with(['kunjungan.dokter', 'kunjungan.poliRelation', 'gigiList'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        $pasien = \App\Models\Pasien::where('no_rm', $noRm)->firstOrFail();

        return Inertia::render('odontogram/history', [
            'odontograms' => $odontograms,
            'pasien' => $pasien,
            'kondisiGigi' => Odontogram::KONDISI_GIGI,
        ]);
    }

    /**
     * Export odontogram to PDF.
     */
    public function exportPdf(Odontogram $odontogram): HttpResponse
    {
        $odontogram->load(['kunjungan.pasien', 'kunjungan.dokter', 'kunjungan.poliRelation', 'gigiList']);

        // Labels for kondisi gigi
        $kondisiLabels = Odontogram::KONDISI_GIGI;

        $pdf = Pdf::loadView('pdf.odontogram', [
            'odontogram' => $odontogram,
            'kondisiLabels' => $kondisiLabels,
        ]);

        $pdf->setPaper('A4', 'portrait');

        $filename = 'Odontogram_' . $odontogram->kunjungan->pasien->nama_pasien . '_' . $odontogram->created_at->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }
}
