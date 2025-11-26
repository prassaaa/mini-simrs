<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'admin@simrs.com'],
            [
                'name' => 'Admin RS',
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );

        // Seed Master Data
        $this->call([
            MasterPenjaminSeeder::class,
            MasterPoliSeeder::class,
            MasterDokterSeeder::class,
            PasienSeeder::class,
            JadwalDokterSeeder::class,
        ]);
    }
}
