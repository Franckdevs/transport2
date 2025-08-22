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
        Schema::create('gares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('info_user_id')->nullable()->constrained('info_users', 'id');
                $table->foreignId('jour_id')->nullable()->constrained('jours',  'id');
                $table->foreignId('ville_id')->nullable()->constrained('villes', 'id');
                $table->foreignId('jour_ouvert_id')->nullable()->constrained('jours',  'id');
                $table->foreignId('jour_de_fermeture_id')->nullable()->constrained('jours',  'id');

                $table->string('latitude')->nullable(); // Coordonnées GPS
                $table->string('longitude')->nullable();

                $table->time('heure_ouverture')->nullable(); // Heure d'ouverture
                $table->time('heure_fermeture')->nullable(); // Heure de fermeture$table->boolean('accessible_pm')->default(false); // Accessible aux personnes à mobilité réduite
                $table->integer('nombre_quais')->nullable(); // Nombre de quais
                $table->boolean('parking_disponible')->default(false); // Parking disponible ou non
                $table->boolean('wifi_disponible')->default(false); // Wi-Fi disponible
                $table->string('telephone')->nullable(); // Numéro de contact
                $table->string('email')->nullable(); // Email de contact
                $table->string('site_web')->nullable(); // Site internet
                $table->text('description')->nullable(); // Description de la gare

                $table->string('nom_gare')->nullable();
                $table->string('adresse_gare')->nullable();
                $table->string('telephone_gare')->nullable();

                // Informations de l'administrateur de la gare
                $table->string('admin_nom')->nullable(); // Nom de l'admin
                $table->string('admin_prenom')->nullable(); // Prénom de l'admin
                $table->string('admin_email')->nullable(); // Email de l'admin
                $table->string('admin_telephone')->nullable(); // Téléphone de l'admin

                $table->enum('status', ['1', '2', '3'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gares');
    }
};
