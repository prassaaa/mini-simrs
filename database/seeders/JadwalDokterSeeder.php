<?php

namespace Database\Seeders;

use App\Models\JadwalDokter;
use Illuminate\Database\Seeder;

class JadwalDokterSeeder extends Seeder
{
    public function run(): void
    {
        $jadwal = [
            // Poli Umum
            [
                'kode_dokter' => 'DOK-001',
                'kode_poli' => 'POLI-UMUM',
                'hari' => 'Senin',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '12:00:00',
                'kuota' => 20,
                'status' => 'aktif',
            ],
            [
                'kode_dokter' => 'DOK-001',
                'kode_poli' => 'POLI-UMUM',
                'hari' => 'Rabu',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '12:00:00',
                'kuota' => 20,
                'status' => 'aktif',
            ],
            [
                'kode_dokter' => 'DOK-001',
                'kode_poli' => 'POLI-UMUM',
                'hari' => 'Jumat',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '12:00:00',
                'kuota' => 20,
                'status' => 'aktif',
            ],
            
            // Poli Gigi
            [
                'kode_dokter' => 'DOK-002',
                'kode_poli' => 'POLI-GIGI',
                'hari' => 'Selasa',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '17:00:00',
                'kuota' => 15,
                'status' => 'aktif',
            ],
            [
                'kode_dokter' => 'DOK-002',
                'kode_poli' => 'POLI-GIGI',
                'hari' => 'Kamis',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '17:00:00',
                'kuota' => 15,
                'status' => 'aktif',
            ],
            [
                'kode_dokter' => 'DOK-002',
                'kode_poli' => 'POLI-GIGI',
                'hari' => 'Sabtu',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '12:00:00',
                'kuota' => 15,
                'status' => 'aktif',
            ],

            // Poli Anak
            [
                'kode_dokter' => 'DOK-003',
                'kode_poli' => 'POLI-ANAK',
                'hari' => 'Senin',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '17:00:00',
                'kuota' => 25,
                'status' => 'aktif',
            ],
            [
                'kode_dokter' => 'DOK-003',
                'kode_poli' => 'POLI-ANAK',
                'hari' => 'Rabu',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '17:00:00',
                'kuota' => 25,
                'status' => 'aktif',
            ],
            [
                'kode_dokter' => 'DOK-003',
                'kode_poli' => 'POLI-ANAK',
                'hari' => 'Jumat',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '17:00:00',
                'kuota' => 25,
                'status' => 'aktif',
            ],
        ];

        foreach ($jadwal as $item) {
            JadwalDokter::create($item);
        }
    }
}

