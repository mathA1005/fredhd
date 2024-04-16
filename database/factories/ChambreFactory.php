<?php

namespace Database\Factories;
use App\Models\Equipement;
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
    public function configure()
    {
        return $this->afterCreating(function (Chambre $chambre) {
            $equipements = Equipement::all()->random(mt_rand(1, 5));
            $chambre->equipements()->attach($equipements);
        });
}}
