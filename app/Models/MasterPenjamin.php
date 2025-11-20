<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterPenjamin extends Model
{
    protected $fillable = [
        'kode_penjamin',
        'nama_penjamin',
        'jenis',
    ];
}
