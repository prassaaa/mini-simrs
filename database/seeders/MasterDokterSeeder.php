<?php

namespace Database\Seeders;

use App\Models\MasterDokter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterDokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dokters = [
            [
                'kode_dokter' => 'DOK-001',
                'nama_dokter' => 'dr. Ahmad Fauzi, Sp.PD',
                'spesialisasi' => 'Spesialis Penyakit Dalam',
                'no_telp' => '081234567801',
            ],
            [
                'kode_dokter' => 'DOK-002',
                'nama_dokter' => 'dr. Siti Nurhaliza, Sp.A',
                'spesialisasi' => 'Spesialis Anak',
                'no_telp' => '081234567802',
            ],
            [
                'kode_dokter' => 'DOK-003',
                'nama_dokter' => 'dr. Budi Santoso, Sp.OG',
                'spesialisasi' => 'Spesialis Kandungan & Kebidanan',
                'no_telp' => '081234567803',
            ],
            [
                'kode_dokter' => 'DOK-004',
                'nama_dokter' => 'drg. Dewi Lestari, Sp.KG',
                'spesialisasi' => 'Spesialis Konservasi Gigi',
                'no_telp' => '081234567804',
            ],
            [
                'kode_dokter' => 'DOK-005',
                'nama_dokter' => 'dr. Eko Prasetyo, Sp.M',
                'spesialisasi' => 'Spesialis Mata',
                'no_telp' => '081234567805',
            ],
            [
                'kode_dokter' => 'DOK-006',
                'nama_dokter' => 'dr. Fitri Handayani, Sp.THT',
                'spesialisasi' => 'Spesialis THT',
                'no_telp' => '081234567806',
            ],
            [
                'kode_dokter' => 'DOK-007',
                'nama_dokter' => 'dr. Gunawan Wijaya, Sp.JP',
                'spesialisasi' => 'Spesialis Jantung dan Pembuluh Darah',
                'no_telp' => '081234567807',
            ],
            [
                'kode_dokter' => 'DOK-008',
                'nama_dokter' => 'dr. Hendra Kusuma, Sp.P',
                'spesialisasi' => 'Spesialis Paru',
                'no_telp' => '081234567808',
            ],
            [
                'kode_dokter' => 'DOK-009',
                'nama_dokter' => 'dr. Indah Permata, Sp.S',
                'spesialisasi' => 'Spesialis Saraf',
                'no_telp' => '081234567809',
            ],
            [
                'kode_dokter' => 'DOK-010',
                'nama_dokter' => 'dr. Joko Widodo, Sp.KK',
                'spesialisasi' => 'Spesialis Kulit dan Kelamin',
                'no_telp' => '081234567810',
            ],
            [
                'kode_dokter' => 'DOK-011',
                'nama_dokter' => 'dr. Kartika Sari, Sp.B',
                'spesialisasi' => 'Spesialis Bedah',
                'no_telp' => '081234567811',
            ],
            [
                'kode_dokter' => 'DOK-012',
                'nama_dokter' => 'dr. Lukman Hakim, Sp.OT',
                'spesialisasi' => 'Spesialis Ortopedi',
                'no_telp' => '081234567812',
            ],
            [
                'kode_dokter' => 'DOK-013',
                'nama_dokter' => 'dr. Maya Anggraini',
                'spesialisasi' => 'Dokter Umum',
                'no_telp' => '081234567813',
            ],
            [
                'kode_dokter' => 'DOK-014',
                'nama_dokter' => 'dr. Nurul Hidayah',
                'spesialisasi' => 'Dokter Umum',
                'no_telp' => '081234567814',
            ],
            [
                'kode_dokter' => 'DOK-015',
                'nama_dokter' => 'dr. Oki Setiawan, Sp.KJ',
                'spesialisasi' => 'Spesialis Kesehatan Jiwa',
                'no_telp' => '081234567815',
            ],
            [
                'kode_dokter' => 'DOK-016',
                'nama_dokter' => 'dr. Putri Maharani, M.Gizi',
                'spesialisasi' => 'Spesialis Gizi Klinik',
                'no_telp' => '081234567816',
            ],
            [
                'kode_dokter' => 'DOK-017',
                'nama_dokter' => 'dr. Raden Mas Surya',
                'spesialisasi' => 'Dokter Umum',
                'no_telp' => '081234567817',
            ],
            [
                'kode_dokter' => 'DOK-018',
                'nama_dokter' => 'dr. Sri Mulyani, Sp.PD',
                'spesialisasi' => 'Spesialis Penyakit Dalam',
                'no_telp' => '081234567818',
            ],
            [
                'kode_dokter' => 'DOK-019',
                'nama_dokter' => 'dr. Taufik Hidayat, Sp.A',
                'spesialisasi' => 'Spesialis Anak',
                'no_telp' => '081234567819',
            ],
            [
                'kode_dokter' => 'DOK-020',
                'nama_dokter' => 'dr. Umi Kalsum',
                'spesialisasi' => 'Dokter Umum',
                'no_telp' => '081234567820',
            ],
        ];

        foreach ($dokters as $dokter) {
            MasterDokter::create($dokter);
        }
    }
}
