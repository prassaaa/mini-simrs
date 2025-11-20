<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pasiens = [
            [
                'no_rm' => 'RM-2025-0001',
                'nama_pasien' => 'Budi Santoso',
                'tanggal_lahir' => '1985-03-15',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta',
            ],
            [
                'no_rm' => 'RM-2025-0002',
                'nama_pasien' => 'Siti Nurhaliza',
                'tanggal_lahir' => '1990-07-22',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Gatot Subroto No. 45, Bandung, Jawa Barat',
            ],
            [
                'no_rm' => 'RM-2025-0003',
                'nama_pasien' => 'Ahmad Fauzi',
                'tanggal_lahir' => '1978-11-08',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Diponegoro No. 67, Surabaya, Jawa Timur',
            ],
            [
                'no_rm' => 'RM-2025-0004',
                'nama_pasien' => 'Dewi Lestari',
                'tanggal_lahir' => '1995-05-30',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Ahmad Yani No. 89, Semarang, Jawa Tengah',
            ],
            [
                'no_rm' => 'RM-2025-0005',
                'nama_pasien' => 'Eko Prasetyo',
                'tanggal_lahir' => '1982-09-12',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Malioboro No. 12, Yogyakarta, DI Yogyakarta',
            ],
            [
                'no_rm' => 'RM-2025-0006',
                'nama_pasien' => 'Fitri Handayani',
                'tanggal_lahir' => '1988-02-18',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Pahlawan No. 34, Medan, Sumatera Utara',
            ],
            [
                'no_rm' => 'RM-2025-0007',
                'nama_pasien' => 'Gunawan Wijaya',
                'tanggal_lahir' => '1975-12-25',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Veteran No. 56, Makassar, Sulawesi Selatan',
            ],
            [
                'no_rm' => 'RM-2025-0008',
                'nama_pasien' => 'Hendra Kusuma',
                'tanggal_lahir' => '1992-06-14',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Gajah Mada No. 78, Denpasar, Bali',
            ],
            [
                'no_rm' => 'RM-2025-0009',
                'nama_pasien' => 'Indah Permata Sari',
                'tanggal_lahir' => '1987-04-09',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Thamrin No. 90, Palembang, Sumatera Selatan',
            ],
            [
                'no_rm' => 'RM-2025-0010',
                'nama_pasien' => 'Joko Widodo',
                'tanggal_lahir' => '1980-08-20',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Pemuda No. 101, Solo, Jawa Tengah',
            ],
            [
                'no_rm' => 'RM-2025-0011',
                'nama_pasien' => 'Kartika Putri',
                'tanggal_lahir' => '1993-10-05',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Merdeka No. 23, Bogor, Jawa Barat',
            ],
            [
                'no_rm' => 'RM-2025-0012',
                'nama_pasien' => 'Lukman Hakim',
                'tanggal_lahir' => '1984-01-17',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Kartini No. 45, Tangerang, Banten',
            ],
            [
                'no_rm' => 'RM-2025-0013',
                'nama_pasien' => 'Maya Anggraini',
                'tanggal_lahir' => '1991-07-28',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Hasanuddin No. 67, Bekasi, Jawa Barat',
            ],
            [
                'no_rm' => 'RM-2025-0014',
                'nama_pasien' => 'Nurul Hidayah',
                'tanggal_lahir' => '1986-03-11',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Imam Bonjol No. 89, Depok, Jawa Barat',
            ],
            [
                'no_rm' => 'RM-2025-0015',
                'nama_pasien' => 'Oki Setiawan',
                'tanggal_lahir' => '1979-11-23',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Cendrawasih No. 12, Balikpapan, Kalimantan Timur',
            ],
        ];

        foreach ($pasiens as $pasien) {
            Pasien::create($pasien);
        }
    }
}
