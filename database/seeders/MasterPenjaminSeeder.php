<?php

namespace Database\Seeders;

use App\Models\MasterPenjamin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterPenjaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penjamins = [
            [
                'kode_penjamin' => 'BPJS-KES',
                'nama_penjamin' => 'BPJS Kesehatan',
                'jenis' => 'BPJS',
            ],
            [
                'kode_penjamin' => 'UMUM',
                'nama_penjamin' => 'Umum / Tunai',
                'jenis' => 'Umum',
            ],
            [
                'kode_penjamin' => 'BPJS-TK',
                'nama_penjamin' => 'BPJS Ketenagakerjaan',
                'jenis' => 'BPJS',
            ],
            [
                'kode_penjamin' => 'PRUDENTIAL',
                'nama_penjamin' => 'Prudential Indonesia',
                'jenis' => 'Asuransi',
            ],
            [
                'kode_penjamin' => 'ALLIANZ',
                'nama_penjamin' => 'Allianz Indonesia',
                'jenis' => 'Asuransi',
            ],
            [
                'kode_penjamin' => 'MANDIRI-INHEALTH',
                'nama_penjamin' => 'Mandiri Inhealth',
                'jenis' => 'Asuransi',
            ],
            [
                'kode_penjamin' => 'AXA',
                'nama_penjamin' => 'AXA Mandiri',
                'jenis' => 'Asuransi',
            ],
            [
                'kode_penjamin' => 'MANULIFE',
                'nama_penjamin' => 'Manulife Indonesia',
                'jenis' => 'Asuransi',
            ],
            [
                'kode_penjamin' => 'JAMSOSTEK',
                'nama_penjamin' => 'Jamsostek',
                'jenis' => 'BPJS',
            ],
            [
                'kode_penjamin' => 'ASKES',
                'nama_penjamin' => 'Askes (PT Askes Indonesia)',
                'jenis' => 'Asuransi',
            ],
        ];

        foreach ($penjamins as $penjamin) {
            MasterPenjamin::create($penjamin);
        }
    }
}
