<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::disableForeignKeyConstraints(); //for link between rooms and reservations

        Schema::dropIfExists('chambre_equipement');
        Schema::dropIfExists('equipements');
        Schema::dropIfExists('rooms');

        Schema::create('room_options', function (Blueprint $table) {
            $table->id();
            $table->string('icon');
            $table->string('label');
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->text('description');
            $table->string('picture');
        });

        Schema::create('rooms_room_options', function (Blueprint $table) {
            $table->foreignId('room_id')->references('id')->on('rooms');
            $table->foreignId('room_options_id')->references('id')->on('room_options');
            $table->string('value');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['chambre_id']);
            $table->dropColumn('chambre_id');

            $table->foreignId('room_id')->references('id')->on('rooms');
        });

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints(); //for link between rooms and reservations

        Schema::dropIfExists('rooms_room_options');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('room_options');

        Schema::create('equipements', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->string('photo');
            $table->timestamps();
        });

        Schema::create('chambre_equipement', function (Blueprint $table) {
            $table->foreignId('chambre_id')->constrained()->onDelete('cascade');
            $table->foreignId('equipement_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->renameColumn('room_id', 'chambre_id');
        });

        Schema::table('rooms_room_options', function (Blueprint $table) {
            $table->dropColumn('value');
        });

        Schema::enableForeignKeyConstraints();
    }
};
