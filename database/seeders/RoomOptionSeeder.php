<?php
namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomOptions;
use Illuminate\Database\Seeder;

class RoomOptionsSeeder extends Seeder
{
    private const OPTIONS = [
        [
            'label' => 'area',
            'icon' => 'house'
        ],
        [
            'label' => 'bed_type',
            'icon' => 'bed'
        ],
        [
            'label' => 'internet',
            'icon' => 'wifi'
        ],
        [
            'label' => 'tv',
            'icon' => 'tv'
        ],
        [
            'label' => 'parking',
            'icon' => 'parking'
        ],
        [
            'label' => 'coffee',
            'icon' => 'coffee'
        ],
    ];
    public function run(): void
    {
        RoomOptions::insert(self::OPTIONS);
        RoomOptions::factory(10)
            ->has(Room::factory(10))
        ;
    }
}
