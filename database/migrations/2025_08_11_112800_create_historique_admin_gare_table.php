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
        Schema::create('historique_admin_gare', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gare_id')->constrained('gares')->onDelete('cascade');
            $table->foreignId('ancien_admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('nouvel_admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('ancien_admin_nom')->nullable();
            $table->string('ancien_admin_prenom')->nullable();
            $table->string('ancien_admin_email')->nullable();
            $table->string('ancien_admin_telephone')->nullable();
            $table->string('nouvel_admin_nom')->nullable();
            $table->string('nouvel_admin_prenom')->nullable();
            $table->string('nouvel_admin_email')->nullable();
            $table->string('nouvel_admin_telephone')->nullable();
            $table->text('motif_modification')->nullable();
            $table->enum('type_action', ['creation', 'modification', 'suppression'])->default('modification');
            $table->timestamp('date_modification')->useCurrent();
            $table->foreignId('modifie_par_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('modifie_par_nom')->nullable();
            $table->timestamps();
            
            $table->index(['gare_id', 'date_modification']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_admin_gare');
    }
};
