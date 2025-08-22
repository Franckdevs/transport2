<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArretsTable extends Migration
{
    public function up()
    {
        Schema::create('arrets', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
              $table->foreignId('itineraire_id')->nullable()->constrained('itineraires')->nullOnDelete();
             $table->foreignId('info_user_id')->nullable()->constrained('info_users')->nullOnDelete();
            // Colonne info_user_id
            $table->string('nom');
            $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('arrets');
    }
}
