<?php

namespace App\Console\Commands;

use App\Models\Heartbeat;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ServeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'serve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Serve the application on SERVE_PORT if .';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $code = 0;
        $host = env('SERVE_HOST', '0.0.0.0');
        $port = env('SERVE_PORT', 8112);

        passthru("php -S $host:$port -t public", $code);

        return $code;
    }
}
