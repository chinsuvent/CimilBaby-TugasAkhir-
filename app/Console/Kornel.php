<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $startDate = \Carbon\Carbon::now()->startOfMonth();
            $endDate = \Carbon\Carbon::now()->endOfMonth();

            $currentDate = $startDate->copy();

            while ($currentDate->lte($endDate)) {
                if ($currentDate->isWeekday()) {
                    $exists = \App\Models\JadwalLayanan::where('tanggal', $currentDate->toDateString())->exists();
                    if (!$exists) {
                        \App\Models\JadwalLayanan::create([
                            'tanggal' => $currentDate->toDateString(),
                            'kapasitas' => 10,
                            'terisi' => 0,
                            'status' => 'Tersedia',
                            'slot_number' => null,
                        ]);
                    }
                }
                $currentDate->addDay();
            }
        })->monthlyOn(1, '00:00');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
