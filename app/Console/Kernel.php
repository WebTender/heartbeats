<?php

namespace App\Console;

use App\Console\Commands\HeartbeatCreateCommand;
use App\Console\Commands\HeartbeatDeleteCommand;
use App\Console\Commands\HeartbeatShowCommand;
use App\Console\Commands\ServeCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        HeartbeatCreateCommand::class,
        HeartbeatDeleteCommand::class,
        HeartbeatShowCommand::class,
        ServeCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
