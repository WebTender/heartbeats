<?php

namespace App\Console\Commands;

use App\Models\Heartbeat;
use Carbon\Carbon;
use Illuminate\Console\Command;

class HeartbeatDeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'heartbeat:delete {uuid} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a heartbeat.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $beat = Heartbeat::findOrFail($this->argument('uuid'));
        $this->info($beat);
        if (!$this->option('force') && !$this->confirm("Are you sure you wish to delete this heartbeat?")) {
            $this->info('Skipping');
            return 1;
        }

        $beat->delete();
        $this->info('Deleted.');
    }
}
