<?php

namespace Database\Seeders;

use App\Models\Heartbeat;
use Illuminate\Database\Seeder;

class HeartbeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Heartbeat::factory(100)->create();
    }
}
