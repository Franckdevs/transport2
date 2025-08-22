<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('info_user_id')->constrained('info_users', 'id');
            $table->string('nom_bus');
            $table->string('marque_bus');
            $table->string('modele_bus');
            $table->string('immatriculation_bus');
            $table->string('photo_bus')->nullable();
            $table->string('description_bus')->nullable();
            $table->string('place')->nullable();
            $table->string('localisation_bus')->nullable();
            $table->string('nombre_places')->nullable();
            $table->string('configuration_car')->nullable();
            $table->enum('status', ['1', '2', '3'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
