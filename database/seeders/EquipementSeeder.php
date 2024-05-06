<?php

use App\Models\Equipement;


class EquipementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Equipement::factory(10)->create();
    }
}
