<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kunjungan extends Model
{
    protected $fillable = [
        'no_registrasi_kunjungan',
        'no_rm',
        'tanggal_kunjungan',
        'kode_dokter',
        'poli',
        'instalasi',
        'penjamin_id',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kunjungan) {
            if (empty($kunjungan->no_registrasi_kunjungan)) {
                $kunjungan->no_registrasi_kunjungan = date('YmdHis');
            }
        });
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'no_rm', 'no_rm');
    }

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(MasterDokter::class, 'kode_dokter', 'kode_dokter');
    }

    public function poliRelation(): BelongsTo
    {
        return $this->belongsTo(MasterPoli::class, 'poli', 'kode_poli');
    }

    public function penjamin(): BelongsTo
    {
        return $this->belongsTo(MasterPenjamin::class, 'penjamin_id');
    }

    public function transaksi(): HasOne
    {
        return $this->hasOne(Transaksi::class, 'no_registrasi_kunjungan', 'no_registrasi_kunjungan');
    }
}
