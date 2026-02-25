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
        Schema::create('tarification_montant_voyages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compagnie_id');
            $table->unsignedBigInteger('classe_id');
            $table->unsignedBigInteger('ville_depart_id');
            $table->unsignedBigInteger('ville_arrivee_id');
            $table->integer('montant');
            $table->boolean('est_actif')->default(true);
            $table->timestamps();

            $table->foreign('compagnie_id')->references('id')->on('compagnies')->onDelete('cascade');
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('ville_depart_id')->references('id')->on('villes')->onDelete('cascade');
            $table->foreign('ville_arrivee_id')->references('id')->on('villes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarification_montant_voyage');
    }
};
