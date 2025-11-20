<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterDokter extends Model
{
    protected $fillable = [
        'kode_dokter',
        'nama_dokter',
        'spesialisasi',
        'no_telp',
    ];
}
