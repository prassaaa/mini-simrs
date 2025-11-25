<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\JadwalDokter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AntrianController extends Controller
{
    /**
     * Get all antrian
     */
    public function index(Request $request): JsonResponse
    {
        $query = Antrian::with(['pasien', 'jadwalDokter.dokter', 'jadwalDokter.poli', 'penjamin']);

        // Filter by no_rm
        if ($request->has('no_rm')) {
            $query->where('no_rm', $request->no_rm);
        }

        // Filter by tanggal
        if ($request->has('tanggal')) {
            $query->whereDate('tanggal_kunjungan', $request->tanggal);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $antrian = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data antrian berhasil diambil',
            'data' => $antrian,
        ]);
    }

    /**
     * Create antrian baru
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'no_rm' => 'required|string|exists:pasiens,no_rm',
            'jadwal_dokter_id' => 'required|exists:jadwal_dokter,id',
            'tanggal_kunjungan' => 'required|date',
            'penjamin_id' => 'required|exists:master_penjamins,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Generate nomor antrian
        $tanggal = Carbon::parse($request->tanggal_kunjungan);
        $prefix = 'A' . $tanggal->format('ymd');
        
        // Hitung jumlah antrian hari ini untuk jadwal yang sama
        $count = Antrian::where('jadwal_dokter_id', $request->jadwal_dokter_id)
            ->whereDate('tanggal_kunjungan', $request->tanggal_kunjungan)
            ->count();
        
        $noAntrian = $prefix . str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        // Cek kuota
        $jadwal = JadwalDokter::find($request->jadwal_dokter_id);
        if ($count >= $jadwal->kuota) {
            return response()->json([
                'success' => false,
                'message' => 'Kuota antrian untuk jadwal ini sudah penuh',
            ], 400);
        }

        $antrian = Antrian::create([
            'no_antrian' => $noAntrian,
            'no_rm' => $request->no_rm,
            'jadwal_dokter_id' => $request->jadwal_dokter_id,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'penjamin_id' => $request->penjamin_id,
            'status' => 'menunggu',
        ]);

        $antrian->load(['pasien', 'jadwalDokter.dokter', 'jadwalDokter.poli', 'penjamin']);

        return response()->json([
            'success' => true,
            'message' => 'Antrian berhasil dibuat',
            'data' => $antrian,
        ], 201);
    }

    /**
     * Get antrian by ID
     */
    public function show(string $id): JsonResponse
    {
        $antrian = Antrian::with(['pasien', 'jadwalDokter.dokter', 'jadwalDokter.poli', 'penjamin'])->find($id);

        if (!$antrian) {
            return response()->json([
                'success' => false,
                'message' => 'Antrian tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail antrian berhasil diambil',
            'data' => $antrian,
        ]);
    }

    /**
     * Cancel antrian
     */
    public function destroy(string $id): JsonResponse
    {
        $antrian = Antrian::find($id);

        if (!$antrian) {
            return response()->json([
                'success' => false,
                'message' => 'Antrian tidak ditemukan',
            ], 404);
        }

        $antrian->update(['status' => 'batal']);

        return response()->json([
            'success' => true,
            'message' => 'Antrian berhasil dibatalkan',
        ]);
    }
}

