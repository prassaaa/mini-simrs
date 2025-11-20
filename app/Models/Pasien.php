<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    protected $fillable = [
        'no_rm',
        'nama_pasien',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Get all kunjungan for the pasien.
     */
    public function kunjungan(): HasMany
    {
        return $this->hasMany(Kunjungan::class, 'no_rm', 'no_rm');
    }
}
