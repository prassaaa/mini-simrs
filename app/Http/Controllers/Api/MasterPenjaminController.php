<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MasterPenjamin;
use Illuminate\Http\JsonResponse;

class MasterPenjaminController extends Controller
{
    public function index(): JsonResponse
    {
        $penjamin = MasterPenjamin::all();

        return response()->json([
            'success' => true,
            'message' => 'Data penjamin berhasil diambil',
            'data' => $penjamin,
        ]);
    }
}

