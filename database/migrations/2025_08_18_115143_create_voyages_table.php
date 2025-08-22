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
        Schema::create('voyages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('info_user_id')->nullable()->constrained('info_users', 'id');
            $table->foreignId('compagnies_id')->nullable()->constrained('compagnies', 'id');
            $table->foreignId('gares_id')->nullable()->constrained('gares', 'id');
            $table->foreignId('buses_id')->nullable()->constrained('buses', 'id');
            //$table->foreignId('buses_id_2')->nullable()->constrained('bus', 'id');
            //$table->foreignId('buses_id_3')->nullable()->constrained('bus', 'id');
            $table->string('nom_voyage')->nullable();
            $table->string('nom_depart')->nullable();
            $table->string('nom_arrive')->nullable();
            $table->string('heure_depart')->nullable();
            $table->string('heure_arrive')->nullable();
            $table->string('duree_voyage')->nullable();
            $table->string('prix_voyage')->nullable();
            $table->string('latitude_voyage')->nullable();
            $table->string('longitude_voyage')->nullable();
            $table->enum('status', ['1', '2', '3'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voyages');
    }
};
