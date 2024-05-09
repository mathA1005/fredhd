<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\User::factory()->create(
            [
                'name' => 'admin User 2',
                'email' => config('app.default_user.email'),
                'password' => Hash::make(config('app.default_user.password')),
                'role_id' => 1,
            ]
        );
        // On crée un admin
        \App\Models\User::factory()->create([
            'name' => 'admin User',
            'email' => 'admin@example.com',
            'role_id' => 1,
        ]);

        // 10 auteurs
        \App\Models\User::factory(10)->create([
            'role_id' => 2,
        ]);


    }
}
