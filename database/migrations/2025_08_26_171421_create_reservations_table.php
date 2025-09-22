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
            $table->foreignId('voyages_id')->nullable()->constrained('voyages', 'id');
            $table->foreignId('utilisateurs_id')->nullable()->constrained('utilisateurs', 'id');
            $table->foreignId('id_arret_voayage')->nullable()->constrained('arret_voyages', 'id');
            $table->integer('numero_place')->nullable();
            $table->string('autre_informations')->nullable();
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
