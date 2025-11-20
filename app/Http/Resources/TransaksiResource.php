<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'no_transaksi' => $this->no_transaksi,
            'no_registrasi_kunjungan' => $this->no_registrasi_kunjungan,
            'total_harga' => (float) $this->total_harga,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),

            // Relationships
            'kunjungan' => new KunjunganResource($this->whenLoaded('kunjungan')),
            'details' => DetailTransaksiResource::collection($this->whenLoaded('details')),
        ];
    }
}

