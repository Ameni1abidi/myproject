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
            $table->unsignedBigInteger('stagiaire_id')->nullable(); // Add stagiaire_id column

            // If necessary, add the foreign key constraint:
            $table->foreign('stagiaire_id')->references('id')->on('stagiaires')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->dropForeign(['stagiaire_id']); // Drop the foreign key
            $table->dropColumn('stagiaire_id'); // Drop the column
        });
    }
};
