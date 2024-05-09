<?php

namespace Database\Factories;
use App\Models\RoomOptions;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomOptions>
 */
class RoomOptionFactory extends Factory
{
    protected $model = RoomOptions::class;

    public function definition(): array
    {
        return [
            'icon' => $this->faker->word,
            'label' => $this->faker->realTextBetween($minNbChars = 50, $maxNbChars = 150)
        ];
    }
}
