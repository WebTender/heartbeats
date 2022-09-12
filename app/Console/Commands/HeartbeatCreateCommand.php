<?php

namespace App\Console\Commands;

use App\Models\Heartbeat;
use Carbon\Carbon;
use Illuminate\Console\Command;

class HeartbeatCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'heartbeat:create {name} {max_minutes} {--description}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a heartbeat.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $beat = Heartbeat::create([
            'name' => $this->argument('name'),
            'description' => $this->option('description'),
            'max_minutes' => $this->argument('max_minutes'),
            'last_pinged_at' => Carbon::now(),
        ]);
        $this->info($beat->id);
        $this->info($beat->url);
        $this->info($beat->statusUrl);
    }
}
