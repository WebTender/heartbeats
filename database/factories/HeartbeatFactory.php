<?php

namespace Database\Factories;

use App\Models\Heartbeat;
use Illuminate\Database\Eloquent\Factories\Factory;

class HeartbeatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Heartbeat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'max_minutes' => $this->faker->numberBetween(1, 15) * 5,
            'last_pinged_at' => $this->faker->datetime,
        ];
    }
}
