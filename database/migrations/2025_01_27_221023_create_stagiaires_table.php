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
        Schema::create('stagiaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Ensuring user_id is not nullable
            $table->string('entreprise')->nullable();
            $table->enum('statut', ['En attente', 'En cours', 'Terminé'])->default('En attente');
            $table->unsignedBigInteger('tutor_id')->nullable(); // Added tutor_id for the relationship
            $table->string('cv')->nullable(); // For storing the CV file path
            $table->string('institution')->nullable(); // For storing the institution name
            $table->timestamps();
            // Defining foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tutor_id')->references('id')->on('users')->onDelete('set null'); // Set null if tutor is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stagiaires');
    }
};
