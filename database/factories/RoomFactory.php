<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\RoomOptions;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        return [
            'label' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'picture' => $this->faker->imageUrl(640, 480, 'rooms', true)
        ];
    }
}
