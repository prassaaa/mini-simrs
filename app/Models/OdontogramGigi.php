<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OdontogramGigi extends Model
{
    protected $table = 'odontogram_gigi';

    protected $fillable = [
        'odontogram_id',
        'nomor_gigi',
        'kondisi',
        'dinding_atas',
        'dinding_bawah',
        'dinding_kiri',
        'dinding_kanan',
        'dinding_tengah',
        'keterangan',
    ];

    /**
     * Get the odontogram that owns this gigi record.
     */
    public function odontogram(): BelongsTo
    {
        return $this->belongsTo(Odontogram::class);
    }

    /**
     * Check if any dinding has problem
     */
    public function hasDindingProblem(): bool
    {
        return $this->dinding_atas === 'bermasalah' ||
               $this->dinding_bawah === 'bermasalah' ||
               $this->dinding_kiri === 'bermasalah' ||
               $this->dinding_kanan === 'bermasalah' ||
               $this->dinding_tengah === 'bermasalah';
    }

    /**
     * Get kondisi label
     */
    public function getKondisiLabelAttribute(): string
    {
        return Odontogram::KONDISI_GIGI[$this->kondisi] ?? $this->kondisi;
    }
}
