<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PasienCollection;
use App\Http\Resources\PasienResource;
use App\Models\Pasien;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);
        $pasiens = Pasien::orderBy('created_at', 'desc')->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil diambil',
            'data' => PasienResource::collection($pasiens),
            'meta' => [
                'total' => $pasiens->total(),
                'count' => $pasiens->count(),
                'per_page' => $pasiens->perPage(),
                'current_page' => $pasiens->currentPage(),
                'total_pages' => $pasiens->lastPage(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'no_rm' => 'required|string|max:50|unique:pasiens,no_rm',
            'nama_pasien' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $pasien = Pasien::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Pasien berhasil ditambahkan',
            'data' => new PasienResource($pasien),
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $pasien = Pasien::with(['kunjungan.dokter', 'kunjungan.poliRelation', 'kunjungan.penjamin'])
            ->find($id);

        if (!$pasien) {
            return response()->json([
                'success' => false,
                'message' => 'Pasien tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail pasien berhasil diambil',
            'data' => new PasienResource($pasien),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            return response()->json([
                'success' => false,
                'message' => 'Pasien tidak ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'no_rm' => 'required|string|max:50|unique:pasiens,no_rm,' . $id,
            'nama_pasien' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $pasien->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Pasien berhasil diupdate',
            'data' => new PasienResource($pasien),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            return response()->json([
                'success' => false,
                'message' => 'Pasien tidak ditemukan',
            ], 404);
        }

        $pasien->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pasien berhasil dihapus',
        ]);
    }

    /**
     * Search pasien by NO RM
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchByNoRM(string $noRm): JsonResponse
    {
        $pasien = Pasien::where('no_rm', $noRm)->first();

        if (!$pasien) {
            return response()->json([
                'success' => false,
                'message' => 'Pasien dengan NO RM tersebut tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pasien ditemukan',
            'data' => new PasienResource($pasien),
        ]);
    }
}
