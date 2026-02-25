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
        Schema::create('config_web_mobiles', function (Blueprint $table) {
            $table->id();
            $table->string('image_acceuil_mobile')->nullable();
            $table->string('sous_image_acceuil_mobile')->nullable();
            $table->string('image_acceuil_web')->nullable();
            $table->string('sous_image_acceuil_web')->nullable();
            $table->string('image_connexion_web')->nullable();
            $table->enum('status', ['1', '2', '3'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_web_mobiles');
    }
};
