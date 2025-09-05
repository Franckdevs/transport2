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
        Schema::create('itineraires', function (Blueprint $table) {
            $table->foreignId('compagnie_id')->nullable()->constrained('compagnies', 'id');
            $table->foreignId('gare_id')->nullable()->constrained('gares', 'id');
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('info_user_id')->nullable()->constrained('info_users')->nullOnDelete();
            $table->foreignId('ville_id')->constrained()->onDelete('cascade');
            $table->time('estimation')->nullable();
            $table->string('titre')->nullable();
            $table->enum('status', ['1', '2', '3'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itineraires');
    }
};
