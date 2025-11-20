<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterPoli extends Model
{
    protected $fillable = [
        'kode_poli',
        'nama_poli',
        'lokasi',
    ];
}
