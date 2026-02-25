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
        Schema::create('configuration_buses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('info_user_id')->nullable()->constrained('info_users', 'id');
            $table->foreignId('gare_id')->nullable()->constrained('gares', 'id');
            $table->foreignId('compagnie_id')->nullable()->constrained('compagnies', 'id');
            // 🧩 Nouveaux champs
            $table->text('nom')->nullable(); // Nom du siège
            $table->text('description')->nullable(); // Nom du siège
            $table->integer('colonne')->nullable(); // Nombre de colonnes du bus
            $table->integer('ranger')->nullable();  // Nombre de rangées du bus
            $table->integer('places_cote_chauffeur')->nullable(); // Nombre de sièges côté chauffeur
            $table->enum('status', ['1', '2', '3'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuration_buses');
    }
};
