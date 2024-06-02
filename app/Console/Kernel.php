<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        // $schedule->command('backup:db')->daily(); - Run daily at midnight.
        // $schedule->command('backup:db')->dailyAt('3:00'); - Run daily at 3:00 AM.
        // $schedule->command('backup:db')->twiceDaily(1, 13); - Run twice a day at 1:00 AM and 1:00 PM.
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}