<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('stages', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // Lien avec le stagiaire
        $table->unsignedBigInteger('tutor_id')->nullable(); // Lien avec le tuteur
        $table->unsignedBigInteger('entreprise_id')->nullable(); // Lien avec l'entreprise
        $table->date('date_debut'); // Date de début du stage
        $table->date('date_fin'); // Date de fin du stage
        $table->enum('statut', ['disponible', 'en cours', 'terminé'])->default('disponible');
        $table->timestamps();
    
        // Clés étrangères
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('tutor_id')->references('id')->on('users')->onDelete('set null');
        $table->foreign('entreprise_id')->references('id')->on('entreprises')->onDelete('cascade');
    });
    
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};
