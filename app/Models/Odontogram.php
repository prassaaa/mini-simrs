<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Odontogram extends Model
{
    protected $fillable = [
        'kunjungan_id',
        'pemeriksaan_ekstra_oral',
        'pemeriksaan_intra_oral',
        'occlusi',
        'torus_palatinus',
        'torus_mandibularis',
        'palatum',
        'diastema',
        'gigi_anomali',
        'status_d',
        'status_m',
        'status_f',
        'hasil_pemeriksaan_penunjang',
        'diagnosa',
        'planning',
        'edukasi',
    ];

    protected $casts = [
        'diastema' => 'boolean',
        'gigi_anomali' => 'boolean',
        'status_d' => 'integer',
        'status_m' => 'integer',
        'status_f' => 'integer',
    ];

    /**
     * Get the kunjungan that owns the odontogram.
     */
    public function kunjungan(): BelongsTo
    {
        return $this->belongsTo(Kunjungan::class);
    }

    /**
     * Get all gigi records for the odontogram.
     */
    public function gigiList(): HasMany
    {
        return $this->hasMany(OdontogramGigi::class);
    }

    /**
     * Constants for kondisi gigi
     */
    public const KONDISI_GIGI = [
        'sou' => 'Sound (Normal)',
        'car' => 'Caries (Karies)',
        'amf' => 'Amalgam Filling',
        'amf-rct' => 'Amalgam + Root Canal',
        'cof' => 'Composite Filling',
        'cof-rct' => 'Composite + Root Canal',
        'fmc' => 'Full Metal Crown',
        'fmc-rct' => 'Full Metal Crown + Root Canal',
        'poc' => 'Porcelain Crown',
        'poc-rct' => 'Porcelain Crown + Root Canal',
        'rct' => 'Root Canal Treatment',
        'mis' => 'Missing (Hilang)',
        'non' => 'Non-vital',
        'nvt' => 'Non-vital',
        'ano' => 'Anomali',
        'rrx' => 'Sisa Akar',
        'une' => 'Un-erupted',
        'pre' => 'Partial Erupt',
        'fis' => 'Pit & Fissure Sealant',
        'cfr' => 'Fracture',
        'frm-acr' => 'Partial/Full Denture',
        'ipx-poc' => 'Implant + Porcelain Crown',
        'meb-left' => 'Metal Bridge (Kiri)',
        'meb-center' => 'Metal Bridge (Tengah)',
        'meb-right' => 'Metal Bridge (Kanan)',
        'mcb-left' => 'Metal Cantilever Bridge (Kiri)',
        'mcb-right' => 'Metal Cantilever Bridge (Kanan)',
        'pob-left' => 'Porcelain Bridge (Kiri)',
        'pob-center' => 'Porcelain Bridge (Tengah)',
        'pob-right' => 'Porcelain Bridge (Kanan)',
        'migrasi-left' => 'Migrasi Kiri',
        'migrasi-right' => 'Migrasi Kanan',
        'rotasi-arahjam' => 'Rotasi Searah Jarum Jam',
        'rotasi-balikjam' => 'Rotasi Berlawanan Jarum Jam',
    ];

    /**
     * Constants for nomor gigi dewasa
     */
    public const GIGI_DEWASA = [
        // Rahang atas kanan (kuadran 1)
        '18', '17', '16', '15', '14', '13', '12', '11',
        // Rahang atas kiri (kuadran 2)
        '21', '22', '23', '24', '25', '26', '27', '28',
        // Rahang bawah kiri (kuadran 3)
        '31', '32', '33', '34', '35', '36', '37', '38',
        // Rahang bawah kanan (kuadran 4)
        '41', '42', '43', '44', '45', '46', '47', '48',
    ];

    /**
     * Constants for nomor gigi susu
     */
    public const GIGI_SUSU = [
        // Rahang atas kanan (kuadran 5)
        '55', '54', '53', '52', '51',
        // Rahang atas kiri (kuadran 6)
        '61', '62', '63', '64', '65',
        // Rahang bawah kiri (kuadran 7)
        '71', '72', '73', '74', '75',
        // Rahang bawah kanan (kuadran 8)
        '81', '82', '83', '84', '85',
    ];
}
