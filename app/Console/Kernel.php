<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Storage;
use App\Term;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\EndTerm::class,
        \App\Console\Commands\SendExcel::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $termInterval = Storage::get(config('globals.term_interval_filename'));

        switch($termInterval) {
            case 'daily': $schedule->command('term:end')->daily(); break;
            case 'weekly': $schedule->command('term:end')->weekly(); break;
            case 'monthly': $schedule->command('term:end')->monthly(); break;
            case 'quarterly': $schedule->command('term:end')->quarterly(); break;
            case 'yearly': $schedule->command('term:end')->yearly(); break;
            default: $schedule->command('term:end')->weekly(); break;
        }

        $schedule->command('excel:send')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
