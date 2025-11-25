<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MasterPoli;
use Illuminate\Http\JsonResponse;

class MasterPoliController extends Controller
{
    public function index(): JsonResponse
    {
        $poli = MasterPoli::all();

        return response()->json([
            'success' => true,
            'message' => 'Data poli berhasil diambil',
            'data' => $poli,
        ]);
    }
}

