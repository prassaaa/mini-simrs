<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    use HasFactory;

    protected $table = 'jadwal_dokter';

    protected $fillable = [
        'kode_dokter',
        'kode_poli',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'kuota',
        'status',
    ];

    public function dokter()
    {
        return $this->belongsTo(MasterDokter::class, 'kode_dokter', 'kode_dokter');
    }

    public function poli()
    {
        return $this->belongsTo(MasterPoli::class, 'kode_poli', 'kode_poli');
    }

    public function antrian()
    {
        return $this->hasMany(Antrian::class);
    }
}
