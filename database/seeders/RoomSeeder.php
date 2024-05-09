<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomOptions;
use App\Models\RoomsRoomOptions;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $optionIds = RoomOptions::all()->pluck('id')->toArray();

        Room::factory(10)->create()->each(function ($room) use ($optionIds) {
            foreach ($optionIds as $optionId)
            {
                RoomsRoomOptions::create(
                    [
                        'room_id' => $room->id,
                        'room_options_id' => $optionId,
                        'value' => 'Desired Value',
                    ]
                );
            }
        });
    }
}
