<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransaksiResource;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);
        $transaksis = Transaksi::with(['kunjungan.pasien', 'details'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Data transaksi berhasil diambil',
            'data' => TransaksiResource::collection($transaksis),
            'meta' => [
                'total' => $transaksis->total(),
                'count' => $transaksis->count(),
                'per_page' => $transaksis->perPage(),
                'current_page' => $transaksis->currentPage(),
                'total_pages' => $transaksis->lastPage(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'no_registrasi_kunjungan' => 'required|exists:kunjungans,no_registrasi_kunjungan',
            'details' => 'required|array|min:1',
            'details.*.nama_tindakan' => 'required|string|max:255',
            'details.*.harga' => 'required|numeric|min:0',
            'details.*.qty' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            $validated = $validator->validated();

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

            $transaksi->load(['kunjungan.pasien', 'details']);

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil ditambahkan',
                'data' => new TransaksiResource($transaksi),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat transaksi: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $transaksi = Transaksi::with(['kunjungan.pasien', 'details'])->find($id);

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail transaksi berhasil diambil',
            'data' => new TransaksiResource($transaksi),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'details' => 'required|array|min:1',
            'details.*.nama_tindakan' => 'required|string|max:255',
            'details.*.harga' => 'required|numeric|min:0',
            'details.*.qty' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            $validated = $validator->validated();

            // Calculate total
            $totalHarga = 0;
            foreach ($validated['details'] as $detail) {
                $totalHarga += $detail['harga'] * $detail['qty'];
            }

            // Update transaksi
            $transaksi->update([
                'total_harga' => $totalHarga,
            ]);

            // Delete old details and create new ones
            $transaksi->details()->delete();

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

            $transaksi->load(['kunjungan.pasien', 'details']);

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil diupdate',
                'data' => new TransaksiResource($transaksi),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate transaksi: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan',
            ], 404);
        }

        $transaksi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dihapus',
        ]);
    }
}

