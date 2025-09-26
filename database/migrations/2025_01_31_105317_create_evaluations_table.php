<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stage_id'); // Lien avec le stage
            $table->unsignedBigInteger('tuteur_id'); // Lien avec le tuteur
            $table->integer('note'); // Note sur 20 ou autre
            $table->text('commentaire')->nullable(); // Commentaire du tuteur
            $table->timestamps();

            // Clés étrangères
            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('cascade');
            $table->foreign('tuteur_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
