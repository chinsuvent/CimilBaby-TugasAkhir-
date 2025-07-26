<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed 1: User dengan kolom username yang wajib
        User::factory()->create([
            'name' => 'Test User',
            'username' => 'testuser',       // kolom username ditambahkan
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // opsional: set password default
        ]);

        // Seed 2: Jadwal layanan
        $this->call([
            JadwalLayananSeeder::class,
        ]);

        $this->call([
            SettingSeeder::class,
        ]);
    }
}
