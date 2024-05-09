<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->truncateAllTables();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoomOptionsSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(ReservationSeeder::class);

    }
    private function truncateAllTables()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('reservations')->truncate();
        DB::table('roles')->truncate();
        DB::table('rooms')->truncate();
        DB::table('rooms_room_options')->truncate();
        DB::table('room_options')->truncate();
        DB::table('sessions')->truncate();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();
    }
}
