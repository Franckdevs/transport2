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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paiements_id')->nullable()->constrained('paiements', 'id');
            $table->foreignId('voyages_id')->nullable()->constrained('voyages', 'id');
            $table->foreignId('utilisateurs_id')->nullable()->constrained('utilisateurs', 'id');
            $table->foreignId('id_arret_voayage')->nullable()->constrained('arrets', 'id');
            $table->foreignId('compagnies_id')->nullable()->constrained('compagnies', 'id');
            $table->foreignId('gare_id')->nullable()->constrained('gares', 'id');
            $table->text('numero_reservation')->nullable();
            $table->integer('numero_place')->nullable();
            $table->string('autre_informations')->nullable();

            $table->string('nom_complet')->nullable();
            $table->string('telephone_proprietaire')->nullable();

            $table->foreignId('agents_id')->nullable()->constrained('agents', 'id');
            $table->enum('status', ['1', '2', '3'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
