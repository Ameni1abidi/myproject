<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRapportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('rapports', function (Blueprint $table) {
        $table->id(); // ID pour la table
        $table->foreignId('stage_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la table 'stages'
        $table->string('rapport_file')->nullable(); // Pour stocker le chemin du fichier téléchargé
        $table->text('contenu')->nullable(); // Contenu textuel du rapport (facultatif)
        $table->date('date'); // Date du rapport
        $table->timestamps(); // Timestamps pour la création et la mise à jour
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rapports');
    }
}
