<?php

namespace App\Console\Commands;

use App\Models\Heartbeat;
use Carbon\Carbon;
use Illuminate\Console\Command;

class HeartbeatShowCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'heartbeat:show {--page=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show a table of heartbeat with pagination.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $results = Heartbeat::paginate(
            15,
            ['*'], 'page',
            $this->option('page')
        )->toArray();
        $this->info('Showing page ' . $results['current_page'] . ' of ' . $results['last_page']);
        $this->table(count($results['data']) ? array_keys($results['data'][0]) : [], $results['data']);
    }
}
