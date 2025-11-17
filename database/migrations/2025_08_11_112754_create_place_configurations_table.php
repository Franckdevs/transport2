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
        Schema::create('place_configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('configuration_bus_id')->nullable()->constrained('configuration_buses', 'id');
            $table->integer('numero'); // Numéro du siège
            $table->boolean('disponible')->default(true); // Disponible ou non
            $table->string('type')->default('client'); // Type : chauffeur, proche_chauffeur, client
            $table->string( 'nom')->nullable(); // Nombre de colonnes du bus
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('place_configurations');
    }
};
