<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\chambre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\chambre>
 */
class ChambreFactory extends Factory
{
    protected $model = chambre::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'photo' => $this->faker->imageUrl(640, 480, 'room', true)
        ];
    }
}
