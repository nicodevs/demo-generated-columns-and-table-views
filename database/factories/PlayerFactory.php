<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Support\Str;
use Illuminate\Process\FakeProcessResult;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => implode(' ', [fake()->firstName(), fake()->lastName()]),
            'team_id' => Team::factory(),
        ];
    }
}
