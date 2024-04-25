<?php

namespace Database\Factories;
use App\Models\equipement;

use Database\Seeders\EquipementSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\equipement>
 */
class EquipementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Equipement::class;  // Correction ici

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'description' => $this->faker->realTextBetween($minNbChars = 50, $maxNbChars = 150),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
        ];
    }
}
