<?php

namespace Database\Factories;

use App\Models\Chambre;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'chambre_id' => Chambre::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'start_date' => $this->faker->dateTimeBetween('+1 days', '+1 week'),
            'end_date' => $this->faker->dateTimeBetween('+1 week', '+2 weeks')
        ];
    }
}