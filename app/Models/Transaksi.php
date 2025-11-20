<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    protected $fillable = [
        'no_transaksi',
        'no_registrasi_kunjungan',
        'total_harga',
    ];

    protected $casts = [
        'total_harga' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaksi) {
            if (empty($transaksi->no_transaksi)) {
                $transaksi->no_transaksi = 'TRX-' . date('YmdHis');
            }
        });
    }

    public function kunjungan(): BelongsTo
    {
        return $this->belongsTo(Kunjungan::class, 'no_registrasi_kunjungan', 'no_registrasi_kunjungan');
    }

    public function details(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class, 'no_transaksi', 'no_transaksi');
    }
}
