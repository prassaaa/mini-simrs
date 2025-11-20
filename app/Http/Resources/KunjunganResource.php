<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KunjunganResource extends JsonResource
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
            'no_registrasi_kunjungan' => $this->no_registrasi_kunjungan,
            'no_rm' => $this->no_rm,
            'tanggal_kunjungan' => $this->tanggal_kunjungan,
            'kode_dokter' => $this->kode_dokter,
            'poli' => $this->poli,
            'instalasi' => $this->instalasi,
            'penjamin_id' => $this->penjamin_id,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),

            // Relationships
            'pasien' => new PasienResource($this->whenLoaded('pasien')),
            'dokter' => $this->whenLoaded('dokter', function () {
                return [
                    'kode_dokter' => $this->dokter->kode_dokter,
                    'nama_dokter' => $this->dokter->nama_dokter,
                    'spesialisasi' => $this->dokter->spesialisasi,
                ];
            }),
            'poli_detail' => $this->whenLoaded('poliRelation', function () {
                return [
                    'kode_poli' => $this->poliRelation->kode_poli,
                    'nama_poli' => $this->poliRelation->nama_poli,
                    'lokasi' => $this->poliRelation->lokasi,
                ];
            }),
            'penjamin' => $this->whenLoaded('penjamin', function () {
                return [
                    'id' => $this->penjamin->id,
                    'kode_penjamin' => $this->penjamin->kode_penjamin,
                    'nama_penjamin' => $this->penjamin->nama_penjamin,
                    'jenis' => $this->penjamin->jenis,
                ];
            }),
            'transaksi' => new TransaksiResource($this->whenLoaded('transaksi')),
        ];
    }
}

