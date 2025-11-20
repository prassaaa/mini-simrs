<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KunjunganResource;
use App\Models\Kunjungan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);
        $kunjungans = Kunjungan::with(['pasien', 'dokter', 'poliRelation', 'penjamin'])
            ->orderBy('tanggal_kunjungan', 'desc')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Data kunjungan berhasil diambil',
            'data' => KunjunganResource::collection($kunjungans),
            'meta' => [
                'total' => $kunjungans->total(),
                'count' => $kunjungans->count(),
                'per_page' => $kunjungans->perPage(),
                'current_page' => $kunjungans->currentPage(),
                'total_pages' => $kunjungans->lastPage(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'no_rm' => 'required|exists:pasiens,no_rm',
            'tanggal_kunjungan' => 'required|date',
            'kode_dokter' => 'required|exists:master_dokters,kode_dokter',
            'poli' => 'required|exists:master_polis,kode_poli',
            'instalasi' => 'required|in:Rawat Jalan,IGD,Rawat Inap',
            'penjamin_id' => 'required|exists:master_penjamins,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $kunjungan = Kunjungan::create($validator->validated());
        $kunjungan->load(['pasien', 'dokter', 'poliRelation', 'penjamin']);

        return response()->json([
            'success' => true,
            'message' => 'Kunjungan berhasil ditambahkan',
            'data' => new KunjunganResource($kunjungan),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $kunjungan = Kunjungan::with(['pasien', 'dokter', 'poliRelation', 'penjamin', 'transaksi.details'])
            ->find($id);

        if (!$kunjungan) {
            return response()->json([
                'success' => false,
                'message' => 'Kunjungan tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail kunjungan berhasil diambil',
            'data' => new KunjunganResource($kunjungan),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $kunjungan = Kunjungan::find($id);

        if (!$kunjungan) {
            return response()->json([
                'success' => false,
                'message' => 'Kunjungan tidak ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'no_rm' => 'required|exists:pasiens,no_rm',
            'tanggal_kunjungan' => 'required|date',
            'kode_dokter' => 'required|exists:master_dokters,kode_dokter',
            'poli' => 'required|exists:master_polis,kode_poli',
            'instalasi' => 'required|in:Rawat Jalan,IGD,Rawat Inap',
            'penjamin_id' => 'required|exists:master_penjamins,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $kunjungan->update($validator->validated());
        $kunjungan->load(['pasien', 'dokter', 'poliRelation', 'penjamin']);

        return response()->json([
            'success' => true,
            'message' => 'Kunjungan berhasil diupdate',
            'data' => new KunjunganResource($kunjungan),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $kunjungan = Kunjungan::find($id);

        if (!$kunjungan) {
            return response()->json([
                'success' => false,
                'message' => 'Kunjungan tidak ditemukan',
            ], 404);
        }

        $kunjungan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kunjungan berhasil dihapus',
        ]);
    }
}

