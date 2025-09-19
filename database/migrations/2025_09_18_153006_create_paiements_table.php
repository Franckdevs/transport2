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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->nullable()->constrained('utilisateurs', 'id');
            $table->foreignId('voyages_id')->nullable()->constrained('voyages', 'id');
            $table->foreignId('itineraire_id')->nullable()->constrained('itineraires')->nullOnDelete();
            $table->string('numero_place')->nullable();
            $table->string('montant')->nullable(); // montant du paiement
            $table->string('moyenPaiement')->nullable(); // ex. : carte de crédit, PayPal, etc.
            $table->string('code_paiement')->nullable(); // statut du paiement
            $table->string('statut')->nullable(); // statut du paiement
            $table->string('code')->nullable();
            $table->string('nom_usager')->nullable();
            $table->string('prenom_usager')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('libelle_article')->nullable();
            $table->string('lib_order')->nullable();
            $table->string('Url_Logo')->nullable();
            $table->string('pay_fees')->nullable();
            $table->string('codePaiement')->nullable();
            $table->string('cleretour')->nullable();
            $table->string('datePaiement')->nullable();
            $table->string('HeurePaiement')->nullable();
            $table->string('referencePaiement')->nullable();
            $table->string('benefice')->nullable();
            $table->string('service_id')->nullable();
            $table->string('no_transation')->nullable();
            $table->string('numTel')->nullable();
            $table->enum('status', ['1', '2', '3'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
