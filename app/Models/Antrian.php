<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $table = 'antrian';

    protected $fillable = [
        'no_antrian',
        'no_rm',
        'jadwal_dokter_id',
        'tanggal_kunjungan',
        'penjamin_id',
        'status',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'no_rm', 'no_rm');
    }

    public function jadwalDokter()
    {
        return $this->belongsTo(JadwalDokter::class);
    }

    public function penjamin()
    {
        return $this->belongsTo(MasterPenjamin::class);
    }
}
