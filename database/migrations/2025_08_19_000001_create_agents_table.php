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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compagnie_id')->nullable()->constrained('compagnies', 'id');
            $table->foreignId('gare_id')->nullable()->constrained('gares', 'id');
$table->enum('role_personnel', [
    'controleur',
    'manager',
    'directeur',
    'comptable',
    'assistant_admin',

    'chauffeur',
    'receveur',
    'chef_gare',
    'planificateur',

    'agent_vente',
    'caissier',
    'service_client',

    'technicien',
    'mecanicien',
    'electricien',
    'informaticien',

    'gardien',
    'vigile',
    'chef_securite',
    'nettoyeur',
])->default('agent_vente');
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('token')->nullable();
            $table->enum('status', ['actif', 'inactif'])->default('actif');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
