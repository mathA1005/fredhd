<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;  // Ajouter cette ligne pour importer le modèle User
use Database\Seeders\EquipementSeeder;
use Database\Seeders\ChambreSeeder;
use App\Models\chambre;  // Ajouter cette ligne pour importer le modèle User


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EquipementSeeder::class);
        $this->call(ChambreSeeder::class);

    }
}
