<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\Team_User;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Team_UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_team' => Team::all()->random()->id_team,
            'id_user' => User::all()->random()->id_user,
            'captain' => fake()->boolean()
        ];
    }
}
