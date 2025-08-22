<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoyagesTable extends Migration
{
    public function up()
    {
        Schema::create('voyages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('itineraire_id'); // Clé étrangère vers itineraire
            $table->unsignedBigInteger('info_user_id'); // Clé étrangère vers itineraire// Clé étrangère vers itineraire
            $table->unsignedBigInteger('bus_id'); // Clé étrangère vers buses
            $table->unsignedBigInteger('chauffeur_id');
            $table->integer('montant')->nullable();
            $table->time('heure_depart')->nullable();
            $table->date('date_depart')->nullable();
            $table->timestamps();
            $table->foreign('itineraire_id')->references('id')->on('itineraires')->onDelete('cascade');
            $table->foreign('info_user_id')->references('id')->on('info_users')->onDelete('cascade');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->foreign('chauffeur_id')->references('id')->on('chauffeurs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('voyages');
    }
}
