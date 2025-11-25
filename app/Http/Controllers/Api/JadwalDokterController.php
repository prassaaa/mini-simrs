<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JadwalDokterController extends Controller
{
    /**
     * Get jadwal dokter berdasarkan poli dan hari
     */
    public function index(Request $request): JsonResponse
    {
        $query = JadwalDokter::with(['dokter', 'poli'])
            ->where('status', 'aktif');

        // Filter by poli
        if ($request->has('poli')) {
            $query->where('kode_poli', $request->poli);
        }

        // Filter by hari
        if ($request->has('hari')) {
            $query->where('hari', $request->hari);
        }

        // Filter by kode_dokter
        if ($request->has('kode_dokter')) {
            $query->where('kode_dokter', $request->kode_dokter);
        }

        $jadwal = $query->get();

        return response()->json([
            'success' => true,
            'message' => 'Jadwal dokter berhasil diambil',
            'data' => $jadwal,
        ]);
    }

    /**
     * Get jadwal dokter by ID
     */
    public function show(string $id): JsonResponse
    {
        $jadwal = JadwalDokter::with(['dokter', 'poli'])->find($id);

        if (!$jadwal) {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal dokter tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail jadwal dokter berhasil diambil',
            'data' => $jadwal,
        ]);
    }
}

