<?php

namespace Database\Factories;
use App\Models\Equipement;
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
            'icon' => $this->faker->word,
            'label' => $this->faker->realTextBetween($minNbChars = 50, $maxNbChars = 150),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
        ];
    }
}
