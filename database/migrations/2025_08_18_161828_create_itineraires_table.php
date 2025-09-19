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
        // Schema::create('itineraires1', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('voyages_id')->nullable()->constrained('voyages1', 'id');
        //     // $table->foreignId('voyages_id')->constrained('voyages', 'id');
        //     $table->string('start_address');
        //     $table->string('end_address');
        //     $table->float('distance')->nullable();
        //     $table->integer('duration')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itineraires');
    }
};
