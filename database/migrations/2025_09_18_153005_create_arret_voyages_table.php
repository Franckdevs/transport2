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
        Schema::create('arret_voyages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voyage_id')->nullable()->constrained('voyages');
            $table->foreignId('arret_id')->nullable()->constrained('arrets');
            // $table->foreignId('id_arret_voayage')->nullable()->constrained('arret_voyages', 'id');
            $table->string('montant')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arret_voyages');
    }
};
