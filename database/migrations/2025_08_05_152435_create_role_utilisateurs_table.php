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
        Schema::create('role_utilisateurs', function (Blueprint $table) {
        $table->id();
        $table->string('nom_role'); // Exemple : rôle de l'utilisateur
        $table->string('description')->nullable();
        $table->enum('status', ['1', '2', '3'])->default('1');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_utilisateurs');
    }
};
