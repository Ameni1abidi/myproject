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
        Schema::table('stages', function (Blueprint $table) {
            $table->string('rapport_file')->nullable(); // Pour stocker le chemin du fichier du rapport
            $table->text('rapport_contenu')->nullable(); // Pour stocker un contenu textuel du rapport
        });
    }

    public function down()
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->dropColumn('rapport_file');
            $table->dropColumn('rapport_contenu');
        });
    }
};
