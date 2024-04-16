<?php

namespace Database\Seeders;
use App\Models\chambre;
use App\Models\equipement;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChambreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        chambre::factory(10)->create();
    }
}
