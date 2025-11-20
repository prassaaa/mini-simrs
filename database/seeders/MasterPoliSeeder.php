<?php

namespace Database\Seeders;

use App\Models\MasterPoli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterPoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = [
            [
                'kode_poli' => 'POLI-UMUM',
                'nama_poli' => 'Poli Umum',
                'lokasi' => 'Gedung A Lantai 1',
            ],
            [
                'kode_poli' => 'POLI-ANAK',
                'nama_poli' => 'Poli Anak',
                'lokasi' => 'Gedung A Lantai 2',
            ],
            [
                'kode_poli' => 'POLI-KANDUNGAN',
                'nama_poli' => 'Poli Kandungan & Kebidanan',
                'lokasi' => 'Gedung B Lantai 1',
            ],
            [
                'kode_poli' => 'POLI-GIGI',
                'nama_poli' => 'Poli Gigi',
                'lokasi' => 'Gedung A Lantai 1',
            ],
            [
                'kode_poli' => 'POLI-MATA',
                'nama_poli' => 'Poli Mata',
                'lokasi' => 'Gedung B Lantai 2',
            ],
            [
                'kode_poli' => 'POLI-THT',
                'nama_poli' => 'Poli THT (Telinga Hidung Tenggorokan)',
                'lokasi' => 'Gedung B Lantai 2',
            ],
            [
                'kode_poli' => 'POLI-JANTUNG',
                'nama_poli' => 'Poli Jantung',
                'lokasi' => 'Gedung C Lantai 1',
            ],
            [
                'kode_poli' => 'POLI-PARU',
                'nama_poli' => 'Poli Paru',
                'lokasi' => 'Gedung C Lantai 1',
            ],
            [
                'kode_poli' => 'POLI-SARAF',
                'nama_poli' => 'Poli Saraf (Neurologi)',
                'lokasi' => 'Gedung C Lantai 2',
            ],
            [
                'kode_poli' => 'POLI-KULIT',
                'nama_poli' => 'Poli Kulit & Kelamin',
                'lokasi' => 'Gedung B Lantai 1',
            ],
            [
                'kode_poli' => 'POLI-BEDAH',
                'nama_poli' => 'Poli Bedah',
                'lokasi' => 'Gedung C Lantai 2',
            ],
            [
                'kode_poli' => 'POLI-ORTOPEDI',
                'nama_poli' => 'Poli Ortopedi (Tulang)',
                'lokasi' => 'Gedung C Lantai 3',
            ],
            [
                'kode_poli' => 'POLI-DALAM',
                'nama_poli' => 'Poli Penyakit Dalam',
                'lokasi' => 'Gedung A Lantai 2',
            ],
            [
                'kode_poli' => 'POLI-JIWA',
                'nama_poli' => 'Poli Kesehatan Jiwa',
                'lokasi' => 'Gedung D Lantai 1',
            ],
            [
                'kode_poli' => 'POLI-GIZI',
                'nama_poli' => 'Poli Gizi',
                'lokasi' => 'Gedung A Lantai 1',
            ],
        ];

        foreach ($polis as $poli) {
            MasterPoli::create($poli);
        }
    }
}
