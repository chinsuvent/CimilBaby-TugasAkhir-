<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalLayanan;

class JadwalLayananSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['hari' => 'Senin',  'jam_layanan' => '07.00 – 17.00'],
            ['hari' => 'Selasa', 'jam_layanan' => '07.00 – 17.00'],
            ['hari' => 'Rabu',   'jam_layanan' => '07.00 – 17.00'],
            ['hari' => 'Kamis',  'jam_layanan' => '07.00 – 17.00'],
            ['hari' => 'Jumat',  'jam_layanan' => '07.00 – 17.00'],
            ['hari' => 'Sabtu',  'jam_layanan' => 'Libur (Khusus)'],
            ['hari' => 'Minggu', 'jam_layanan' => 'Tutup (Khusus)'],
        ];

        foreach ($data as $item) {
            JadwalLayanan::create($item);
        }
    }
}
