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
        Schema::create('compagnies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('info_user_id')->constrained('info_users', 'id');
            $table->string('nom_complet_compagnies')->nullable();
            $table->string('email_compagnies')->nullable();
            $table->string('telephone_compagnies')->nullable();
            $table->string('adresse_compagnies')->nullable();
            $table->string('logo_compagnies')->nullable();
            $table->string('description_compagnies')->nullable();
            $table->enum('status', ['1', '2', '3'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compagnies');
    }
};
