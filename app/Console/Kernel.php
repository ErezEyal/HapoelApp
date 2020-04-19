<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            \App\Standings::getStandings();
        })->hourly();

        $schedule->call(function () {
            \App\Articles::getArticles();
        })->everyTenMinutes();

        $schedule->call(function () {
            \App\Matches::getMatches();
        })->twiceDaily(7, 17);

        // test schedule
        $schedule->call(function () {
            file_put_contents('currentTime.txt', date('Y-m-d H:i'));
        })->everyFiveMinutes();
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
