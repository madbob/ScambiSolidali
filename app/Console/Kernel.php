<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\CheckExpired::class,
        \App\Console\Commands\CleanConfig::class,
        \App\Console\Commands\ResetPassword::class
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('check:expired')->daily();
    }

    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
